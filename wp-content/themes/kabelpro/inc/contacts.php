<?php
/**
 * Контакты: страны СНГ → города → офис и склад.
 *
 * Страницы стран и городов создаются импортёром (inc/importer.php). Страница хранит
 * ссылку на запись в data/contacts.php в мета-полях _kp_country и _kp_city,
 * поэтому адреса и телефоны правятся в одном месте.
 *
 * @package kabelpro
 */

function kp_contacts_data() {
	static $data = null;
	if ( null === $data ) {
		$data = require KP_DIR . '/data/contacts.php';
	}
	return $data;
}

/**
 * Запись города по ключу страны и ЧПУ города.
 */
function kp_city( $country_key, $city_slug ) {
	$data = kp_contacts_data();
	if ( empty( $data[ $country_key ] ) ) {
		return null;
	}
	foreach ( $data[ $country_key ]['cities'] as $city ) {
		if ( $city['slug'] === $city_slug ) {
			return $city;
		}
	}
	return null;
}

/**
 * Ссылка на адрес в Яндекс.Картах.
 */
function kp_map_link( $address ) {
	return 'https://yandex.ru/maps/?text=' . rawurlencode( $address );
}

/**
 * Блок адреса (офис или склад).
 */
function kp_location_html( $type, $place, $phone = '' ) {
	$title = ( 'office' === $type ) ? 'Офис продаж и инженерный отдел' : 'Склад и пункт выдачи оборудования';
	$icon  = ( 'office' === $type ) ? 'office' : 'warehouse';
	$html  = '<div class="loc loc--' . esc_attr( $type ) . '">'
		. '<div class="loc__icon">' . kp_icon( $icon ) . '</div>'
		. '<div class="loc__body"><div class="loc__type">' . esc_html( $title ) . '</div>'
		. '<div class="loc__name">' . esc_html( $place[0] ) . '</div>'
		. '<div class="loc__addr">' . esc_html( $place[1] ) . '</div>';
	if ( $phone ) {
		$html .= '<a class="loc__phone" href="tel:' . esc_attr( kp_tel( $phone ) ) . '">' . esc_html( $phone ) . '</a>';
	}
	$html .= '<a class="loc__map" href="' . esc_url( kp_map_link( $place[1] ) ) . '" target="_blank" rel="noopener">Показать на карте ' . kp_icon( 'arrow' ) . '</a>'
		. '</div></div>';
	return $html;
}

/**
 * Справочник всех филиалов (для главной страницы «Контакты» и подвала).
 */
function kp_contacts_directory_html() {
	$html = '<div class="geo">';
	foreach ( kp_contacts_data() as $key => $country ) {
		$country_page = get_page_by_path( 'kontakty/' . $key );
		$html        .= '<section class="geo__country"><h2 class="geo__title">';
		$html        .= $country_page ? '<a href="' . esc_url( get_permalink( $country_page ) ) . '">' . esc_html( $country['name'] ) . '</a>' : esc_html( $country['name'] );
		$html        .= ' <span class="geo__count">' . count( $country['cities'] ) . ' ' . kp_plural( count( $country['cities'] ), 'филиал', 'филиала', 'филиалов' ) . '</span></h2><div class="geo__cities">';
		foreach ( $country['cities'] as $city ) {
			$page  = get_page_by_path( 'kontakty/' . $key . '/' . $city['slug'] );
			$url   = $page ? get_permalink( $page ) : '#';
			$html .= '<a class="geo__city" href="' . esc_url( $url ) . '"><span class="geo__city-name">' . esc_html( $city['name'] ) . '</span>'
				. '<span class="geo__city-line">' . kp_icon( 'office' ) . esc_html( $city['office'][0] ) . '</span>'
				. '<span class="geo__city-line">' . kp_icon( 'warehouse' ) . esc_html( $city['stock'][0] ) . '</span>'
				. '<span class="geo__city-phone">' . esc_html( $city['phone'] ) . '</span></a>';
		}
		$html .= '</div></section>';
	}
	return $html . '</div>';
}
add_shortcode( 'contacts_directory', 'kp_contacts_directory_html' );

