<?php
/**
 * BigDIAMOND White Prestige – Assets loader
 * - Główne CSS motywu
 * - Woo CSS tylko na stronach sklepu
 * - header.js (burger/search/cart toast)
 * - opcjonalnie main.js
 */

declare(strict_types=1);

if ( ! defined('ABSPATH') ) exit;

// Bezpieczne definicje, gdyby nie było ich w functions.php
if ( ! defined('BIGDIAMOND_WHITE_PRESTIGE_URI') ) {
	define('BIGDIAMOND_WHITE_PRESTIGE_URI', get_stylesheet_directory_uri());
}
if ( ! defined('BIGDIAMOND_WHITE_PRESTIGE_DIR') ) {
	define('BIGDIAMOND_WHITE_PRESTIGE_DIR', get_stylesheet_directory());
}

// Wersjonowanie zasobów przez mtime (cache-busting w dev)
if ( ! function_exists('bdwp_asset_ver') ) {
	function bdwp_asset_ver(string $rel): string {
		$path = BIGDIAMOND_WHITE_PRESTIGE_DIR . $rel;
		return file_exists($path) ? (string) filemtime($path) : '1.0.0';
	}
}

/**
 * Enqueue CSS/JS – po GeneratePress/Woo (wyższy priorytet)
 */
add_action('wp_enqueue_scripts', 'bigdiamond_white_prestige_enqueue_assets', 60);

