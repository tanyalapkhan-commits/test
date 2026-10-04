<?php
/**
 * КабельПро — функции темы.
 *
 * @package kabelpro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'KP_VERSION', '1.0.0' );
define( 'KP_DIR', get_template_directory() );
define( 'KP_URI', get_template_directory_uri() );

require KP_DIR . '/inc/helpers.php';
require KP_DIR . '/inc/customizer.php';
require KP_DIR . '/inc/megamenu.php';
require KP_DIR . '/inc/seo.php';
require KP_DIR . '/inc/breadcrumbs.php';
require KP_DIR . '/inc/content.php';
require KP_DIR . '/inc/photos.php';
require KP_DIR . '/inc/contacts.php';
require KP_DIR . '/inc/forms.php';
require KP_DIR . '/inc/importer.php';

/**
 * Базовые возможности темы.
 */
function kp_setup() {
	load_theme_textdomain( 'kabelpro', KP_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 220,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );

	add_post_type_support( 'page', 'excerpt' );

	register_nav_menus( array(
		'primary' => 'Главное мега-меню',
		'top'     => 'Верхнее меню (над шапкой)',
		'footer'  => 'Меню в подвале',
	) );

	add_image_size( 'kp-hero', 1920, 900, true );
	add_image_size( 'kp-card', 640, 480, true );
}
add_action( 'after_setup_theme', 'kp_setup' );

/**
 * Стили и скрипты.
 */
function kp_assets() {
	wp_enqueue_style( 'kabelpro', KP_URI . '/assets/css/main.css', array(), KP_VERSION );
	wp_enqueue_script( 'kabelpro', KP_URI . '/assets/js/main.js', array(), KP_VERSION, true );

	// Блочные стили WordPress на сайте не используются — экономим запрос.
	if ( ! is_admin() ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'global-styles' );
		wp_dequeue_style( 'classic-theme-styles' );
	}
}
add_action( 'wp_enqueue_scripts', 'kp_assets', 20 );

/**
 * Чистим <head> от лишнего (эмодзи, RSD, генератор).
 */
function kp_cleanup_head() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
}
add_action( 'init', 'kp_cleanup_head' );

/**
 * Области виджетов.
 */
function kp_widgets() {
	register_sidebar( array(
		'name'          => 'Боковая колонка страниц',
		'id'            => 'page-sidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget__title">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'kp_widgets' );
