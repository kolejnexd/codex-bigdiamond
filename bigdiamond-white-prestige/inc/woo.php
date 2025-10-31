<?php
/**
 * WooCommerce integration adjustments.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

add_filter( 'loop_shop_columns', 'bigdiamond_white_prestige_loop_columns' );
/**
 * Control WooCommerce shop columns.
 *
 * @return int
 */
function bigdiamond_white_prestige_loop_columns(): int {
	return wp_is_mobile() ? 2 : 4;
}

add_filter( 'loop_shop_per_page', 'bigdiamond_white_prestige_products_per_page' );
/**
 * Set number of products per page.
 *
 * @return int
 */
function bigdiamond_white_prestige_products_per_page(): int {
	return 12;
}

add_action( 'after_setup_theme', 'bigdiamond_white_prestige_remove_sidebar', 20 );
/**
 * Remove sidebar from WooCommerce templates for cleaner layout.
 *
 * @return void
 */
function bigdiamond_white_prestige_remove_sidebar(): void {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}

add_filter( 'woocommerce_single_product_image_gallery_classes', 'bigdiamond_white_prestige_gallery_classes' );
/**
 * Add custom class to product gallery for styling.
 *
 * @param array $classes Gallery classes.
 *
 * @return array
 */
function bigdiamond_white_prestige_gallery_classes( array $classes ): array {
	$classes[] = 'bdwp-gallery';

	return $classes;
}

add_filter( 'wp_get_attachment_image_attributes', 'bigdiamond_white_prestige_filter_thumbnail_attrs', 10, 3 );
/**
 * Ensure lazy loading on WooCommerce thumbnails.
 *
 * @param array  $attr       Attributes.
 * @param object $attachment Image data.
 * @param string $size       Image size.
 *
 * @return array
 */
function bigdiamond_white_prestige_filter_thumbnail_attrs( array $attr, $attachment, string $size ): array {
	if ( 'woocommerce_thumbnail' === $size ) {
		$attr['loading']       = 'lazy';
		$attr['fetchpriority'] = 'low';
		$attr['decoding']      = 'async';
	}

	return $attr;
}

add_filter( 'woocommerce_loop_add_to_cart_args', 'bigdiamond_white_prestige_loop_add_to_cart_args', 10, 2 );
/**
 * Enhance add to cart buttons with accessibility attributes.
 *
 * @param array      $args    Default arguments.
 * @param WC_Product $product Product object.
 *
 * @return array
 */
function bigdiamond_white_prestige_loop_add_to_cart_args( array $args, $product ): array {
	$args['attributes'] = isset( $args['attributes'] ) ? $args['attributes'] : array();
	$args['attributes']['aria-label'] = sprintf(
		/* translators: %s: product name */
		__( 'Dodaj %s do koszyka', 'bigdiamond-white-prestige' ),
		$product->get_name()
	);

	$existing_class = isset( $args['class'] ) ? $args['class'] : '';
	if ( false === strpos( $existing_class, 'btn' ) ) {
		$args['class'] = trim( $existing_class . ' btn' );
	}

	return $args;
}

add_filter( 'woocommerce_product_single_add_to_cart_class', 'bigdiamond_white_prestige_single_add_to_cart_class', 10, 2 );
/**
 * Append global CTA classes to single product add-to-cart buttons.
 *
 * @param string     $class   Current classes.
 * @param WC_Product $product Product instance.
 *
 * @return string
 */
function bigdiamond_white_prestige_single_add_to_cart_class( string $class, $product ): string {
	if ( false === strpos( $class, 'btn' ) ) {
		$class .= ' btn';
	}

	return trim( $class );
}

add_filter( 'woocommerce_product_tabs', 'bigdiamond_white_prestige_customize_product_tabs' );
/**
 * Add custom FAQ tab to the product page.
 *
 * @param array $tabs Default tabs.
 *
 * @return array
 */
function bigdiamond_white_prestige_customize_product_tabs( array $tabs ): array {
	if ( function_exists( 'bigdiamond_white_prestige_get_faq_items' ) ) {
		$tabs['bdwp_faq'] = array(
			'title'    => __( 'FAQ', 'bigdiamond-white-prestige' ),
			'priority' => 80,
			'callback' => 'bigdiamond_white_prestige_render_product_faq_tab',
		);
	}

	return $tabs;
}