function bigdiamond_white_prestige_enqueue_assets(): void {

	/**
	 * === Critical CSS (inline) ===
	 * Preload najważniejszych zmiennych i fontów, aby ograniczyć CLS.
	 */
	$critical_rel = '/assets/css/critical-core.css';
	if ( file_exists( BIGDIAMOND_WHITE_PRESTIGE_DIR . $critical_rel ) ) {
		$critical_css = file_get_contents( BIGDIAMOND_WHITE_PRESTIGE_DIR . $critical_rel );
		if ( false !== $critical_css ) {
			wp_register_style( 'bdwp-critical-core', false, [], bdwp_asset_ver( $critical_rel ) );
			wp_enqueue_style( 'bdwp-critical-core' );
			wp_add_inline_style( 'bdwp-critical-core', $critical_css );
		}
	}

	/**
	 * === CSS główny motywu potomnego ===
	 */
	$main_css_rel = '/assets/css/white-prestige.css';
	if ( file_exists( BIGDIAMOND_WHITE_PRESTIGE_DIR . $main_css_rel ) ) {
		wp_enqueue_style(
			'bdwp-white-prestige',
			BIGDIAMOND_WHITE_PRESTIGE_URI . $main_css_rel,
			wp_style_is( 'bdwp-critical-core', 'enqueued' ) ? [ 'bdwp-critical-core' ] : ( wp_style_is( 'generate-style', 'registered' ) ? [ 'generate-style' ] : [] ),
			bdwp_asset_ver( $main_css_rel )
		);
	}

	/**
	 * === WooCommerce CSS tylko na stronach sklepu ===
	 * (shop, product, category/tag, cart/checkout/account)
	 */
	$is_woo = function_exists('is_woocommerce') && (
		is_woocommerce() || is_cart() || is_checkout() || is_account_page() ||
		is_shop() || is_product() || is_product_category() || is_product_tag()
	);

	if ( $is_woo ) {
		// Preferuj woo.min.css, w razie braku — woo.css
		$woo_candidates = ['/assets/css/woo.min.css', '/assets/css/woo.css'];
		foreach ( $woo_candidates as $woo_css_rel ) {
			if ( file_exists(BIGDIAMOND_WHITE_PRESTIGE_DIR . $woo_css_rel) ) {
				wp_enqueue_style(
					'bdwp-woo',
					BIGDIAMOND_WHITE_PRESTIGE_URI . $woo_css_rel,
					[ 'bdwp-white-prestige' ],
					bdwp_asset_ver($woo_css_rel)
				);
				break;
			}
		}
	} else {
		// Odciąż Woo/Blocks na stronach nie-sklepowych
		wp_dequeue_style('woocommerce-layout');
		wp_dequeue_style('woocommerce-smallscreen');
		wp_dequeue_style('woocommerce-general');
		wp_dequeue_style('wc-blocks-style');
		wp_dequeue_style('wc-blocks-vendors-style');

		wp_dequeue_script('wc-add-to-cart');
		wp_dequeue_script('woocommerce');
		wp_dequeue_script('wc-cart-fragments');
	}

	$theme_styles = [
		'bdwp-main' => '/assets/css/main.min.css',
		'bdwp-blog' => '/assets/css/blog.min.css',
	];

	if ( file_exists( BIGDIAMOND_WHITE_PRESTIGE_DIR . $theme_styles['bdwp-main'] ) ) {
		wp_enqueue_style(
			'bdwp-main',
			BIGDIAMOND_WHITE_PRESTIGE_URI . $theme_styles['bdwp-main'],
			[ 'bdwp-white-prestige' ],
			bdwp_asset_ver( $theme_styles['bdwp-main'] )
		);
	}

	if ( file_exists( BIGDIAMOND_WHITE_PRESTIGE_DIR . $theme_styles['bdwp-blog'] ) && ( is_home() || is_singular( 'post' ) || is_category() || is_tag() || is_author() || is_date() || is_search() ) ) {
		wp_enqueue_style(
			'bdwp-blog',
			BIGDIAMOND_WHITE_PRESTIGE_URI . $theme_styles['bdwp-blog'],
			[ 'bdwp-main' ],
			bdwp_asset_ver( $theme_styles['bdwp-blog'] )
		);
	}

	/**
	 * === JS: header.js (burger/search/cart) ===
	 * Skrypt dla nagłówka z ID: #bdwp-mobile-menu-toggle, #bdwp-search-toggle itd.
	 */
	$header_js_rel = '/assets/js/header.js';
	if ( file_exists(BIGDIAMOND_WHITE_PRESTIGE_DIR . $header_js_rel) ) {
		wp_enqueue_script(
			'bdwp-header',
			BIGDIAMOND_WHITE_PRESTIGE_URI . $header_js_rel,
			[],
			bdwp_asset_ver($header_js_rel),
			true
		);
		if ( function_exists('wp_script_add_data') ) {
			wp_script_add_data('bdwp-header', 'strategy', 'defer');
		}
	}

	/**
	 * === JS: main.js (opcjonalny – ogólne UI/aux) ===
	 */
	$main_js_rel = '/assets/js/main.js';
	if ( file_exists(BIGDIAMOND_WHITE_PRESTIGE_DIR . $main_js_rel) ) {
		wp_enqueue_script(
			'bdwp-main',
			BIGDIAMOND_WHITE_PRESTIGE_URI . $main_js_rel,
			[],
			bdwp_asset_ver($main_js_rel),
			true
		);
		if ( function_exists('wp_script_add_data') ) {
			wp_script_add_data('bdwp-main', 'strategy', 'defer');
		}
	}

	/**
	 * === JS: pdp.js dla strony produktu ===
	 */
	if ( function_exists( 'is_product' ) && is_product() ) {
		$pdp_js_rel = '/assets/js/pdp.js';
		if ( file_exists( BIGDIAMOND_WHITE_PRESTIGE_DIR . $pdp_js_rel ) ) {
			wp_enqueue_script(
				'bdwp-pdp',
				BIGDIAMOND_WHITE_PRESTIGE_URI . $pdp_js_rel,
				[],
				bdwp_asset_ver( $pdp_js_rel ),
				true
			);
			if ( function_exists( 'wp_script_add_data' ) ) {
				wp_script_add_data( 'bdwp-pdp', 'strategy', 'defer' );
			}
		}
	}

	/**
	 * === Woo: dopnij single-product JS na karcie produktu (zoom/variations) ===
	 */
	if ( function_exists('is_product') && is_product() ) {
		if ( wp_script_is('wc-single-product', 'registered') ) {
			wp_enqueue_script('wc-single-product');
		}
	}
}
