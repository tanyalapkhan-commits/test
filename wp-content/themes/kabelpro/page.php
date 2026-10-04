<?php
/**
 * Шаблон страницы: обложка с H1, хлебные крошки, оглавление, текст, подразделы.
 *
 * @package kabelpro
 */

get_header();

while ( have_posts() ) :
	the_post();

	$page_id  = get_the_ID();
	$slot     = get_post_meta( $page_id, '_kp_photo', true );
	$raw      = get_the_content();
	$content  = apply_filters( 'the_content', $raw );
	$toc      = kp_toc_html();
	$children = kp_child_pages( $page_id );
	$is_city  = (bool) get_post_meta( $page_id, '_kp_city', true );
	?>
	<section class="page-hero<?php echo $slot ? ' page-hero--photo' : ''; ?>">
		<?php if ( $slot ) : ?>
			<div class="page-hero__bg"><?php echo kp_photo_img( $slot, get_the_title(), 'page-hero__img', true ); // phpcs:ignore ?></div>
		<?php endif; ?>
		<div class="container page-hero__inner">
			<?php kp_breadcrumbs(); ?>
			<h1 class="page-hero__title"><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p class="page-hero__lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
			<div class="page-hero__actions">
				<a class="btn btn--accent" href="#request" data-modal="request">Запросить цену</a>
				<a class="btn btn--ghost" href="tel:<?php echo esc_attr( kp_tel( kp_opt( 'kp_phone' ) ) ); ?>"><?php echo kp_icon( 'phone' ); // phpcs:ignore ?> <?php echo esc_html( kp_opt( 'kp_phone' ) ); ?></a>
			</div>
		</div>
	</section>

	<?php if ( $children && false === strpos( $raw, '[children' ) && ! get_post_meta( $page_id, '_kp_country', true ) ) : ?>
		<section class="section section--tight">
			<div class="container">
				<div class="cards"><?php foreach ( $children as $child ) { echo kp_card_html( $child ); } // phpcs:ignore ?></div>
			</div>
		</section>
	<?php endif; ?>

	<div class="container layout<?php echo $toc ? ' layout--toc' : ''; ?>">
		<?php if ( $toc ) : ?>
			<aside class="layout__aside">
				<div class="sticky">
					<?php echo $toc; // phpcs:ignore ?>
					<div class="aside-cta">
						<div class="aside-cta__title">Нужен расчёт?</div>
						<p>Подберём лебедку и комплект оснастки под вашу трассу.</p>
						<a class="btn btn--accent btn--block" href="#request" data-modal="request">Оставить заявку</a>
					</div>
				</div>
			</aside>
		<?php endif; ?>
		<article class="layout__main content<?php echo $is_city ? ' content--city' : ''; ?>">
			<?php echo $content; // phpcs:ignore ?>
		</article>
	</div>

	<?php
	// Перелинковка: соседние страницы того же уровня.
	$parent = wp_get_post_parent_id( $page_id );
	if ( $parent ) {
		$siblings = array_filter( kp_child_pages( $parent ), function ( $p ) use ( $page_id ) {
			return $p->ID !== $page_id;
		} );
		if ( $siblings ) {
			echo '<section class="section section--alt"><div class="container"><h2 class="section__title">Смотрите также</h2><div class="cards cards--compact">';
			foreach ( array_slice( $siblings, 0, 8 ) as $sibling ) {
				echo kp_card_html( $sibling ); // phpcs:ignore
			}
			echo '</div></div></section>';
		}
	}
endwhile;

get_footer();
