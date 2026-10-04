<?php
/**
 * Подвал сайта.
 *
 * @package kabelpro
 */
?>
</main>

<section class="prefooter" id="request-form">
	<div class="container prefooter__inner">
		<div class="prefooter__text">
			<h2 class="prefooter__title">Рассчитаем тяжение и подберём оборудование</h2>
			<p>Опишите трассу и кабель — инженер подготовит расчёт усилия протяжки, схему расстановки роликов и предложение по покупке или аренде лебедки, прицепа и оснастки. Ответ — в течение рабочего дня.</p>
			<ul class="ticks">
				<li><?php echo kp_icon( 'check' ); // phpcs:ignore ?> Склады в <?php echo esc_html( count( kp_contacts_data() ) ); ?> странах СНГ</li>
				<li><?php echo kp_icon( 'check' ); // phpcs:ignore ?> Аренда от 1 суток</li>
				<li><?php echo kp_icon( 'check' ); // phpcs:ignore ?> Шеф-монтаж и обучение бригад</li>
			</ul>
		</div>
		<div class="prefooter__form"><?php echo kp_form_html( 'inline' ); // phpcs:ignore ?></div>
	</div>
</section>

<footer class="footer">
	<div class="container footer__grid">
		<div class="footer__col footer__col--brand">
			<a class="logo logo--light" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="logo__mark"><?php echo kp_icon( 'drum' ); // phpcs:ignore ?></span>
				<span class="logo__text"><span class="logo__name"><?php echo esc_html( kp_opt( 'kp_brand' ) ); ?></span><span class="logo__sub">оборудование для прокладки кабеля</span></span>
			</a>
			<p class="footer__about">Кабельные лебедки, прицепы для барабанов, ролики, УЗК и инструмент для прокладки силовых и оптических кабелей. Продажа, аренда, сервис и обучение — в России и странах СНГ.</p>
			<a class="footer__phone" href="tel:<?php echo esc_attr( kp_tel( kp_opt( 'kp_phone' ) ) ); ?>"><?php echo esc_html( kp_opt( 'kp_phone' ) ); ?></a>
			<a class="footer__mail" href="mailto:<?php echo esc_attr( kp_opt( 'kp_email' ) ); ?>"><?php echo esc_html( kp_opt( 'kp_email' ) ); ?></a>
			<div class="social">
				<?php
				$socials = array(
					'kp_telegram' => 'Telegram',
					'kp_whatsapp' => 'WhatsApp',
					'kp_vk'       => 'ВКонтакте',
					'kp_youtube'  => 'YouTube',
					'kp_rutube'   => 'Rutube',
				);
				foreach ( $socials as $key => $label ) {
					$url = kp_opt( $key );
					if ( $url ) {
						echo '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener">' . esc_html( $label ) . '</a>';
					}
				}
				?>
			</div>
		</div>

		<div class="footer__col">
			<div class="footer__title">Разделы</div>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'footer__menu',
					'depth'          => 1,
				) );
			}
			?>
		</div>

		<div class="footer__col">
			<div class="footer__title">Оборудование</div>
			<?php
			$equipment = get_page_by_path( 'oborudovanie' );
			if ( $equipment ) {
				echo '<ul class="footer__menu">';
				foreach ( kp_child_pages( $equipment->ID ) as $child ) {
					$label = get_post_meta( $child->ID, '_kp_menu_label', true );
					echo '<li><a href="' . esc_url( get_permalink( $child ) ) . '">' . esc_html( $label ? $label : get_the_title( $child ) ) . '</a></li>';
				}
				echo '</ul>';
			}
			?>
		</div>

		<div class="footer__col">
			<div class="footer__title">Филиалы</div>
			<ul class="footer__menu footer__menu--geo">
				<?php foreach ( kp_contacts_data() as $key => $country ) : ?>
					<li><a href="<?php echo esc_url( home_url( '/kontakty/' . $key . '/' ) ); ?>"><?php echo esc_html( $country['name'] ); ?></a>
						<span><?php echo esc_html( implode( ', ', wp_list_pluck( $country['cities'], 'name' ) ) ); ?></span></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>

	<div class="footer__bottom">
		<div class="container footer__bottom-inner">
			<span>© <?php echo esc_html( kp_opt( 'kp_founded' ) . '–' . gmdate( 'Y' ) . ' ' . kp_opt( 'kp_legal' ) ); ?>. Информация на сайте не является публичной офертой.</span>
			<a href="<?php echo esc_url( home_url( '/o-kompanii/politika-konfidencialnosti/' ) ); ?>">Политика конфиденциальности</a>
		</div>
	</div>
</footer>

<div class="modal" id="request" role="dialog" aria-modal="true" aria-labelledby="request-title" hidden>
	<div class="modal__overlay" data-close></div>
	<div class="modal__box">
		<button class="modal__close" type="button" data-close aria-label="Закрыть"><?php echo kp_icon( 'close' ); // phpcs:ignore ?></button>
		<div class="modal__title" id="request-title">Запрос цены и подбор оборудования</div>
		<p class="modal__text">Ответим в течение рабочего дня. Можно приложить схему трассы в ответном письме.</p>
		<?php echo kp_form_html( 'modal' ); // phpcs:ignore ?>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
