<?php
/**
 * Встроенная SEO-оптимизация.
 *
 * - <title> и meta description из полей страницы (_kp_seo_title, _kp_description);
 * - meta keywords (учитывается Яндексом как вспомогательный сигнал);
 * - canonical, robots, Open Graph, Twitter Card;
 * - Schema.org (JSON-LD): Organization, WebSite, BreadcrumbList, Product/Service, FAQPage, LocalBusiness;
 * - мета-бокс в редакторе страницы;
 * - robots.txt и XML-карта сайта (штатная wp-sitemap.xml);
 * - подключение Яндекс.Метрики и GA4.
 *
 * Если установлен Yoast SEO, Rank Math или AIOSEO — тема не дублирует их мета-теги.
 *
 * @package kabelpro
 */

/**
 * Активен ли сторонний SEO-плагин.
 */
function kp_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' );
}

/**
 * SEO-заголовок текущей страницы.
 */
function kp_document_title_parts( $parts ) {
	if ( kp_seo_plugin_active() ) {
		return $parts;
	}
	if ( is_singular() ) {
		$custom = get_post_meta( get_queried_object_id(), '_kp_seo_title', true );
		if ( $custom ) {
			return array( 'title' => kp_apply_brand( $custom ) );
		}
	}
	if ( is_front_page() ) {
		$parts['tagline'] = kp_opt( 'kp_tagline' );
	}
	$parts['site'] = kp_opt( 'kp_brand' );
	return $parts;
}
add_filter( 'document_title_parts', 'kp_document_title_parts' );

add_filter( 'document_title_separator', function () {
	return '—';
} );

/**
 * Meta description текущей страницы.
 */
function kp_meta_description() {
	if ( is_singular() ) {
		$id   = get_queried_object_id();
		$desc = get_post_meta( $id, '_kp_description', true );
		if ( ! $desc ) {
			$post = get_post( $id );
			$desc = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 30, '…' );
		}
		return kp_apply_brand( $desc );
	}
	if ( is_search() ) {
		return 'Результаты поиска по сайту ' . kp_opt( 'kp_brand' ) . '.';
	}
	return kp_opt( 'kp_brand' ) . ' — ' . kp_opt( 'kp_tagline' ) . '. Поставка, аренда и сервис по России и странам СНГ.';
}

/**
 * Изображение для соцсетей.
 */
function kp_og_image() {
	if ( is_singular() ) {
		$id = get_queried_object_id();
		if ( has_post_thumbnail( $id ) ) {
			return get_the_post_thumbnail_url( $id, 'kp-hero' );
		}
		$slot = get_post_meta( $id, '_kp_photo', true );
		if ( $slot ) {
			$url = kp_photo_url( $slot );
			if ( $url ) {
				return $url;
			}
		}
	}
	$hero = kp_photo_url( 'home-hero' );
	return $hero ? $hero : KP_URI . '/assets/img/og-default.png';
}

/**
 * Каноническая ссылка.
 */
function kp_canonical() {
	if ( is_singular() ) {
		return wp_get_canonical_url( get_queried_object_id() );
	}
	if ( is_front_page() || is_home() ) {
		return home_url( '/' );
	}
	return '';
}

/**
 * Вывод мета-тегов в <head>.
 */
function kp_seo_head() {
	$verif_y = kp_opt( 'kp_yandex_verif' );
	$verif_g = kp_opt( 'kp_google_verif' );
	if ( $verif_y ) {
		printf( '<meta name="yandex-verification" content="%s">' . "\n", esc_attr( $verif_y ) );
	}
	if ( $verif_g ) {
		printf( '<meta name="google-site-verification" content="%s">' . "\n", esc_attr( $verif_g ) );
	}

	if ( kp_seo_plugin_active() ) {
		return;
	}

	$desc      = kp_meta_description();
	$canonical = kp_canonical();
	$title     = wp_get_document_title();
	$image     = kp_og_image();

	printf( '<meta name="description" content="%s">' . "\n", esc_attr( $desc ) );

	if ( is_singular() ) {
		$kw = get_post_meta( get_queried_object_id(), '_kp_keywords', true );
		if ( $kw ) {
			printf( '<meta name="keywords" content="%s">' . "\n", esc_attr( $kw ) );
		}
	}

	if ( is_search() || is_404() ) {
		echo '<meta name="robots" content="noindex, follow">' . "\n";
	} else {
		echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">' . "\n";
	}

	// Штатный rel=canonical WordPress выводит только для записей — для главной добавляем свой.
	if ( $canonical && ! is_singular() ) {
		printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $canonical ) );
	}

	$og = array(
		'og:locale'      => 'ru_RU',
		'og:type'        => is_front_page() ? 'website' : 'article',
		'og:site_name'   => kp_opt( 'kp_brand' ),
		'og:title'       => $title,
		'og:description' => $desc,
		'og:url'         => $canonical ? $canonical : home_url( add_query_arg( array() ) ),
		'og:image'       => $image,
	);
	foreach ( $og as $prop => $content ) {
		printf( '<meta property="%s" content="%s">' . "\n", esc_attr( $prop ), esc_attr( $content ) );
	}
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $desc ) );
	printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $image ) );

	kp_print_schema();
}
add_action( 'wp_head', 'kp_seo_head', 2 );

