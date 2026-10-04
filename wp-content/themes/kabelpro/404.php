<?php
/**
 * Страница 404.
 *
 * @package kabelpro
 */

get_header();
?>
<section class="page-hero">
	<div class="container page-hero__inner">
		<?php kp_breadcrumbs(); ?>
		<h1 class="page-hero__title">Страница не найдена</h1>
		<p class="page-hero__lead">Возможно, страница переехала. Воспользуйтесь поиском или перейдите в нужный раздел.</p>
	</div>
</section>
<section class="section">
	<div class="container">
		<div class="cards">
			<?php
			$front = (int) get_option( 'page_on_front' );
			foreach ( kp_child_pages( 0 ) as $p ) {
				if ( $p->ID !== $front ) {
					echo kp_card_html( $p ); // phpcs:ignore
				}
			}
			?>
		</div>
	</div>
</section>
<?php
get_footer();
