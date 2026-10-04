<?php
/**
 * Результаты поиска.
 *
 * @package kabelpro
 */

get_header();
?>
<section class="page-hero">
	<div class="container page-hero__inner">
		<?php kp_breadcrumbs(); ?>
		<h1 class="page-hero__title">Поиск: «<?php echo esc_html( get_search_query() ); ?>»</h1>
	</div>
</section>
<div class="container layout">
	<div class="layout__main content">
		<?php if ( have_posts() ) : ?>
			<div class="cards">
				<?php
				while ( have_posts() ) {
					the_post();
					echo kp_card_html( get_post() ); // phpcs:ignore
				}
				?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p>По запросу ничего не найдено. Попробуйте другую формулировку или позвоните нам: <?php echo do_shortcode( '[phone]' ); // phpcs:ignore ?>.</p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();
