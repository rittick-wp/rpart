<?php


add_filter('woocommerce_order_button_text', 'ecommercehints_checkout_button_text');

function ecommercehints_checkout_button_text($button_text)
{
    return 'Get The Goods!'; // new text is here
}

//  Remove the Order Notes field section from the WooCommerce checkout.
add_filter('woocommerce_enable_order_notes_field', '__return_false', 9999);
add_filter('woocommerce_checkout_fields', 'remove_order_notes');
function remove_order_notes($fields)
{
    unset($fields['order']['order_comments']);
    return $fields;
}

// Show product image in chackout page
add_filter('woocommerce_cart_item_name', 'bbloomer_product_image_review_order_checkout', 9999, 3);
function bbloomer_product_image_review_order_checkout($name, $cart_item, $cart_item_key)
{
    if (! is_checkout()) {
        return $name;
    }
    $product = $cart_item['data'];
    $thumbnail = $product->get_image(array( '50', '50' ), array( 'class' => 'alignleft' ));
    return $thumbnail . $name;
}
add_action('woocommerce_review_order_after_submit', 'bloomer_phone_checkout_page');

function bloomer_phone_checkout_page()
{
    ?>
   <div class="secure-payment">
		<img src="<?php echo get_theme_file_uri('/assets/images/razorpay-secure-payment.png') ?>" alt="razorpay-secure-payment">
	</div>
   <?php
}

remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10);
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
add_action('woocommerce_after_order_notes', 'prefix_wc_order_review_heading', 3);
add_action('woocommerce_after_order_notes', 'woocommerce_order_review', 4);
add_action('woocommerce_after_order_notes', 'woocommerce_checkout_payment', 4);

/**
 * Add a heading for order review on checkout page.
 * This replaces the heading added by WooCommerce since order review is moved to the top of the checkout page.
 */
function prefix_wc_order_review_heading()
{
    echo '<h3>Your Order</h3>';
}
// Order Page
add_filter('woocommerce_order_item_name', 'ts_product_image_on_thankyou', 10, 3);
function ts_product_image_on_thankyou($name, $item, $visible)
{
    /* Return if not thankyou/order-received page */
    if (! is_order_received_page()) {
        return $name;
    }
    /* Get product id */
    $product_id = $item->get_product_id();
    /* Get product object */
    $_product = wc_get_product($product_id);
    /* Get product thumbnail */
    $thumbnail = $_product->get_image();
    /* Add wrapper to image and add some css */
    $image = '<div class="ts-product-image" style="width: 52px; height: 45px; display: inline-block; padding-right: 7px; vertical-align: middle;">'
                . $thumbnail .
            '</div>';
    /* Prepend image to name and return it */
    return $image . $name;
}