/**
 * Render FAQ tab content.
 *
 * ULEPSZONA WERSJA: Renderuje interaktywny akordeon,
 * spójny z resztą motywu (np. page-faq.php).
 *
 * @return void
 */
function bigdiamond_white_prestige_render_product_faq_tab(): void {
	if ( ! function_exists( 'bigdiamond_white_prestige_get_faq_items' ) ) {
		return;
	}

	$items = bigdiamond_white_prestige_get_faq_items();

	if ( empty( $items ) ) {
		echo '<p>' . esc_html__( 'Brak dodatkowych pytań dla tego produktu.', 'bigdiamond-white-prestige' ) . '</p>';
		return;
	}

	// Użyj tej samej struktury co page-faq.php dla spójnego wyglądu i działania JS
	echo '<dl class="bdwp-faq bdwp-faq--product" role="list">';
	foreach ( $items as $index => $item ) {
		$faq_id    = 'product-faq-' . esc_attr( (string) $index );
		$panel_id  = 'product-faq-panel-' . esc_attr( (string) $index );
		$question  = esc_html( $item['question'] );
		$answer    = esc_html( $item['answer'] );
		?>
		<dt id="<?php echo $faq_id; ?>">
			<button class="bdwp-faq__toggle" type="button" aria-expanded="false" aria-controls="<?php echo $panel_id; ?>">
				<?php echo $question; ?>
			</button>
		</dt>
		<dd class="bdwp-faq__panel" id="<?php echo $panel_id; ?>" hidden aria-labelledby="<?php echo $faq_id; ?>">
			<p><?php echo $answer; ?></p>
		</dd>
		<?php
	}
	echo '</dl>';
}
add_filter( 'woocommerce_checkout_fields', 'bigdiamond_white_prestige_optimize_checkout_fields' );
/**
 * Streamline checkout fields for better UX.
 *
 * @param array $fields Checkout fields.
 *
 * @return array
 */
function bigdiamond_white_prestige_optimize_checkout_fields( array $fields ): array {
	if ( isset( $fields['billing']['billing_company'] ) ) {
		$fields['billing']['billing_company']['required'] = false;
	}
	if ( isset( $fields['billing']['billing_phone'] ) ) {
		$fields['billing']['billing_phone']['placeholder'] = __( 'Numer telefonu (dla kuriera)', 'bigdiamond-white-prestige' );
	}
	if ( isset( $fields['billing']['billing_address_2'] ) ) {
		$fields['billing']['billing_address_2']['placeholder'] = __( 'Dodatkowe informacje o adresie', 'bigdiamond-white-prestige' );
		$fields['billing']['billing_address_2']['required']    = false;
	}
	if ( isset( $fields['order']['order_comments'] ) ) {
		$fields['order']['order_comments']['placeholder'] = __( 'Instrukcje dla złotnika lub kuriera (opcjonalnie)', 'bigdiamond-white-prestige' );
	}

	return $fields;
}

/**
 * Display recently viewed products below the product summary.
 *
 * @return void
 */
function bigdiamond_white_prestige_recently_viewed_products(): void {
	if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) {
		return;
	}

	$cookie = sanitize_text_field( wp_unslash( (string) $_COOKIE['woocommerce_recently_viewed'] ) );
	$viewed = array_filter( array_map( 'absint', explode( '|', $cookie ) ) );
	$viewed = array_reverse( array_unique( $viewed ) );
	$viewed = array_diff( $viewed, array( get_the_ID() ) );
	$viewed = array_slice( $viewed, 0, 4 );

	if ( empty( $viewed ) ) {
		return;
	}

	$query = new WP_Query(
		array(
			'post_type'      => 'product',
			'post__in'       => $viewed,
			'orderby'        => 'post__in',
			'posts_per_page' => count( $viewed ),
		)
	);

	if ( ! $query->have_posts() ) {
		wp_reset_postdata();
		return;
	}

	echo '<section class="bdwp-recently-viewed" aria-labelledby="bdwp-recently-viewed-heading">';
	echo '<h2 id="bdwp-recently-viewed-heading">' . esc_html__( 'Ostatnio oglądane', 'bigdiamond-white-prestige' ) . '</h2>';
	echo '<div class="bdwp-recently-viewed__grid">';
	while ( $query->have_posts() ) {
		$query->the_post();
		wc_get_template_part( 'content', 'product' );
	}
	echo '</div>';
	echo '</section>';

	wp_reset_postdata();
}

