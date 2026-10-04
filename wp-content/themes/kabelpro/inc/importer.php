<?php
/**
 * Импорт структуры сайта.
 *
 * Источник страниц — папка content/pages. Каждая страница — папка с файлом index.html,
 * вложенность папок = вложенность страниц = уровни мега-меню (до 4).
 * В начале index.html — JSON в HTML-комментарии с полями:
 *   title       — H1 и заголовок страницы;
 *   seo_title   — <title> (если не задан — берётся title + бренд);
 *   description — meta description;
 *   keywords    — ключевые запросы;
 *   menu        — короткое название для меню (false — не показывать в меню);
 *   order       — порядок сортировки;
 *   photo       — фото-слот обложки;
 *   schema      — product | service | article;
 *   excerpt     — короткое описание для карточек.
 *
 * Страницы стран и городов в разделе «Контакты» генерируются из data/contacts.php.
 *
 * Запуск: «Внешний вид → Импорт КабельПро» (а также автоматически при активации темы).
 *
 * @package kabelpro
 */

/**
 * Разбор файла страницы: [ meta, html ].
 */
function kp_parse_page_file( $file ) {
	$raw  = file_get_contents( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	$meta = array();
	if ( preg_match( '/^\s*<!--\s*(\{.*?\})\s*-->/s', $raw, $m ) ) {
		$meta = json_decode( $m[1], true );
		if ( ! is_array( $meta ) ) {
			$meta = array();
		}
		$raw = substr( $raw, strlen( $m[0] ) );
	}
	return array( $meta, trim( $raw ) );
}

/**
 * Рекурсивный обход папки страниц.
 * Возвращает плоский список [ path => [meta, html, depth] ] в порядке «родитель раньше детей».
 */
function kp_scan_pages( $dir, $prefix = '', $depth = 0 ) {
	$out  = array();
	$subs = glob( trailingslashit( $dir ) . '*', GLOB_ONLYDIR );
	sort( $subs );
	foreach ( $subs as $sub ) {
		$slug = basename( $sub );
		$path = ltrim( $prefix . '/' . $slug, '/' );
		$file = $sub . '/index.html';
		if ( file_exists( $file ) ) {
			list( $meta, $html ) = kp_parse_page_file( $file );
			$out[ $path ]        = array( $meta, $html, $depth );
		}
		$out = array_merge( $out, kp_scan_pages( $sub, $path, $depth + 1 ) );
	}
	return $out;
}

/**
 * Создание или обновление страницы по пути.
 */
function kp_upsert_page( $path, $meta, $html, $force = true ) {
	$parts     = explode( '/', $path );
	$slug      = array_pop( $parts );
	$parent_id = 0;
	if ( $parts ) {
		$parent = get_page_by_path( implode( '/', $parts ) );
		if ( $parent ) {
			$parent_id = $parent->ID;
		}
	}

	$existing = get_page_by_path( $path );
	if ( $existing && ! $force && get_post_meta( $existing->ID, '_kp_lock', true ) ) {
		return $existing->ID;
	}

	$postarr = array(
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'post_title'     => isset( $meta['title'] ) ? $meta['title'] : $slug,
		'post_name'      => $slug,
		'post_parent'    => $parent_id,
		'post_content'   => $html,
		'post_excerpt'   => isset( $meta['excerpt'] ) ? $meta['excerpt'] : '',
		'menu_order'     => isset( $meta['order'] ) ? (int) $meta['order'] : 0,
		'comment_status' => 'closed',
		'ping_status'    => 'closed',
	);
	if ( ! empty( $meta['template'] ) ) {
		$postarr['page_template'] = $meta['template'];
	}

	if ( $existing ) {
		$postarr['ID'] = $existing->ID;
		$id            = wp_update_post( wp_slash( $postarr ) );
	} else {
		$id = wp_insert_post( wp_slash( $postarr ) );
	}
	if ( is_wp_error( $id ) || ! $id ) {
		return 0;
	}

	$map = array(
		'seo_title'   => '_kp_seo_title',
		'description' => '_kp_description',
		'keywords'    => '_kp_keywords',
		'photo'       => '_kp_photo',
		'schema'      => '_kp_schema',
		'country'     => '_kp_country',
		'city'        => '_kp_city',
	);
	foreach ( $map as $field => $key ) {
		if ( isset( $meta[ $field ] ) ) {
			update_post_meta( $id, $key, $meta[ $field ] );
		}
	}
	update_post_meta( $id, '_kp_menu_label', ( isset( $meta['menu'] ) && is_string( $meta['menu'] ) ) ? $meta['menu'] : '' );
	update_post_meta( $id, '_kp_in_menu', ( isset( $meta['menu'] ) && false === $meta['menu'] ) ? '0' : '1' );

	return $id;
}

/**
 * Текст страницы города (уникальный для каждого города за счёт отраслевого фокуса и адресов).
 */
function kp_city_content( $country, $city ) {
	$o = $city['office'];
	$s = $city['stock'];
	ob_start();
	?>
<p class="lead">Филиал [brand] <?php echo esc_html( $city['in'] ); ?> обслуживает заказчиков региона «<?php echo esc_html( $city['region'] ); ?>»: поставляет и сдаёт в аренду кабельные лебедки, прицепы для кабельных барабанов, ролики, устройства закладки кабеля и инструмент, консультирует по технологии прокладки и проводит обучение монтажных бригад.</p>
[city_contacts]
<h2>Чем занимается филиал <?php echo esc_html( $city['in'] ); ?></h2>
<p>Основные проекты, с которыми к нам обращаются <?php echo esc_html( $city['in'] ); ?>: <?php echo esc_html( $city['focus'] ); ?>. Для каждой задачи инженер филиала подбирает комплект оборудования по расчёту тяжения: длина и профиль трассы, количество поворотов, марка, сечение и масса кабеля, тип прокладки — в траншее, в трубах, в коллекторе или на эстакаде.</p>
<p>В офисе в <?php echo esc_html( $o[0] ); ?> работают менеджеры по продажам и инженер-технолог. Здесь можно обсудить проект, получить коммерческое предложение, подписать договор поставки или аренды и забрать документы. Офис расположен по адресу: <?php echo esc_html( $o[1] ); ?>.</p>
<p>Склад филиала находится на территории объекта «<?php echo esc_html( $s[0] ); ?>» (<?php echo esc_html( $s[1] ); ?>). На складе хранится оборудование для аренды и ходовые позиции для продажи: бензиновые и дизельные кабельные лебедки, домкраты для барабанов, линейные и угловые ролики, кабельные чулки, вертлюги, УЗК. Отгрузка — самовывозом или нашим транспортом до объекта.</p>
<h2>Услуги филиала</h2>
<ul>
	<li><strong>Продажа оборудования</strong> — со склада <?php echo esc_html( $city['in'] ); ?> или под заказ с центрального склада; комплектация «под ключ» для конкретной трассы.</li>
	<li><strong>Аренда</strong> — посуточно, на неделю, на месяц или на весь срок проекта; оборудование проходит проверку перед каждой выдачей.</li>
	<li><strong>Расчёт тяжения</strong> — определяем максимальное усилие и боковое давление на кабель, подбираем лебедку с запасом и расставляем ролики.</li>
	<li><strong>Шеф-монтаж и обучение</strong> — инженер выезжает на объект, показывает настройку лебедки, ограничителя тяги и регистратора усилия.</li>
	<li><strong>Сервис и ремонт</strong> — плановое ТО, диагностика двигателей и гидравлики, замена троса, поверка динамометров.</li>
	<li><strong>Доставка</strong> — по региону «<?php echo esc_html( $city['region'] ); ?>» и в соседние регионы, в том числе на удалённые объекты.</li>
</ul>
<h2>Как заказать оборудование <?php echo esc_html( $city['in'] ); ?></h2>
<ol>
	<li>Оставьте заявку на сайте или позвоните по телефону <?php echo esc_html( $city['phone'] ); ?>.</li>
	<li>Пришлите исходные данные: схему трассы, марку и сечение кабеля, длину строительной длины и массу барабана.</li>
	<li>Инженер рассчитает тяжение, подберёт оборудование и подготовит предложение — покупка или аренда.</li>
	<li>После согласования оборудование готовится на складе «<?php echo esc_html( $s[0] ); ?>» и передаётся вам или доставляется на объект.</li>
</ol>
[cta title="Нужна лебедка или прицеп <?php echo esc_attr( $city['in'] ); ?>?" text="Сообщите параметры трассы — подготовим расчёт и предложение по покупке или аренде в течение рабочего дня."]
<h2>Другие филиалы <?php echo esc_html( $country['in'] ); ?></h2>
[country_cities]
	<?php
	return ob_get_clean();
}

/**
 * Текст страницы страны.
 */
function kp_country_content( $country ) {
	$names = wp_list_pluck( $country['cities'], 'name' );
	ob_start();
	?>
<p class="lead">[brand] <?php echo esc_html( $country['in'] ); ?> — это <?php echo count( $names ); ?> <?php echo esc_html( kp_plural( count( $names ), 'филиал', 'филиала', 'филиалов' ) ); ?> с офисом и складом: <?php echo esc_html( implode( ', ', $names ) ); ?>. В каждом городе — инженер-технолог, оборудование для аренды и продажи, сервисная поддержка.</p>
[country_cities]
<h2>Поставка оборудования для прокладки кабеля <?php echo esc_html( $country['in'] ); ?></h2>
<p>Мы поставляем кабельные лебедки с бензиновым, дизельным, электрическим и гидравлическим приводом, прицепы-барабановозы, домкраты и раскаточные устройства, кабельные ролики, устройства закладки кабеля и монтажный инструмент. Оборудование отгружается со складов филиалов, а редкие позиции — с центрального склада с доставкой в согласованный срок. Документы оформляются в соответствии с требованиями страны поставки; расчёты — в валюте <?php echo esc_html( $country['currency'] ); ?> или по согласованию.</p>
<p>Если вашего города нет в списке, оставьте заявку — менеджер ближайшего филиала рассчитает доставку на объект.</p>
[request_form]
	<?php
	return ob_get_clean();
}

/**
 * Основной импорт.
 */
function kp_run_import() {
	$log   = array();
	$pages = kp_scan_pages( KP_DIR . '/content/pages' );

	// Демо-контент свежей установки WordPress.
	foreach ( array( 'sample-page' => 'page', 'hello-world' => 'post' ) as $demo => $type ) {
		$post = get_page_by_path( $demo, OBJECT, $type );
		if ( $post ) {
			wp_delete_post( $post->ID, true );
		}
	}

	foreach ( $pages as $path => $row ) {
		list( $meta, $html ) = $row;
		$id                  = kp_upsert_page( $path, $meta, $html );
		$log[]               = ( $id ? '✓ ' : '✗ ' ) . $path . ' — ' . number_format_i18n( kp_chars_no_spaces( $html ) ) . ' зн.';
	}

	// Контакты: страны и города.
	if ( ! get_page_by_path( 'kontakty' ) ) {
		kp_upsert_page( 'kontakty', array( 'title' => 'Контакты', 'order' => 90 ), '[contacts_directory]' );
	}
	$order = 0;
	foreach ( kp_contacts_data() as $key => $country ) {
		kp_upsert_page(
			'kontakty/' . $key,
			array(
				'title'       => 'Оборудование для прокладки кабеля ' . $country['in'] . ' — филиалы [brand]',
				'menu'        => $country['name'],
				'seo_title'   => 'Оборудование для прокладки кабеля ' . $country['in'] . ': адреса офисов и складов',
				'description' => 'Филиалы [brand] ' . $country['in'] . ': ' . implode( ', ', wp_list_pluck( $country['cities'], 'name' ) ) . '. Продажа и аренда кабельных лебедок, прицепов, роликов. Офисы, склады, телефоны.',
				'order'       => $order++,
				'country'     => $key,
			),
			kp_country_content( $country )
		);
		$c = 0;
		foreach ( $country['cities'] as $city ) {
			kp_upsert_page(
				'kontakty/' . $key . '/' . $city['slug'],
				array(
					'title'       => 'Оборудование для прокладки кабеля ' . $city['in'],
					'menu'        => $city['name'],
					'seo_title'   => 'Кабельные лебедки и оборудование для прокладки кабеля ' . $city['in'] . ' — купить, аренда',
					'description' => 'Филиал [brand] ' . $city['in'] . ': офис в ' . $city['office'][0] . ', склад «' . $city['stock'][0] . '». Продажа и аренда кабельных лебедок, прицепов, роликов. ☎ ' . $city['phone'],
					'keywords'    => 'кабельная лебедка ' . $city['name'] . ', оборудование для прокладки кабеля ' . $city['name'] . ', аренда кабельной лебедки ' . $city['name'],
					'order'       => $c++,
					'country'     => $key,
					'city'        => $city['slug'],
				),
				kp_city_content( $country, $city )
			);
		}
	}
	$log[] = '✓ Контакты: ' . count( kp_contacts_data() ) . ' стран';

	// Главная страница и ЧПУ.
	$home = get_page_by_path( 'glavnaya' );
	if ( $home ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home->ID );
	}
	update_option( 'blogname', kp_opt( 'kp_brand' ) );
	update_option( 'blogdescription', kp_opt( 'kp_tagline' ) );
	update_option( 'permalink_structure', '/%postname%/' );
	flush_rewrite_rules();

	$log[] = kp_build_menus();

	update_option( 'kp_last_import', current_time( 'mysql' ) );
	return $log;
}

