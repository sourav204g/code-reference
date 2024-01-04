<?php
/**
 * The Template for displaying the review order product table within checkout.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce-germanized/checkout/review-order-product-table.php.
 *
 * HOWEVER, on occasion Germanized will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://github.com/vendidero/woocommerce-germanized/wiki/Overriding-Germanized-Templates
 * @package Germanized/Templates
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Before review order product table.
 *
 * Fires before rendering the checkout review order product table.
 * This additional template replaces Woo's default product table within review-order.php.
 *
 * @since 1.0.0
 */
do_action( 'woocommerce_gzd_review_order_before_cart_contents' );

foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
	$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

/* DPT 03122020 - Get ariation name to show in product name in cart item */
		// Get the WC_Product
			if( ! empty( $_product ) && $_product->is_type( 'variation' ) ) {
			  // WC 3+ compatibility
			  $description = version_compare( WC_VERSION, '3.0', '<' ) ? $_product->get_variation_description() : $_product->get_description();
			}
/* DPT 03122020 - END Get ariation name to show in product name in cart item */
			
	if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
		?>
        <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
            <td class="product-name">

				<?php if ( get_option( 'woocommerce_gzd_display_checkout_thumbnails' ) == 'yes' ) : ?>

                <div class="wc-gzd-product-name-left">
					<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
                </div>

                <div class="wc-gzd-product-name-right">

					<?php endif; ?>
					<?php /* DPT 03122020 - show variation name instead of product name and variation ID */
					if( ! empty( $description ) ) {
					echo apply_filters( 'woocommerce_cart_item_name', $description, $cart_item, $cart_item_key ) . '&nbsp;';
						} else {
					echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; }
								/* DPT 03122020 - END show variation name instead of product name and variation ID */ ?>
								
					<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>

					<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>

					<?php if ( get_option( 'woocommerce_gzd_display_checkout_thumbnails' ) == 'yes' ) : ?>

                </div>
                <div class="clear"></div>

			<?php endif; ?>

            </td>
            <td class="product-total">
				<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
            </td>
        </tr>
		<?php
	}
}