/**
 * [country_cities] — города текущей страны.
 */
add_shortcode( 'country_cities', function () {
	$key  = get_post_meta( get_the_ID(), '_kp_country', true );
	$data = kp_contacts_data();
	if ( ! $key || empty( $data[ $key ] ) ) {
		return '';
	}
	$html = '<div class="geo__cities geo__cities--wide">';
	foreach ( $data[ $key ]['cities'] as $city ) {
		$page  = get_page_by_path( 'kontakty/' . $key . '/' . $city['slug'] );
		$html .= '<div class="geo-card"><h3 class="geo-card__title">'
			. ( $page ? '<a href="' . esc_url( get_permalink( $page ) ) . '">' . esc_html( $city['name'] ) . '</a>' : esc_html( $city['name'] ) )
			. '</h3><div class="geo-card__region">' . esc_html( $city['region'] ) . '</div>'
			. kp_location_html( 'office', $city['office'] )
			. kp_location_html( 'stock', $city['stock'] )
			. '<a class="geo-card__phone" href="tel:' . esc_attr( kp_tel( $city['phone'] ) ) . '">' . esc_html( $city['phone'] ) . '</a></div>';
	}
	return $html . '</div>';
} );

/**
 * [city_contacts] — карточка филиала на странице города.
 */
add_shortcode( 'city_contacts', function () {
	$city = kp_current_city();
	if ( ! $city ) {
		return '';
	}
	return '<div class="city-locs">'
		. kp_location_html( 'office', $city['office'], $city['phone'] )
		. kp_location_html( 'stock', $city['stock'] )
		. '<div class="loc loc--hours"><div class="loc__icon">' . kp_icon( 'clock' ) . '</div><div class="loc__body">'
		. '<div class="loc__type">Режим работы</div><div class="loc__name">' . esc_html( kp_opt( 'kp_worktime' ) ) . '</div>'
		. '<div class="loc__addr">Отгрузка со склада — по предварительной заявке. Выезд инженера на объект — по согласованию.</div>'
		. '<a class="loc__phone" href="mailto:' . esc_attr( kp_opt( 'kp_email' ) ) . '">' . esc_html( kp_opt( 'kp_email' ) ) . '</a>'
		. '</div></div></div>';
} );

/**
 * Город текущей страницы.
 */
function kp_current_city( $post_id = 0 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$country = get_post_meta( $post_id, '_kp_country', true );
	$slug    = get_post_meta( $post_id, '_kp_city', true );
	return ( $country && $slug ) ? kp_city( $country, $slug ) : null;
}

/**
 * Schema.org LocalBusiness для страницы города.
 */
function kp_city_schema( $post_id ) {
	$city = kp_current_city( $post_id );
	if ( ! $city ) {
		return array();
	}
	$country = kp_contacts_data()[ get_post_meta( $post_id, '_kp_country', true ) ];
	$brand   = kp_opt( 'kp_brand' );
	$url     = get_permalink( $post_id );
	$out     = array();

	foreach ( array( 'office' => 'офис', 'stock' => 'склад' ) as $key => $label ) {
		$out[] = array(
			'@type'              => 'office' === $key ? 'LocalBusiness' : 'Store',
			'@id'                => $url . '#' . $key,
			'name'               => $brand . ' — ' . $label . ' ' . $city['in'],
			'parentOrganization' => array( '@id' => home_url( '/' ) . '#organization' ),
			'telephone'          => $city['phone'],
			'email'              => kp_opt( 'kp_email' ),
			'url'                => $url,
			'address'            => array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => $city[ $key ][1] . ( 'office' === $key ? ', ' . $city['office'][0] : '' ),
				'addressLocality' => $city['name'],
				'addressRegion'   => $city['region'],
				'addressCountry'  => $country['code'],
			),
			'openingHours'       => 'Mo-Fr 09:00-18:00',
		);
	}
	return $out;
}