/**
 * Determine whether engraving field should be displayed for a product.
 *
 * @param int $product_id Product ID.
 *
 * @return bool
 */
function bdwp_product_supports_engraving( int $product_id ): bool {
	return (bool) apply_filters( 'bdwp_product_supports_engraving', true, $product_id );
}

/**
 * Get engraving field name.
 *
 * @return string
 */
function bdwp_get_engraving_field_name(): string {
	return 'bdwp_engraving_text';
}

/**
 * Engraving nonce field name.
 *
 * @return string
 */
function bdwp_get_engraving_nonce_name(): string {
	return 'bdwp_engraving_nonce';
}

/**
 * Get engraving maximum length.
 *
 * @return int
 */
function bdwp_get_engraving_max_length(): int {
	return (int) apply_filters( 'bdwp_engraving_max_length', 30 );
}

add_action( 'woocommerce_before_add_to_cart_button', 'bdwp_render_engraving_field', 9 );
/**
 * Render engraving input field and nonce.
 */
function bdwp_render_engraving_field(): void {
	$product_id = get_the_ID();

	if ( ! $product_id || ! bdwp_product_supports_engraving( (int) $product_id ) ) {
		return;
	}

	$field_name = bdwp_get_engraving_field_name();
	$max_length = bdwp_get_engraving_max_length();
	$current    = '';

	if ( isset( $_POST[ $field_name ] ) ) { // phpcs:ignore WordPress.CSRF.NonceVerification
		$current = sanitize_text_field( wp_unslash( (string) $_POST[ $field_name ] ) ); // phpcs:ignore WordPress.CSRF.NonceVerification
	}

	wp_nonce_field( 'bdwp_save_engraving', bdwp_get_engraving_nonce_name() );

	printf(
		'<fieldset class="bdwp-engraving-field">'
		. '<label for="%1$s">%2$s</label>'
		. '<input type="text" id="%1$s" name="%1$s" value="%3$s" maxlength="%4$d" autocomplete="off" inputmode="text" class="bdwp-engraving-field__input">'
		. '<small class="bdwp-engraving-field__note">%5$s</small>'
		. '</fieldset>',
		esc_attr( $field_name ),
		esc_html__( 'Twój grawerunek (opcjonalnie)', 'bigdiamond-white-prestige' ),
		esc_attr( $current ),
		$max_length,
		esc_html__( 'Maksymalnie 30 znaków. Produkty z personalizacją nie podlegają zwrotowi.', 'bigdiamond-white-prestige' )
	);
}

add_filter( 'woocommerce_add_to_cart_validation', 'bdwp_validate_engraving_request', 10, 3 );
/**
 * Validate engraving submission before adding to cart.
 *
 * @param bool $passed      Validation state.
 * @param int  $product_id  Product ID.
 * @param int  $quantity    Quantity.
 *
 * @return bool
 */
function bdwp_validate_engraving_request( bool $passed, int $product_id, int $quantity ): bool {
	$field_name = bdwp_get_engraving_field_name();

	if ( empty( $_POST[ $field_name ] ) ) { // phpcs:ignore WordPress.CSRF.NonceVerification
		return $passed;
	}

	if ( ! bdwp_product_supports_engraving( $product_id ) ) {
		return $passed;
	}

	$nonce_name = bdwp_get_engraving_nonce_name();

	if ( empty( $_POST[ $nonce_name ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( (string) $_POST[ $nonce_name ] ) ), 'bdwp_save_engraving' ) ) { // phpcs:ignore WordPress.CSRF.NonceVerification
		wc_add_notice( __( 'Nie udało się zweryfikować grawerunku. Odśwież stronę i spróbuj ponownie.', 'bigdiamond-white-prestige' ), 'error' );
		return false;
	}

	$raw_input = sanitize_text_field( wp_unslash( (string) $_POST[ $field_name ] ) ); // phpcs:ignore WordPress.CSRF.NonceVerification
	$clean     = trim( mb_substr( $raw_input, 0, bdwp_get_engraving_max_length() ) );

	if ( '' === $clean ) {
		return $passed;
	}

	$_POST['bdwp_engraving_text_clean'] = $clean; // phpcs:ignore WordPress.CSRF.NonceVerification -- downstream filters rely on this.

	return $passed;
}