/**
 * Сборка и вывод JSON-LD разметки Schema.org.
 */
function kp_print_schema() {
	$graph    = array();
	$home     = home_url( '/' );
	$org_id   = $home . '#organization';
	$brand    = kp_opt( 'kp_brand' );
	$same_as  = array_values( array_filter( array( kp_opt( 'kp_vk' ), kp_opt( 'kp_youtube' ), kp_opt( 'kp_rutube' ), kp_opt( 'kp_telegram' ) ) ) );

	$org = array(
		'@type'        => 'Organization',
		'@id'          => $org_id,
		'name'         => $brand,
		'legalName'    => kp_opt( 'kp_legal' ),
		'url'          => $home,
		'logo'         => KP_URI . '/assets/img/logo.svg',
		'telephone'    => kp_opt( 'kp_phone' ),
		'email'        => kp_opt( 'kp_email' ),
		'foundingDate' => kp_opt( 'kp_founded' ),
		'areaServed'   => array_values( wp_list_pluck( kp_contacts_data(), 'name' ) ),
	);
	if ( $same_as ) {
		$org['sameAs'] = $same_as;
	}
	$graph[] = $org;

	if ( is_front_page() ) {
		$graph[] = array(
			'@type'           => 'WebSite',
			'@id'             => $home . '#website',
			'url'             => $home,
			'name'            => $brand,
			'inLanguage'      => 'ru-RU',
			'publisher'       => array( '@id' => $org_id ),
			'potentialAction' => array(
				'@type'       => 'SearchAction',
				'target'      => $home . '?s={search_term_string}',
				'query-input' => 'required name=search_term_string',
			),
		);
	}

	if ( is_singular() && ! is_front_page() ) {
		$id     = get_queried_object_id();
		$crumbs = kp_breadcrumb_items();
		if ( count( $crumbs ) > 1 ) {
			$list = array();
			foreach ( $crumbs as $i => $crumb ) {
				$list[] = array(
					'@type'    => 'ListItem',
					'position' => $i + 1,
					'name'     => $crumb['title'],
					'item'     => $crumb['url'],
				);
			}
			$graph[] = array(
				'@type'           => 'BreadcrumbList',
				'itemListElement' => $list,
			);
		}

		$type = get_post_meta( $id, '_kp_schema', true );
		$name = get_the_title( $id );
		$desc = kp_meta_description();

		if ( 'product' === $type ) {
			$graph[] = array(
				'@type'       => 'Product',
				'name'        => $name,
				'description' => $desc,
				'image'       => kp_og_image(),
				'brand'       => array( '@type' => 'Brand', 'name' => $brand ),
				'category'    => 'Оборудование для прокладки кабеля',
				'offers'      => array(
					'@type'         => 'AggregateOffer',
					'priceCurrency' => 'RUB',
					'availability'  => 'https://schema.org/InStock',
					'offerCount'    => max( 1, count( kp_child_pages( $id ) ) ),
					'seller'        => array( '@id' => $org_id ),
				),
			);
		} elseif ( 'service' === $type ) {
			$graph[] = array(
				'@type'       => 'Service',
				'name'        => $name,
				'description' => $desc,
				'provider'    => array( '@id' => $org_id ),
				'areaServed'  => $org['areaServed'],
			);
		} elseif ( 'article' === $type ) {
			$post    = get_post( $id );
			$graph[] = array(
				'@type'         => 'TechArticle',
				'headline'      => $name,
				'description'   => $desc,
				'image'         => kp_og_image(),
				'datePublished' => get_the_date( 'c', $post ),
				'dateModified'  => get_the_modified_date( 'c', $post ),
				'author'        => array( '@id' => $org_id ),
				'publisher'     => array( '@id' => $org_id ),
				'inLanguage'    => 'ru-RU',
			);
		}

		$faq = kp_extract_faq( get_post_field( 'post_content', $id ) );
		if ( $faq ) {
			$graph[] = array(
				'@type'      => 'FAQPage',
				'mainEntity' => $faq,
			);
		}

		$local = kp_city_schema( $id );
		if ( $local ) {
			$graph = array_merge( $graph, $local );
		}
	}

	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}

/**
 * Вопросы-ответы из блока FAQ: <details class="faq"><summary>Вопрос</summary>Ответ</details>.
 */
function kp_extract_faq( $content ) {
	if ( false === strpos( $content, '<details' ) ) {
		return array();
	}
	preg_match_all( '#<details[^>]*>\s*<summary[^>]*>(.*?)</summary>(.*?)</details>#is', $content, $m, PREG_SET_ORDER );
	$out = array();
	foreach ( $m as $row ) {
		$out[] = array(
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( kp_apply_brand( $row[1] ) ),
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => trim( wp_strip_all_tags( kp_apply_brand( $row[2] ) ) ),
			),
		);
	}
	return $out;
}

