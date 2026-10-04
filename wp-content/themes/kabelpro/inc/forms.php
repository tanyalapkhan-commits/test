<?php
/**
 * Форма заявки: модальное окно + встроенная форма. Заявки отправляются на e-mail
 * и дублируются в админке (раздел «Заявки»), чтобы не потерялись при проблемах с почтой.
 *
 * @package kabelpro
 */

/**
 * Тип записи для хранения заявок.
 */
add_action( 'init', function () {
	register_post_type( 'kp_lead', array(
		'label'           => 'Заявки',
		'public'          => false,
		'show_ui'         => true,
		'menu_icon'       => 'dashicons-email-alt',
		'supports'        => array( 'title', 'editor' ),
		'capability_type' => 'post',
		'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'    => true,
	) );
} );

/**
 * HTML формы.
 */
function kp_form_html( $context = 'inline' ) {
	$sent = isset( $_GET['kp_sent'] ) ? sanitize_key( $_GET['kp_sent'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
	ob_start();
	?>
	<form class="form form--<?php echo esc_attr( $context ); ?>" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<?php if ( 'ok' === $sent && 'inline' === $context ) : ?>
			<div class="form__notice form__notice--ok">Спасибо! Заявка принята — инженер свяжется с вами в течение рабочего дня.</div>
		<?php elseif ( 'err' === $sent && 'inline' === $context ) : ?>
			<div class="form__notice form__notice--err">Не удалось отправить заявку. Пожалуйста, позвоните нам или попробуйте ещё раз.</div>
		<?php endif; ?>
		<input type="hidden" name="action" value="kp_request">
		<input type="hidden" name="kp_page" value="<?php echo esc_attr( is_singular() ? get_the_title() : '' ); ?>">
		<input type="hidden" name="kp_back" value="<?php echo esc_url( is_singular() ? get_permalink() : home_url( '/' ) ); ?>">
		<?php wp_nonce_field( 'kp_request', 'kp_nonce' ); ?>
		<div class="form__hp" aria-hidden="true"><label>Не заполняйте это поле<input type="text" name="kp_website" tabindex="-1" autocomplete="off"></label></div>
		<div class="form__row">
			<label class="field"><span class="field__label">Имя *</span><input class="field__input" type="text" name="kp_name" required autocomplete="name"></label>
			<label class="field"><span class="field__label">Телефон *</span><input class="field__input" type="tel" name="kp_phone" required autocomplete="tel" inputmode="tel"></label>
		</div>
		<div class="form__row">
			<label class="field"><span class="field__label">E-mail</span><input class="field__input" type="email" name="kp_email" autocomplete="email"></label>
			<label class="field"><span class="field__label">Город</span><input class="field__input" type="text" name="kp_city" autocomplete="address-level2"></label>
		</div>
		<label class="field"><span class="field__label">Задача: длина трассы, марка и сечение кабеля, нужна покупка или аренда</span>
			<textarea class="field__input" name="kp_message" rows="4"></textarea></label>
		<label class="check"><input type="checkbox" name="kp_agree" value="1" required> <span>Согласен на обработку персональных данных</span></label>
		<button class="btn btn--accent btn--block" type="submit">Отправить заявку</button>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode( 'request_form', function () {
	return kp_form_html( 'inline' );
} );

/**
 * Обработка формы.
 */
function kp_handle_request() {
	$back = isset( $_POST['kp_back'] ) ? esc_url_raw( wp_unslash( $_POST['kp_back'] ) ) : home_url( '/' );
	$back = wp_validate_redirect( $back, home_url( '/' ) );

	$valid = isset( $_POST['kp_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['kp_nonce'] ) ), 'kp_request' );
	$spam  = ! empty( $_POST['kp_website'] );
	$name  = isset( $_POST['kp_name'] ) ? sanitize_text_field( wp_unslash( $_POST['kp_name'] ) ) : '';
	$phone = isset( $_POST['kp_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['kp_phone'] ) ) : '';

	if ( ! $valid || $spam || ! $name || ! $phone ) {
		wp_safe_redirect( add_query_arg( 'kp_sent', 'err', $back ) . '#request-form' );
		exit;
	}

	$fields = array(
		'Имя'      => $name,
		'Телефон'  => $phone,
		'E-mail'   => isset( $_POST['kp_email'] ) ? sanitize_email( wp_unslash( $_POST['kp_email'] ) ) : '',
		'Город'    => isset( $_POST['kp_city'] ) ? sanitize_text_field( wp_unslash( $_POST['kp_city'] ) ) : '',
		'Сообщение' => isset( $_POST['kp_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['kp_message'] ) ) : '',
		'Страница' => ( isset( $_POST['kp_page'] ) ? sanitize_text_field( wp_unslash( $_POST['kp_page'] ) ) : '' ) . ' ' . $back,
	);

	$body = '';
	foreach ( $fields as $label => $value ) {
		$body .= $label . ': ' . $value . "\n";
	}

	wp_insert_post( array(
		'post_type'    => 'kp_lead',
		'post_status'  => 'private',
		'post_title'   => $name . ', ' . $phone,
		'post_content' => $body,
	) );

	$to   = kp_opt( 'kp_form_email' ) ? kp_opt( 'kp_form_email' ) : get_option( 'admin_email' );
	wp_mail( $to, 'Заявка с сайта ' . kp_opt( 'kp_brand' ) . ': ' . $name, $body );

	wp_safe_redirect( add_query_arg( 'kp_sent', 'ok', $back ) . '#request-form' );
	exit;
}
add_action( 'admin_post_nopriv_kp_request', 'kp_handle_request' );
add_action( 'admin_post_kp_request', 'kp_handle_request' );
