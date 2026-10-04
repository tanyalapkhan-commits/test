<?php
/**
 * Шорткоды и обработка контента: бренд, фото, карточки подразделов, оглавление.
 *
 * @package kabelpro
 */

/**
 * Подстановка бренда в произвольную строку.
 */
function kp_apply_brand( $text ) {
	return str_replace( '[brand]', kp_opt( 'kp_brand' ), (string) $text );
}
add_filter( 'the_title', 'kp_apply_brand' );
add_filter( 'get_the_excerpt', 'kp_apply_brand' );

add_shortcode( 'brand', function () {
	return esc_html( kp_opt( 'kp_brand' ) );
} );

add_shortcode( 'phone', function () {
	$phone = kp_opt( 'kp_phone' );
	return '<a href="tel:' . esc_attr( kp_tel( $phone ) ) . '">' . esc_html( $phone ) . '</a>';
} );

add_shortcode( 'email', function () {
	$email = kp_opt( 'kp_email' );
	return '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
} );

/**
 * [photo slot="winch-petrol-1" alt="..." caption="..." size="wide|half|full"]
 */
function kp_sc_photo( $atts ) {
	$atts = shortcode_atts( array(
		'slot'    => '',
		'alt'     => '',
		'caption' => '',
		'size'    => 'wide',
	), $atts, 'photo' );

	if ( ! $atts['slot'] ) {
		return '';
	}

	$alt     = $atts['alt'] ? $atts['alt'] : kp_photo_alt( $atts['slot'] );
	$caption = $atts['caption'] ? '<figcaption>' . esc_html( $atts['caption'] ) . '</figcaption>' : '';

	return '<figure class="photo photo--' . esc_attr( $atts['size'] ) . '">' . kp_photo_img( $atts['slot'], $alt ) . $caption . '</figure>';
}
add_shortcode( 'photo', 'kp_sc_photo' );

/**
 * [photos slots="a,b,c"] — сетка фотографий.
 */
add_shortcode( 'photos', function ( $atts ) {
	$atts  = shortcode_atts( array( 'slots' => '' ), $atts, 'photos' );
	$slots = array_filter( array_map( 'trim', explode( ',', $atts['slots'] ) ) );
	if ( ! $slots ) {
		return '';
	}
	$html = '<div class="photo-grid photo-grid--' . count( $slots ) . '">';
	foreach ( $slots as $slot ) {
		$html .= '<figure class="photo">' . kp_photo_img( $slot, kp_photo_alt( $slot ) ) . '</figure>';
	}
	return $html . '</div>';
} );

/**
 * [children] — карточки дочерних страниц текущего раздела.
 */
function kp_sc_children( $atts ) {
	$atts = shortcode_atts( array(
		'parent' => 0,
		'title'  => '',
	), $atts, 'children' );

	$parent = $atts['parent'] ? (int) $atts['parent'] : get_the_ID();
	$pages  = kp_child_pages( $parent );
	if ( ! $pages ) {
		return '';
	}

	$html = $atts['title'] ? '<h2>' . esc_html( $atts['title'] ) . '</h2>' : '';
	$html .= '<div class="cards">';
	foreach ( $pages as $page ) {
		$html .= kp_card_html( $page );
	}
	return $html . '</div>';
}
add_shortcode( 'children', 'kp_sc_children' );

/**
 * Карточка страницы.
 */
function kp_card_html( $page ) {
	$slot  = get_post_meta( $page->ID, '_kp_photo', true );
	$label = get_post_meta( $page->ID, '_kp_menu_label', true );
	$title = $label ? $label : get_the_title( $page );
	$img   = $slot ? kp_photo_img( $slot, get_the_title( $page ), 'card__img' ) : '';
	$kids  = count( kp_child_pages( $page->ID ) );

	return '<a class="card" href="' . esc_url( get_permalink( $page ) ) . '">'
		. ( $img ? '<span class="card__media">' . $img . '</span>' : '' )
		. '<span class="card__body">'
		. '<span class="card__title">' . esc_html( $title ) . '</span>'
		. '<span class="card__text">' . esc_html( kp_page_teaser( $page, 22 ) ) . '</span>'
		. ( $kids ? '<span class="card__meta">' . esc_html( $kids . ' ' . kp_plural( $kids, 'подраздел', 'подраздела', 'подразделов' ) ) . '</span>' : '' )
		. '<span class="card__more">Подробнее ' . kp_icon( 'arrow' ) . '</span>'
		. '</span></a>';
}