add_filter( 'woocommerce_add_cart_item_data', 'bdwp_add_engraving_to_cart_item', 10, 3 );
/**
 * Persist engraving in cart item data.
 *
 * @param array $cart_item_data Existing cart item data.
 * @param int   $product_id     Product ID.
 * @param int   $variation_id   Variation ID.
 *
 * @return array
 */
function bdwp_add_engraving_to_cart_item( array $cart_item_data, int $product_id, int $variation_id ): array {
	$field_name = bdwp_get_engraving_field_name();
	$engraving  = '';

	if ( isset( $_POST['bdwp_engraving_text_clean'] ) ) { // phpcs:ignore WordPress.CSRF.NonceVerification
		$engraving = sanitize_text_field( wp_unslash( (string) $_POST['bdwp_engraving_text_clean'] ) ); // phpcs:ignore WordPress.CSRF.NonceVerification
	} elseif ( isset( $_POST[ $field_name ] ) ) { // phpcs:ignore WordPress.CSRF.NonceVerification
		$engraving = sanitize_text_field( wp_unslash( (string) $_POST[ $field_name ] ) ); // phpcs:ignore WordPress.CSRF.NonceVerification
		$engraving = mb_substr( $engraving, 0, bdwp_get_engraving_max_length() );
	}

	$engraving = trim( $engraving );

	if ( '' !== $engraving ) {
		$cart_item_data['bdwp_engraving'] = apply_filters( 'bdwp_engraving_value', $engraving, $product_id, $variation_id );
	}

	return $cart_item_data;
}

add_filter( 'woocommerce_get_item_data', 'bdwp_display_engraving_in_cart', 10, 2 );
/**
 * Display engraving within cart/checkout order lines.
 *
 * @param array $item_data Item data array.
 * @param array $cart_item Cart item data.
 *
 * @return array
 */
function bdwp_display_engraving_in_cart( array $item_data, array $cart_item ): array {
	if ( isset( $cart_item['bdwp_engraving'] ) && '' !== $cart_item['bdwp_engraving'] ) {
		$item_data[] = [
			'key'   => __( 'Grawerunek', 'bigdiamond-white-prestige' ),
			'value' => esc_html( $cart_item['bdwp_engraving'] ),
		];
	}

	return $item_data;
}

add_action( 'woocommerce_checkout_create_order_line_item', 'bdwp_save_engraving_to_order', 10, 4 );
/**
 * Store engraving inside order items for fulfilment.
 *
 * @param WC_Order_Item_Product $item          Order item.
 * @param string                $cart_item_key Cart item key.
 * @param array                 $values        Cart item values.
 * @param WC_Order              $order         Order.
 */
function bdwp_save_engraving_to_order( $item, string $cart_item_key, array $values, $order ): void {
	if ( isset( $values['bdwp_engraving'] ) && '' !== $values['bdwp_engraving'] ) {
		$item->add_meta_data( __( 'Grawerunek', 'bigdiamond-white-prestige' ), sanitize_text_field( $values['bdwp_engraving'] ) );
	}
}

/**
 * Retrieve certificate URL for a product.
 *
 * @param int $product_id Product ID.
 *
 * @return string
 */
function bdwp_get_product_certificate_url( int $product_id ): string {
	$url = get_post_meta( $product_id, '_bdwp_certificate_url', true );

	if ( ! is_string( $url ) ) {
		return '';
	}

	$url = esc_url_raw( trim( $url ) );

	return $url ? $url : '';
}

/**
 * Fetch 4C descriptors for product.
 *
 * @param int $product_id Product ID.
 *
 * @return array<string, array{label:string,value:string}>
 */
