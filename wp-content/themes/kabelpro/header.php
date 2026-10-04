<?php
/**
 * Шапка сайта.
 *
 * @package kabelpro
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no">
<link rel="icon" href="<?php echo esc_url( KP_URI . '/assets/img/favicon.svg' ); ?>" type="image/svg+xml">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php get_template_part( 'template-parts/icons' ); ?>
<a class="skip-link" href="#main">Перейти к содержимому</a>

<div class="topbar">
	<div class="container topbar__inner">
		<div class="topbar__tagline"><?php echo esc_html( kp_opt( 'kp_tagline' ) ); ?> — Россия и страны СНГ</div>
		<nav class="topbar__links" aria-label="Служебное меню">
			<a href="<?php echo esc_url( home_url( '/kontakty/' ) ); ?>"><?php echo kp_icon( 'pin' ); // phpcs:ignore ?> <?php echo esc_html( count( kp_contacts_data() ) ); ?> стран, филиалы с офисом и складом</a>
			<a href="<?php echo esc_url( home_url( '/arenda/' ) ); ?>">Аренда</a>
			<a href="<?php echo esc_url( home_url( '/servis/' ) ); ?>">Сервис</a>
			<a href="mailto:<?php echo esc_attr( kp_opt( 'kp_email' ) ); ?>"><?php echo esc_html( kp_opt( 'kp_email' ) ); ?></a>
		</nav>
	</div>
</div>

<header class="header" id="header">
	<div class="container header__inner">
		<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( kp_opt( 'kp_brand' ) ); ?> — на главную">
			<?php if ( has_custom_logo() ) : ?>
				<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, array( 'class' => 'logo__img' ) ); ?>
			<?php else : ?>
				<span class="logo__mark"><?php echo kp_icon( 'drum' ); // phpcs:ignore ?></span>
				<span class="logo__text"><span class="logo__name"><?php echo esc_html( kp_opt( 'kp_brand' ) ); ?></span><span class="logo__sub">оборудование для прокладки кабеля</span></span>
			<?php endif; ?>
		</a>

		<form class="search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="s">Поиск по сайту</label>
			<input class="search__input" id="s" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Лебедка, ролик, прицеп, технология…">
			<button class="search__btn" type="submit" aria-label="Найти"><?php echo kp_icon( 'search' ); // phpcs:ignore ?></button>
		</form>

		<div class="header__contacts">
			<a class="header__phone" href="tel:<?php echo esc_attr( kp_tel( kp_opt( 'kp_phone' ) ) ); ?>"><?php echo esc_html( kp_opt( 'kp_phone' ) ); ?></a>
			<span class="header__worktime"><?php echo esc_html( kp_opt( 'kp_worktime' ) ); ?></span>
		</div>

		<a class="btn btn--accent header__cta" href="#request" data-modal="request">Запросить цену</a>

		<button class="burger" type="button" aria-controls="nav" aria-expanded="false" aria-label="Открыть меню">
			<span></span><span></span><span></span>
		</button>
	</div>

	<nav class="nav" id="nav" aria-label="Главное меню">
		<div class="container nav__inner">
			<?php kp_primary_menu(); ?>
		</div>
	</nav>
</header>

<main id="main" class="main">