/**
 * Склонение существительных после числа.
 */
function kp_plural( $n, $one, $few, $many ) {
	$n  = abs( (int) $n ) % 100;
	$n1 = $n % 10;
	if ( $n > 10 && $n < 20 ) {
		return $many;
	}
	if ( $n1 > 1 && $n1 < 5 ) {
		return $few;
	}
	if ( 1 === $n1 ) {
		return $one;
	}
	return $many;
}

/**
 * [cta title="..." text="..."] — блок призыва к действию внутри текста.
 */
add_shortcode( 'cta', function ( $atts ) {
	$atts = shortcode_atts( array(
		'title' => 'Подберём оборудование под вашу трассу',
		'text'  => 'Пришлите длину и профиль трассы, марку и сечение кабеля — инженер рассчитает тяжение и предложит комплект: лебедку, ролики, прицеп и оснастку.',
		'btn'   => 'Получить расчёт',
	), $atts, 'cta' );

	return '<aside class="cta-inline"><div class="cta-inline__text"><div class="cta-inline__title">' . esc_html( kp_apply_brand( $atts['title'] ) ) . '</div><p>'
		. esc_html( kp_apply_brand( $atts['text'] ) ) . '</p></div>'
		. '<a class="btn btn--accent" href="#request" data-modal="request">' . esc_html( $atts['btn'] ) . '</a></aside>';
} );

/**
 * Транслитерация для якорей оглавления.
 */
function kp_anchor( $text ) {
	$map  = array(
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
		'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
		'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '',
		'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
	);
	$text = mb_strtolower( wp_strip_all_tags( $text ), 'UTF-8' );
	$text = strtr( $text, $map );
	$text = preg_replace( '/[^a-z0-9]+/', '-', $text );
	return trim( substr( $text, 0, 60 ), '-' );
}

/**
 * Добавляет id к заголовкам h2/h3 и собирает оглавление.
 * Результат кэшируется на время запроса.
 */
function kp_prepare_content( $content ) {
	static $toc = array();

	if ( null === $content ) {
		return $toc;
	}

	$used = array();
	$toc  = array();

	$content = preg_replace_callback(
		'#<h([23])([^>]*)>(.*?)</h\1>#is',
		function ( $m ) use ( &$used, &$toc ) {
			if ( false !== strpos( $m[2], 'id=' ) ) {
				preg_match( '/id="([^"]+)"/', $m[2], $idm );
				$id = $idm[1];
			} else {
				$id = kp_anchor( $m[3] );
				if ( ! $id ) {
					$id = 'section';
				}
				$base = $id;
				$n    = 2;
				while ( isset( $used[ $id ] ) ) {
					$id = $base . '-' . $n++;
				}
				$m[2] .= ' id="' . $id . '"';
			}
			$used[ $id ] = true;
			$toc[]       = array(
				'level' => (int) $m[1],
				'id'    => $id,
				'title' => wp_strip_all_tags( $m[3] ),
			);
			return '<h' . $m[1] . $m[2] . '>' . $m[3] . '</h' . $m[1] . '>';
		},
		$content
	);

	return $content;
}

/**
 * Фильтр контента страниц: якоря заголовков.
 */
add_filter( 'the_content', function ( $content ) {
	if ( ! is_singular() || ! in_the_loop() ) {
		return $content;
	}
	return kp_prepare_content( $content );
}, 20 );

/**
 * Оглавление (выводится в шаблоне после обработки контента).
 */
function kp_toc_html() {
	$toc = kp_prepare_content( null );
	$h2  = array_filter( $toc, function ( $row ) {
		return 2 === $row['level'];
	} );
	if ( count( $h2 ) < 3 ) {
		return '';
	}
	$html = '<nav class="toc" aria-label="Содержание"><div class="toc__title">Содержание</div><ol class="toc__list">';
	foreach ( $h2 as $row ) {
		$html .= '<li><a href="#' . esc_attr( $row['id'] ) . '">' . esc_html( $row['title'] ) . '</a></li>';
	}
	return $html . '</ol></nav>';
}

/**
 * Обёртка для таблиц — горизонтальная прокрутка на мобильных.
 */
add_filter( 'the_content', function ( $content ) {
	return preg_replace( '#<table(.*?)</table>#is', '<div class="table-wrap"><table$1</table></div>', $content );
}, 25 );