/**
 * Пункты меню из дерева страниц (рекурсивно, до 4 уровней).
 */
function kp_add_menu_branch( $menu_id, $parent_page, $parent_item, $depth ) {
	if ( $depth > 4 ) {
		return;
	}
	foreach ( kp_child_pages( $parent_page ) as $page ) {
		if ( '0' === get_post_meta( $page->ID, '_kp_in_menu', true ) ) {
			continue;
		}
		$label   = get_post_meta( $page->ID, '_kp_menu_label', true );
		$item_id = wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'     => $label ? $label : $page->post_title,
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $page->ID,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $parent_item,
		) );
		kp_add_menu_branch( $menu_id, $page->ID, $item_id, $depth + 1 );
	}
}

/**
 * Создание главного и подвального меню.
 */
function kp_build_menus() {
	$name = 'Главное мега-меню';
	$menu = wp_get_nav_menu_object( $name );
	if ( $menu ) {
		wp_delete_nav_menu( $menu->term_id );
	}
	$menu_id = wp_create_nav_menu( $name );
	$front   = (int) get_option( 'page_on_front' );

	foreach ( kp_child_pages( 0 ) as $page ) {
		if ( $page->ID === $front || '0' === get_post_meta( $page->ID, '_kp_in_menu', true ) ) {
			continue;
		}
		$label   = get_post_meta( $page->ID, '_kp_menu_label', true );
		$item_id = wp_update_nav_menu_item( $menu_id, 0, array(
			'menu-item-title'     => $label ? $label : $page->post_title,
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $page->ID,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
		) );
		kp_add_menu_branch( $menu_id, $page->ID, $item_id, 2 );
	}

	// Подвал: разделы первого уровня.
	$fname = 'Меню в подвале';
	$fmenu = wp_get_nav_menu_object( $fname );
	if ( $fmenu ) {
		wp_delete_nav_menu( $fmenu->term_id );
	}
	$fmenu_id = wp_create_nav_menu( $fname );
	foreach ( kp_child_pages( 0 ) as $page ) {
		if ( $page->ID === $front ) {
			continue;
		}
		$label = get_post_meta( $page->ID, '_kp_menu_label', true );
		wp_update_nav_menu_item( $fmenu_id, 0, array(
			'menu-item-title'     => $label ? $label : $page->post_title,
			'menu-item-object'    => 'page',
			'menu-item-object-id' => $page->ID,
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
		) );
	}

	$locations            = get_theme_mod( 'nav_menu_locations', array() );
	$locations['primary'] = $menu_id;
	$locations['footer']  = $fmenu_id;
	set_theme_mod( 'nav_menu_locations', $locations );

	$count = count( wp_get_nav_menu_items( $menu_id ) );
	return '✓ Мега-меню: ' . $count . ' пунктов';
}

