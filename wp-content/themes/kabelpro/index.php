<?php
/**
 * Запасной шаблон (записи, архивы).
 *
 * @package kabelpro
 */

get_header();
?>
<section class="page-hero">
	<div class="container page-hero__inner">
		<?php kp_breadcrumbs(); ?>
		<h1 class="page-hero__title"><?php echo is_singular() ? esc_html( get_the_title() ) : esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?></h1>
	</div>
</section>
<div class="container layout">
	<div class="layout__main content">
		<?php
		if ( is_singular() ) {
			while ( have_posts() ) {
				the_post();
				the_content();
			}
		} elseif ( have_posts() ) {
			echo '<div class="cards">';
			while ( have_posts() ) {
				the_post();
				echo kp_card_html( get_post() ); // phpcs:ignore
			}
			echo '</div>';
			the_posts_pagination();
		} else {
			echo '<p>Записей пока нет.</p>';
		}
		?>
	</div>
</div>
<?php
get_footer();
