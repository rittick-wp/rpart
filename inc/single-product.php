<?php
// Add Buy Now button
add_action('woocommerce_after_add_to_cart_button', 'ecommercehints_buy_now', 10, 0);
function ecommercehints_buy_now()
{
    global $product;
    if (! $product->is_type('simple')) {
        return;
    } // Only show on simple products
    echo '<a href="/checkout?add-to-cart='.$product->get_ID().'" class="button buyNow">Buy Now</a>';
};
add_filter('woocommerce_sale_flash', 'avada_hide_sale_flash');
function avada_hide_sale_flash()
{
    return false;
}

// Add content
add_action('woocommerce_after_add_to_cart_form', 'show_trust_content');
function show_trust_content()
{
    ?>
    <div class="content">
        This is card with icon
    </div>
    <?php
}
// 1. Show plus minus buttons

add_action('woocommerce_after_quantity_input_field', 'bbloomer_display_quantity_plus');

function bbloomer_display_quantity_plus()
{
    echo '<button type="button" class="plus">+</button>';
}

add_action('woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_minus');

function bbloomer_display_quantity_minus()
{
    echo '<button type="button" class="minus">-</button>';
}

// -------------
// 2. Trigger update quantity script

add_action('wp_footer', 'bbloomer_add_cart_quantity_plus_minus');

function bbloomer_add_cart_quantity_plus_minus()
{
    wc_enqueue_js("   
           
      $(document).on( 'click', 'button.plus, button.minus', function() {
  
         var qty = $( this ).parent( '.quantity' ).find( '.qty' );
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr( 'max' ));
         var min = parseFloat(qty.attr( 'min' ));
         var step = parseFloat(qty.attr( 'step' ));
 
         if ( $( this ).is( '.plus' ) ) {
            if ( max && ( max <= val ) ) {
               qty.val( max ).change();
            } else {
               qty.val( val + step ).change();
            }
         } else {
            if ( min && ( min >= val ) ) {
               qty.val( min ).change();
            } else if ( val > 1 ) {
               qty.val( val - step ).change();
            }
         }
      });
   ");
}

function sales_timer_echo_product()
{
    global $product;
    $regular_price  = get_post_meta($product->get_id(), '_sale_price_dates_to', true);
    if (!empty($regular_price)) {
        ?>
        <div class="salesTime" >
            <h3>🗲 Limited time offer</h3>
            <div id="sales_timer" data-date="<?php echo date('Y-m-d', $regular_price);?>">
                <ul>
                  <li><span id="days">45</span>Days</li>
                  <li><span id="hours">03</span>Hours</li>
                  <li><span id="minutes">54</span>Minutes</li>
                  <li><span id="seconds">04</span>Seconds</li>
                </ul>
            </div>
        </div>   
    <?php
    }
} // end function
add_action('woocommerce_single_product_summary', 'sales_timer_echo_product', 12); // hook number

// Add wishlist in single page
function rpart_single_page_wishlist()
{
    echo do_shortcode('[yith_wcwl_add_to_wishlist]');
}
add_action('woocommerce_before_add_to_cart_form', 'rpart_single_page_wishlist');
