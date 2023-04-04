<?php

// Hero Section
function rpart_open_hero()
{
    if (is_shop() || is_product_category()) {
        echo "<div class='hero'>";
    }
}
function rpart_close_hero()
{
    if (is_shop() || is_product_category()) {
        echo "</div>";
    }
}
add_action('woocommerce_breadcrumb', 'rpart_open_hero', 5);
add_action('woocommerce_archive_description', 'rpart_close_hero', 15);


// Container in shop/archive page
function rpart_open_container()
{
    echo "<div class='container-fluid'>";
}
function rpart_close_container()
{
    echo "</div>";
}
add_action('woocommerce_before_main_content', 'rpart_open_container', 5);
add_action('woocommerce_after_main_content', 'rpart_close_container', 5);

// Shop/Archive page product filter button
function rpart_filetr_button()
{
    echo '<button id="filterBtn"><svg width="32" height="19" viewBox="0 0 32 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M10.6818 3.4091C10.6818 2.85682 11.1295 2.4091 11.6818 2.4091H31C31.5523 2.4091 32 2.85682 32 3.4091C32 3.96139 31.5523 4.4091 31 4.4091H11.6818C11.1295 4.4091 10.6818 3.96139 10.6818 3.4091Z" fill="#272727"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M0 3.4091C0 2.85682 0.447715 2.4091 1 2.4091H5.54547C6.09776 2.4091 6.54547 2.85682 6.54547 3.4091C6.54547 3.96139 6.09776 4.4091 5.54547 4.4091H1C0.447715 4.4091 0 3.96139 0 3.4091Z" fill="#272727"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M8.61357 5.51821C9.7784 5.51821 10.7227 4.57393 10.7227 3.4091C10.7227 2.24428 9.7784 1.3 8.61357 1.3C7.44875 1.3 6.50447 2.24428 6.50447 3.4091C6.50447 4.57393 7.44875 5.51821 8.61357 5.51821ZM8.61357 6.81821C10.4964 6.81821 12.0227 5.2919 12.0227 3.4091C12.0227 1.52631 10.4964 0 8.61357 0C6.73078 0 5.20447 1.52631 5.20447 3.4091C5.20447 5.2919 6.73078 6.81821 8.61357 6.81821Z" fill="#272727"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M21.3182 14.7728C21.3182 14.2205 20.8705 13.7728 20.3182 13.7728H0.999985C0.447701 13.7728 -1.52588e-05 14.2205 -1.52588e-05 14.7728C-1.52588e-05 15.3251 0.447701 15.7728 0.999985 15.7728H20.3182C20.8705 15.7728 21.3182 15.3251 21.3182 14.7728Z" fill="#272727"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M32 14.7728C32 14.2205 31.5523 13.7728 31 13.7728H26.4545C25.9022 13.7728 25.4545 14.2205 25.4545 14.7728C25.4545 15.3251 25.9022 15.7728 26.4545 15.7728H31C31.5523 15.7728 32 15.3251 32 14.7728Z" fill="#272727"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M23.3864 16.8819C22.2216 16.8819 21.2773 15.9376 21.2773 14.7728C21.2773 13.608 22.2216 12.6637 23.3864 12.6637C24.5513 12.6637 25.4955 13.608 25.4955 14.7728C25.4955 15.9376 24.5513 16.8819 23.3864 16.8819ZM23.3864 18.1819C21.5036 18.1819 19.9773 16.6556 19.9773 14.7728C19.9773 12.89 21.5036 11.3637 23.3864 11.3637C25.2692 11.3637 26.7955 12.89 26.7955 14.7728C26.7955 16.6556 25.2692 18.1819 23.3864 18.1819Z" fill="#272727"/>
</svg> Filter
</button>';
}
add_action('woocommerce_before_shop_loop', 'rpart_filetr_button', 20);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar'); // remove woocommerce sidebar
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20); // remove woocommerce result counter
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
add_action('woocommerce_after_shop_loop_item_title', 'change_loop_ratings_location', 2);
function change_loop_ratings_location()
{
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15);
}

add_filter('woocommerce_product_get_rating_html', 'loop_product_get_rating_html', 20, 3);
function loop_product_get_rating_html($html, $rating, $count)
{
    if (0 < $rating && ! is_product()) {
        global $product;
        $rating_cnt = array_sum($product->get_rating_counts());
        $count_html = ' <p class="count-rating"> (' . $rating_cnt .') </p>';

        $html       = '<div class="container-rating"><div class="star-rating">';
        $html      .= wc_get_star_rating_html($rating, $count);
        $html      .= '</div> ' . $count_html . ' </div>';
    }
    return $html;
}



function pwspk_woocommerce_before_shop_loop_item_title()
{
    global $product;
    $attachment_ids = $product->get_gallery_image_ids();
    if ($attachment_ids && $image = $product->get_image_id()) {
        $image_thumb = wp_get_attachment_image_src($image, 'woocommerce_thumbnail', false);
        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
        echo "<div class='flexslider'><ul class='slides'>";
        echo "<li data-thumb= '{$image_thumb[0]}'><img src='{$image_thumb[0]}'></li>";

        foreach ($attachment_ids as $attachment_id) {
            $image_src = wp_get_attachment_image_src($attachment_id, 'woocommerce_thumbnail', false);
            echo "<li data-thumb='{$image_src[0]}'><img src='{$image_src[0]}'></li>";
        }
        echo "</ul></div>";
    } else {
        add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'pwspk_woocommerce_before_shop_loop_item_title', 9);


// Display Woocommerce Discount Percentage on the products image
add_filter('woocommerce_sale_flash', 'wpamit_display_percentage_on_product_image', 20, 3);
function wpamit_display_percentage_on_product_image($html, $post, $product)
{
    if ($product->is_type('variable')) {
        $percentages = array();
        $prices = $product->get_variation_prices();
        foreach ($prices['price'] as $key => $price) {
            if ($prices['regular_price'][$key] !== $price) {
                $percentages[] = round(100 - (floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100));
            }
        }
        $percentage = max($percentages) . '%';
    } elseif ($product->is_type('grouped')) {
        $percentages = array();
        $children_ids = $product->get_children();
        foreach ($children_ids as $child_id) {
            $child_product = wc_get_product($child_id);
            $regular_price = (float) $child_product->get_regular_price();
            $sale_price    = (float) $child_product->get_sale_price();
            if ($sale_price != 0 || ! empty($sale_price)) {
                $percentages[] = round(100 - ($sale_price / $regular_price * 100));
            }
        }

        $percentage = max($percentages) . '%';
    } else {
        $regular_price = (float) $product->get_regular_price();
        $sale_price    = (float) $product->get_sale_price();
        if ($sale_price != 0 || ! empty($sale_price)) {
            $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
        } else {
            return $html;
        }
    }
    return '<small class="onsale">' . esc_html__('', 'woocommerce') . ' '. $percentage . ' OFF</small>';
}
