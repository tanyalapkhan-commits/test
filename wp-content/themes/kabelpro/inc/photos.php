<?php
/**
 * Фото-слоты.
 *
 * Каждое фото на сайте адресуется «слотом» — коротким именем вида winch-petrol-1.
 * Файл ищется по порядку:
 *   1) wp-content/uploads/kp-photos/{slot}.(webp|jpg|jpeg|png)
 *   2) wp-content/themes/kabelpro/assets/img/photos/{slot}.(webp|jpg|jpeg|png)
 * Если файла нет — выводится аккуратная заглушка с названием сюжета.
 *
 * Список всех 120 слотов, alt-тексты и промпты для генерации — data/photo-plan.json
 * (человекочитаемая версия — docs/photo-prompts.md). Нарезка полотен 8K на отдельные
 * фото — tools/slice_canvases.py.
 *
 * @package kabelpro
 */

/**
 * План фотографий: slot => [alt, ...].
 */
function kp_photo_plan() {
	static $plan = null;
	if ( null === $plan ) {
		$plan = array();
		$file = KP_DIR . '/data/photo-plan.json';
		if ( file_exists( $file ) ) {
			$json = json_decode( file_get_contents( $file ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions
			if ( ! empty( $json['canvases'] ) ) {
				foreach ( $json['canvases'] as $canvas ) {
					foreach ( $canvas['photos'] as $photo ) {
						$plan[ $photo['slot'] ] = $photo;
					}
				}
			}
		}
	}
	return $plan;
}

/**
 * Alt-текст для слота.
 */
function kp_photo_alt( $slot ) {
	$plan = kp_photo_plan();
	if ( isset( $plan[ $slot ]['alt'] ) ) {
		return $plan[ $slot ]['alt'];
	}
	$aliases = kp_photo_aliases();
	return ( isset( $aliases[ $slot ] ) && isset( $plan[ $aliases[ $slot ] ]['alt'] ) ) ? $plan[ $aliases[ $slot ] ]['alt'] : '';
}

/**
 * Путь и URL файла слота или null.
 */
function kp_photo_file( $slot ) {
	static $cache = array();
	if ( isset( $cache[ $slot ] ) ) {
		return $cache[ $slot ];
	}

	$slot    = sanitize_file_name( $slot );
	$uploads = wp_get_upload_dir();
	$bases   = array(
		array( trailingslashit( $uploads['basedir'] ) . 'kp-photos/', trailingslashit( $uploads['baseurl'] ) . 'kp-photos/' ),
		array( KP_DIR . '/assets/img/photos/', KP_URI . '/assets/img/photos/' ),
	);

	foreach ( $bases as $base ) {
		foreach ( array( 'webp', 'jpg', 'jpeg', 'png' ) as $ext ) {
			if ( file_exists( $base[0] . $slot . '.' . $ext ) ) {
				$cache[ $slot ] = array(
					'path' => $base[0] . $slot . '.' . $ext,
					'url'  => $base[1] . $slot . '.' . $ext,
				);
				return $cache[ $slot ];
			}
		}
	}

	// Своего фото нет — пробуем близкое по смыслу из data/photo-aliases.json.
	$aliases = kp_photo_aliases();
	if ( isset( $aliases[ $slot ] ) && $aliases[ $slot ] !== $slot ) {
		$cache[ $slot ] = kp_photo_file( $aliases[ $slot ] );
		return $cache[ $slot ];
	}

	$cache[ $slot ] = null;
	return null;
}

/**
 * Карта замен: слот без собственного фото => слот с подходящим фото.
 */
function kp_photo_aliases() {
	static $aliases = null;
	if ( null === $aliases ) {
		$file    = KP_DIR . '/data/photo-aliases.json';
		$aliases = file_exists( $file ) ? (array) json_decode( file_get_contents( $file ), true ) : array(); // phpcs:ignore WordPress.WP.AlternativeFunctions
	}
	return $aliases;
}

function kp_photo_url( $slot ) {
	$file = kp_photo_file( $slot );
	return $file ? $file['url'] : '';
}

/**
 * <img> для слота (или заглушка).
 */
function kp_photo_img( $slot, $alt = '', $class = '', $eager = false ) {
	$file = kp_photo_file( $slot );
	$alt  = $alt ? $alt : kp_photo_alt( $slot );

	if ( ! $file ) {
		return '<span class="ph ' . esc_attr( $class ) . '" role="img" aria-label="' . esc_attr( $alt ) . '">'
			. '<span class="ph__icon">' . kp_icon( 'camera' ) . '</span>'
			. '<span class="ph__label">' . esc_html( $alt ? $alt : $slot ) . '</span>'
			. '<span class="ph__slot">' . esc_html( $slot ) . '</span></span>';
	}

	$size = @getimagesize( $file['path'] ); // phpcs:ignore WordPress.PHP.NoSilencedErrors
	$dims = $size ? sprintf( ' width="%d" height="%d"', $size[0], $size[1] ) : '';

	return sprintf(
		'<img class="%1$s" src="%2$s" alt="%3$s"%4$s %5$s decoding="async">',
		esc_attr( $class ),
		esc_url( $file['url'] ),
		esc_attr( $alt ),
		$dims,
		$eager ? 'fetchpriority="high"' : 'loading="lazy"'
	);
}