function bdwp_get_product_four_c_data( int $product_id ): array {
	$meta_keys = apply_filters(
		'bdwp_product_four_c_meta_keys',
		[
			'cut'     => '_bdwp_4c_cut',
			'color'   => '_bdwp_4c_color',
			'clarity' => '_bdwp_4c_clarity',
			'carat'   => '_bdwp_4c_carat',
		],
		$product_id
	);

	$labels = [
		'cut'     => __( 'Szlif (Cut)', 'bigdiamond-white-prestige' ),
		'color'   => __( 'Barwa (Color)', 'bigdiamond-white-prestige' ),
		'clarity' => __( 'Czystość (Clarity)', 'bigdiamond-white-prestige' ),
		'carat'   => __( 'Masa (Carat)', 'bigdiamond-white-prestige' ),
	];

	$data = [];

	foreach ( $meta_keys as $slug => $meta_key ) {
		$raw = get_post_meta( $product_id, $meta_key, true );
		if ( ! is_string( $raw ) ) {
			continue;
		}
		$raw = trim( $raw );
		if ( '' === $raw ) {
			continue;
		}
		$value = sanitize_text_field( $raw );
		$data[ $slug ] = [
			'label' => $labels[ $slug ] ?? ucfirst( $slug ),
			'value' => $value,
		];
	}

	return apply_filters( 'bdwp_product_four_c_data', $data, $product_id );
}

add_action( 'bdwp_single_product_summary_after', 'bdwp_render_product_highlights', 10, 1 );
/**
 * Output Four C section and certificate link within summary.
 *
 * @param WC_Product $product Product instance.
 */
function bdwp_render_product_highlights( WC_Product $product ): void {
	$product_id = $product->get_id();
	$four_c     = bdwp_get_product_four_c_data( $product_id );
	$cert_url   = bdwp_get_product_certificate_url( $product_id );

	if ( empty( $four_c ) && ! $cert_url ) {
		return;
	}

	printf( '<section class="bdwp-product-insights" aria-labelledby="bdwp-product-insights-%1$s">', esc_attr( (string) $product_id ) );
	printf( '<h2 id="bdwp-product-insights-%1$s" class="bdwp-product-insights__heading">%2$s</h2>', esc_attr( (string) $product_id ), esc_html__( 'Certyfikat &amp; parametry 4C', 'bigdiamond-white-prestige' ) );

	if ( ! empty( $four_c ) ) {
		echo '<dl class="bdwp-product-insights__list">';
		foreach ( $four_c as $slug => $entry ) {
			printf(
				'<div class="bdwp-product-insights__item bdwp-product-insights__item--%1$s"><dt>%2$s</dt><dd>%3$s</dd></div>',
				esc_attr( $slug ),
				esc_html( $entry['label'] ),
				esc_html( $entry['value'] )
			);
		}
		echo '</dl>';
	}

	if ( $cert_url ) {
		printf(
			'<p class="bdwp-product-insights__certificate"><a class="bdwp-button bdwp-button--ghost" href="%1$s" target="_blank" rel="noopener noreferrer">%2$s</a></p>',
			esc_url( $cert_url ),
			esc_html__( 'Zobacz certyfikat GIA/IGI', 'bigdiamond-white-prestige' )
		);
	}

	if ( empty( $four_c ) ) {
		printf(
			'<p class="bdwp-product-insights__note">%s</p>',
			esc_html__( 'Parametry diamentu zostaną potwierdzone indywidualnie przez naszych doradców.', 'bigdiamond-white-prestige' )
		);
	}

	echo '</section>';
}

add_action( 'bdwp_single_product_sticky_bar', 'bdwp_render_sticky_bar_actions', 10, 1 );
/**
 * Render sticky bar buttons.
 *
 * @param WC_Product $product Product instance.
 */
function bdwp_render_sticky_bar_actions( WC_Product $product ): void {
	$primary_label = $product->is_in_stock() ? __( 'Dodaj do koszyka', 'bigdiamond-white-prestige' ) : __( 'Powiadom o dostępności', 'bigdiamond-white-prestige' );

	printf(
		'<button type="button" class="bdwp-button bdwp-button--primary" data-bdwp-sticky-submit>%s</button>',
		esc_html( $primary_label )
	);

	printf(
		'<a class="bdwp-button bdwp-button--ghost" href="#bdwp-pdp-summary">%s</a>',
		esc_html__( 'Zobacz szczegóły', 'bigdiamond-white-prestige' )
	);
}