/**
 * Страница импорта в админке.
 */
add_action( 'admin_menu', function () {
	add_theme_page( 'Импорт КабельПро', 'Импорт КабельПро', 'manage_options', 'kp-import', 'kp_import_page' );
} );

function kp_import_page() {
	$log = array();
	if ( isset( $_POST['kp_import_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['kp_import_nonce'] ) ), 'kp_import' ) && current_user_can( 'manage_options' ) ) {
		$log = kp_run_import();
	}
	echo '<div class="wrap"><h1>Импорт структуры сайта</h1>';
	echo '<p>Создаёт или обновляет все страницы из папки <code>content/pages</code> темы, страницы стран и городов из <code>data/contacts.php</code>, назначает главную страницу, ЧПУ и строит мега-меню (до 4 уровней).</p>';
	echo '<p><strong>Внимание:</strong> тексты страниц, созданных импортом, будут перезаписаны версией из темы. Чтобы защитить страницу от перезаписи, добавьте ей произвольное поле <code>_kp_lock</code> = 1.</p>';
	$last = get_option( 'kp_last_import' );
	if ( $last ) {
		echo '<p>Последний импорт: ' . esc_html( $last ) . '</p>';
	}
	echo '<form method="post">';
	wp_nonce_field( 'kp_import', 'kp_import_nonce' );
	submit_button( 'Запустить импорт' );
	echo '</form>';
	if ( $log ) {
		echo '<h2>Результат</h2><pre style="background:#fff;padding:12px;max-height:600px;overflow:auto">' . esc_html( implode( "\n", $log ) ) . '</pre>';
	}
	echo '</div>';
}

/**
 * Первый импорт при активации темы.
 */
add_action( 'after_switch_theme', function () {
	if ( ! get_option( 'kp_last_import' ) ) {
		kp_run_import();
	}
} );
