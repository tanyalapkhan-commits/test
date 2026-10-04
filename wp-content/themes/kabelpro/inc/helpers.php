<?php
/**
 * Вспомогательные функции.
 *
 * @package kabelpro
 */

/**
 * Значение настройки темы с дефолтом из kp_defaults().
 */
function kp_opt( $key ) {
	$defaults = kp_defaults();
	return get_theme_mod( $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

/**
 * Значения по умолчанию для всех настроек Customizer.
 */
function kp_defaults() {
	return array(
		'kp_brand'        => 'КабельПро',
		'kp_tagline'      => 'Оборудование и технологии для прокладки кабеля',
		'kp_phone'        => '8 800 000-00-00',
		'kp_email'        => 'info@example.ru',
		'kp_worktime'     => 'Пн–Пт 9:00–18:00',
		'kp_legal'        => 'ООО «КабельПро»',
		'kp_telegram'     => '',
		'kp_whatsapp'     => '',
		'kp_vk'           => '',
		'kp_youtube'      => '',
		'kp_rutube'       => '',
		'kp_founded'      => '2009',
		'kp_metrika_id'   => '',
		'kp_gtag_id'      => '',
		'kp_yandex_verif' => '',
		'kp_google_verif' => '',
		'kp_form_email'   => '',
	);
}

/**
 * Телефон в формате для ссылки tel:.
 */
function kp_tel( $phone ) {
	$digits = preg_replace( '/[^\d+]/', '', $phone );
	if ( 0 === strpos( $digits, '8' ) && 11 === strlen( $digits ) ) {
		$digits = '+7' . substr( $digits, 1 );
	}
	return $digits;
}

/**
 * Иконка из встроенного SVG-спрайта.
 */
function kp_icon( $name, $class = '' ) {
	return sprintf(
		'<svg class="icon icon-%1$s %2$s" aria-hidden="true" focusable="false"><use href="#i-%1$s"></use></svg>',
		esc_attr( $name ),
		esc_attr( $class )
	);
}

/**
 * Количество символов без пробелов (для контроля объёма текстов).
 */
function kp_chars_no_spaces( $html ) {
	$text = wp_strip_all_tags( strip_shortcodes( $html ) );
	$text = html_entity_decode( $text, ENT_QUOTES, 'UTF-8' );
	$text = preg_replace( '/\s+/u', '', $text );
	return mb_strlen( $text, 'UTF-8' );
}

/**
 * Дочерние опубликованные страницы.
 */
function kp_child_pages( $parent_id, $limit = -1 ) {
	return get_pages( array(
		'parent'      => $parent_id,
		'sort_column' => 'menu_order,post_title',
		'number'      => $limit > 0 ? $limit : '',
		'post_status' => 'publish',
	) );
}

/**
 * Короткое описание страницы для карточек.
 */
function kp_page_teaser( $page, $words = 26 ) {
	if ( has_excerpt( $page ) ) {
		return get_the_excerpt( $page );
	}
	$desc = get_post_meta( $page->ID, '_kp_description', true );
	if ( $desc ) {
		return $desc;
	}
	return wp_trim_words( wp_strip_all_tags( strip_shortcodes( $page->post_content ) ), $words, '…' );
}
