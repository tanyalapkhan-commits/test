<?php
/**
 * Хлебные крошки.
 *
 * @package kabelpro
 */

/**
 * Элементы цепочки: массив [ 'title' => ..., 'url' => ... ].
 */
function kp_breadcrumb_items() {
	$items = array(
		array(
			'title' => 'Главная',
			'url'   => home_url( '/' ),
		),
	);

	if ( is_singular() ) {
		$id = get_queried_object_id();
		foreach ( array_reverse( get_post_ancestors( $id ) ) as $ancestor ) {
			$label   = get_post_meta( $ancestor, '_kp_menu_label', true );
			$items[] = array(
				'title' => $label ? $label : get_the_title( $ancestor ),
				'url'   => get_permalink( $ancestor ),
			);
		}
		$items[] = array(
			'title' => get_the_title( $id ),
			'url'   => get_permalink( $id ),
		);
	} elseif ( is_search() ) {
		$items[] = array(
			'title' => 'Поиск: ' . get_search_query(),
			'url'   => get_search_link(),
		);
	} elseif ( is_404() ) {
		$items[] = array(
			'title' => 'Страница не найдена',
			'url'   => '',
		);
	}

	return $items;
}

/**
 * Вывод хлебных крошек.
 */
function kp_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	$items = kp_breadcrumb_items();
	$last  = count( $items ) - 1;

	echo '<nav class="crumbs" aria-label="Хлебные крошки"><ol class="crumbs__list">';
	foreach ( $items as $i => $item ) {
		if ( $i === $last || ! $item['url'] ) {
			echo '<li class="crumbs__item" aria-current="page"><span>' . esc_html( $item['title'] ) . '</span></li>';
		} else {
			echo '<li class="crumbs__item"><a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['title'] ) . '</a></li>';
		}
	}
	echo '</ol></nav>';
}
