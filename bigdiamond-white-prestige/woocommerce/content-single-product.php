<?php
/**
 * Template for displaying single product content within loops.
 *
 * @package BigDIAMOND_White_Prestige
 */

defined( 'ABSPATH' ) || exit;

global $product;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
}

$product = wc_get_product( get_the_ID() );

if ( ! $product ) {
	return;
}

$sticky_thumb_id = $product->get_image_id();
$sticky_thumb     = $sticky_thumb_id ? wp_get_attachment_image( $sticky_thumb_id, 'thumbnail', false, [
	'class'    => 'bdwp-sticky-bar__thumb',
	'loading'  => 'lazy',
	'decoding' => 'async',
	'alt'      => esc_attr( $product->get_name() ),
] ) : '';

?>
<article id="product-<?php the_ID(); ?>" <?php wc_product_class( 'bdwp-single-product', $product ); ?> data-product-id="<?php echo esc_attr( (string) $product->get_id() ); ?>">
	<div class="bdwp-single-product__layout">
		<div class="bdwp-single-product__media" data-bdwp-sticky="media">
			<div class="bdwp-single-product__media-inner">
				<?php
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>
		</div>

		<div id="bdwp-pdp-summary" class="bdwp-single-product__summary summary entry-summary" tabindex="-1" aria-label="<?php echo esc_attr( sprintf( __( 'Podsumowanie produktu %s', 'bigdiamond-white-prestige' ), $product->get_name() ) ); ?>">
			<div class="bdwp-single-product__summary-inner">
				<?php
				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>

			<?php do_action( 'bdwp_single_product_summary_after', $product ); ?>
		</div>
	</div>

	<div class="bdwp-single-product__after">
		<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
	</div>
</article>

<?php do_action( 'bdwp_single_product_after_article', $product ); ?>

<div id="bdwpPdpSticky" class="bdwp-sticky-bar" hidden data-bdwp-sticky-bar>
	<div class="bdwp-sticky-bar__inner">
		<div class="bdwp-sticky-bar__product">
			<?php
			if ( $sticky_thumb ) {
				echo $sticky_thumb; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
			<div class="bdwp-sticky-bar__details">
				<strong class="bdwp-sticky-bar__title" data-bdwp-sticky-title><?php echo esc_html( $product->get_name() ); ?></strong>
				<span class="bdwp-sticky-bar__price" data-bdwp-sticky-price><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
			</div>
		</div>
		<div class="bdwp-sticky-bar__actions">
			<?php do_action( 'bdwp_single_product_sticky_bar', $product ); ?>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
