<?php
/**
 * Мега-меню: до 4 уровней вложенности.
 *
 * Уровень 1 — пункты шапки.
 * Уровень 2 — колонки выпадающей панели (заголовки разделов).
 * Уровень 3 — ссылки внутри колонки.
 * Уровень 4 — вложенные ссылки под пунктом 3-го уровня.
 *
 * На мобильных панель превращается в аккордеон с кнопками раскрытия на каждом уровне.
 *
 * @package kabelpro
 */

class KP_Mega_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( 0 === $depth ) {
			$output .= '<div class="mega__panel"><div class="container mega__inner"><ul class="mega__cols">';
			return;
		}
		$output .= '<ul class="mega__list mega__list--d' . ( $depth + 1 ) . '">';
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		if ( 0 === $depth ) {
			$output .= '</ul>' . $this->panel_footer() . '</div></div>';
			return;
		}
		$output .= '</ul>';
	}

	/**
	 * Нижняя полоса панели с призывом к действию.
	 */
	private function panel_footer() {
		return '<div class="mega__aside">'
			. '<div class="mega__aside-title">Нужна помощь с подбором?</div>'
			. '<p>Инженер подберёт лебедку, ролики и прицеп под вашу трассу за 1 рабочий день.</p>'
			. '<a class="btn btn--accent btn--sm" href="#request" data-modal="request">Получить подбор</a>'
			. '<a class="mega__aside-phone" href="tel:' . esc_attr( kp_tel( kp_opt( 'kp_phone' ) ) ) . '">' . esc_html( kp_opt( 'kp_phone' ) ) . '</a>'
			. '</div>';
	}

	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$has_kids  = in_array( 'menu-item-has-children', $classes, true );
		$classes[] = 'mega__item';
		$classes[] = 'mega__item--d' . ( $depth + 1 );
		if ( $has_kids ) {
			$classes[] = 'has-children';
		}

		$class_names = implode( ' ', array_filter( array_map( 'sanitize_html_class', $classes ) ) );
		$output     .= '<li class="' . esc_attr( $class_names ) . '">';

		$atts = array(
			'href'  => ! empty( $item->url ) ? $item->url : '',
			'class' => 'mega__link mega__link--d' . ( $depth + 1 ),
		);
		if ( ! empty( $item->attr_title ) ) {
			$atts['title'] = $item->attr_title;
		}
		if ( in_array( 'current-menu-item', $classes, true ) ) {
			$atts['aria-current'] = 'page';
		}

		$attr_html = '';
		foreach ( $atts as $attr => $value ) {
			if ( '' !== $value ) {
				$value      = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attr_html .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title   = apply_filters( 'the_title', $item->title, $item->ID );
		$output .= '<a' . $attr_html . '>' . esc_html( $title ) . '</a>';

		if ( $has_kids ) {
			$output .= '<button class="mega__toggle" type="button" aria-expanded="false" aria-label="Раскрыть: ' . esc_attr( $title ) . '">'
				. kp_icon( 'chevron' ) . '</button>';
		}
	}

	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= '</li>';
	}
}

/**
 * Вывод главного меню. Если меню ещё не назначено — строим его из дерева страниц.
 */
function kp_primary_menu() {
	if ( has_nav_menu( 'primary' ) ) {
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'mega',
			'menu_id'        => 'mega',
			'depth'          => 4,
			'walker'         => new KP_Mega_Walker(),
			'fallback_cb'    => false,
		) );
		return;
	}

	echo '<ul class="mega" id="mega">';
	wp_list_pages( array(
		'title_li' => '',
		'depth'    => 4,
		'walker'   => new KP_Page_Mega_Walker(),
		'exclude'  => (int) get_option( 'page_on_front' ),
	) );
	echo '</ul>';
}

/**
 * Запасной вариант: мега-меню из иерархии страниц (до импорта меню).
 */
class KP_Page_Mega_Walker extends Walker_Page {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 0 === $depth ) {
			$output .= '<div class="mega__panel"><div class="container mega__inner"><ul class="mega__cols">';
			return;
		}
		$output .= '<ul class="mega__list mega__list--d' . ( $depth + 1 ) . '">';
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= ( 0 === $depth ) ? '</ul></div></div>' : '</ul>';
	}

	public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		$has_kids = ! empty( $args['has_children'] );
		$output  .= '<li class="mega__item mega__item--d' . ( $depth + 1 ) . ( $has_kids ? ' has-children' : '' ) . '">';
		$label    = get_post_meta( $page->ID, '_kp_menu_label', true );
		$output  .= '<a class="mega__link mega__link--d' . ( $depth + 1 ) . '" href="' . esc_url( get_permalink( $page->ID ) ) . '">'
			. esc_html( $label ? $label : $page->post_title ) . '</a>';
		if ( $has_kids ) {
			$output .= '<button class="mega__toggle" type="button" aria-expanded="false" aria-label="Раскрыть">' . kp_icon( 'chevron' ) . '</button>';
		}
	}

	public function end_el( &$output, $page, $depth = 0, $args = array() ) {
		$output .= '</li>';
	}
}
