<?php

require_once('inc/theme-support.php');
require_once('inc/enqueue.php');
require_once('inc/message-based-on-cart.php');
require_once('inc/shop-page-customization.php');
require_once('inc/single-product.php');
require_once('inc/wishlist-counter.php');
require_once('inc/cart-page.php');
require_once('inc/checkout-page.php');
require_once('inc/quick-view.php');

function get_breadcrumb()
{
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
        the_category(' &bull; ');
        if (is_single()) {
            echo " &nbsp;&nbsp;/&nbsp;&nbsp; ";
            the_title();
        }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;/&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;/&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}

// if (function_exists('YITH_WCQV_Frontend')) {
//     $yith_qv_plugin = YITH_WCQV_Frontend();

//     remove_action('woocommerce_after_shop_loop_item', array( $yith_qv_plugin, 'yith_add_quick_view_button' ), 15);
//     // add_action('woocommerce_before_shop_loop_item_title', array( $yith_qv_plugin, 'yith_add_quick_view_button' ), 16);
// }
