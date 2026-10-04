<?php
/**
 * Настройки темы в «Внешний вид → Настроить».
 *
 * @package kabelpro
 */

function kp_customize_register( $wp_customize ) {
	$wp_customize->add_panel( 'kp_panel', array(
		'title'    => 'КабельПро: настройки сайта',
		'priority' => 20,
	) );

	$sections = array(
		'kp_company' => array(
			'title'  => 'Компания и контакты',
			'fields' => array(
				'kp_brand'    => 'Название бренда (подставляется во все тексты через [brand])',
				'kp_tagline'  => 'Слоган в шапке',
				'kp_legal'    => 'Юридическое название',
				'kp_phone'    => 'Единый телефон',
				'kp_email'    => 'E-mail',
				'kp_worktime' => 'Режим работы',
				'kp_founded'  => 'Год основания',
			),
		),
		'kp_social'  => array(
			'title'  => 'Мессенджеры и соцсети',
			'fields' => array(
				'kp_telegram' => 'Telegram (ссылка)',
				'kp_whatsapp' => 'WhatsApp (ссылка)',
				'kp_vk'       => 'ВКонтакте (ссылка)',
				'kp_youtube'  => 'YouTube (ссылка)',
				'kp_rutube'   => 'Rutube (ссылка)',
			),
		),
		'kp_seo'     => array(
			'title'  => 'SEO и аналитика',
			'fields' => array(
				'kp_metrika_id'   => 'ID счётчика Яндекс.Метрики',
				'kp_gtag_id'      => 'ID Google Analytics 4 (G-XXXX)',
				'kp_yandex_verif' => 'Код подтверждения Яндекс.Вебмастер',
				'kp_google_verif' => 'Код подтверждения Google Search Console',
				'kp_form_email'   => 'E-mail для заявок с форм (по умолчанию — e-mail администратора)',
			),
		),
	);

	$defaults = kp_defaults();
	$priority = 10;

	foreach ( $sections as $section_id => $section ) {
		$wp_customize->add_section( $section_id, array(
			'title' => $section['title'],
			'panel' => 'kp_panel',
		) );

		foreach ( $section['fields'] as $key => $label ) {
			$wp_customize->add_setting( $key, array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => ( false !== strpos( $key, 'email' ) ) ? 'sanitize_email' : 'sanitize_text_field',
			) );
			$wp_customize->add_control( $key, array(
				'label'    => $label,
				'section'  => $section_id,
				'type'     => 'text',
				'priority' => $priority++,
			) );
		}
	}
}
add_action( 'customize_register', 'kp_customize_register' );