/**
 * Счётчики аналитики.
 */
function kp_analytics() {
	$metrika = preg_replace( '/\D/', '', kp_opt( 'kp_metrika_id' ) );
	$gtag    = preg_replace( '/[^A-Z0-9\-]/', '', strtoupper( kp_opt( 'kp_gtag_id' ) ) );
	if ( $metrika ) {
		?>
<script>(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};m[i].l=1*new Date();for(var j=0;j<document.scripts.length;j++){if(document.scripts[j].src===r){return;}}k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})(window,document,"script","https://mc.yandex.ru/metrika/tag.js","ym");ym(<?php echo (int) $metrika; ?>,"init",{clickmap:true,trackLinks:true,accurateTrackBounce:true,webvisor:true});</script>
<noscript><div><img src="https://mc.yandex.ru/watch/<?php echo (int) $metrika; ?>" style="position:absolute;left:-9999px" alt=""></div></noscript>
		<?php
	}
	if ( $gtag ) {
		?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $gtag ); ?>"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?php echo esc_js( $gtag ); ?>');</script>
		<?php
	}
}
add_action( 'wp_head', 'kp_analytics', 50 );

/**
 * robots.txt.
 */
function kp_robots_txt( $output, $public ) {
	if ( ! $public ) {
		return $output;
	}
	$sitemap = home_url( '/wp-sitemap.xml' );
	$rules   = "User-agent: *\n"
		. "Disallow: /wp-admin/\n"
		. "Allow: /wp-admin/admin-ajax.php\n"
		. "Disallow: /?s=\n"
		. "Disallow: /search/\n"
		. "Disallow: /*?replytocom=\n"
		. "Disallow: /wp-json/\n"
		. "Disallow: /xmlrpc.php\n"
		. "Disallow: /*utm_\n"
		. "Clean-param: utm_source&utm_medium&utm_campaign&utm_content&utm_term&yclid&gclid&fbclid\n\n"
		. 'Sitemap: ' . $sitemap . "\n";
	return $rules;
}
add_filter( 'robots_txt', 'kp_robots_txt', 10, 2 );

/**
 * Карта сайта: только страницы (без пользователей и пустых таксономий).
 */
add_filter( 'wp_sitemaps_add_provider', function ( $provider, $name ) {
	return ( 'users' === $name ) ? false : $provider;
}, 10, 2 );

/**
 * Мета-бокс SEO в редакторе страниц.
 */
function kp_seo_metabox() {
	if ( kp_seo_plugin_active() ) {
		return;
	}
	add_meta_box( 'kp_seo', 'SEO (КабельПро)', 'kp_seo_metabox_html', array( 'page', 'post' ), 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'kp_seo_metabox' );

function kp_seo_metabox_html( $post ) {
	wp_nonce_field( 'kp_seo_save', 'kp_seo_nonce' );
	$fields = array(
		'_kp_seo_title'  => array( 'SEO-заголовок (title), до 70 символов', 'text' ),
		'_kp_description' => array( 'Meta description, 140–160 символов', 'textarea' ),
		'_kp_keywords'   => array( 'Ключевые слова через запятую', 'textarea' ),
		'_kp_menu_label' => array( 'Короткое название для меню', 'text' ),
		'_kp_photo'      => array( 'Фото-слот для обложки (например, winch-petrol-1)', 'text' ),
	);
	echo '<table class="form-table">';
	foreach ( $fields as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		echo '<tr><th><label for="' . esc_attr( $key ) . '">' . esc_html( $field[0] ) . '</label></th><td>';
		if ( 'textarea' === $field[1] ) {
			echo '<textarea class="large-text" rows="3" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '">' . esc_textarea( $value ) . '</textarea>';
		} else {
			echo '<input class="large-text" type="text" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '">';
		}
		echo '</td></tr>';
	}
	$schema = get_post_meta( $post->ID, '_kp_schema', true );
	echo '<tr><th>Тип разметки Schema.org</th><td><select name="_kp_schema">';
	foreach ( array( '' => '—', 'product' => 'Product (товар)', 'service' => 'Service (услуга)', 'article' => 'TechArticle (статья)' ) as $val => $label ) {
		printf( '<option value="%s" %s>%s</option>', esc_attr( $val ), selected( $schema, $val, false ), esc_html( $label ) );
	}
	echo '</select></td></tr>';
	printf(
		'<tr><th>Объём текста</th><td><strong>%s</strong> знаков без пробелов</td></tr>',
		esc_html( number_format_i18n( kp_chars_no_spaces( $post->post_content ) ) )
	);
	echo '</table>';
}

function kp_seo_metabox_save( $post_id ) {
	if ( ! isset( $_POST['kp_seo_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['kp_seo_nonce'] ) ), 'kp_seo_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	foreach ( array( '_kp_seo_title', '_kp_menu_label', '_kp_photo', '_kp_schema' ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
	foreach ( array( '_kp_description', '_kp_keywords' ) as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}
}
add_action( 'save_post', 'kp_seo_metabox_save' );
