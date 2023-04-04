<?php
add_action('woocommerce_before_shop_loop_item_title', 'rpart_quick_view_button', 20);
function rpart_quick_view_button()
{?>
<!-- <button type="button" class="quick-view-btn button" data-product_id="<?php echo get_the_ID(); ?>"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" opacity=".25"/><path d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z" class="spinner"/></svg> Quick View</button> -->

<button type="button" class="quick-view-btn button" data-product_id="<?php echo get_the_ID(); ?>"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" opacity=".25"/><path d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z" class="spinner"/></svg> Quick View</button>

<?php };

function custom_quick_view()
{
    $product_id = intval($_POST['product_id']);
    $product = wc_get_product($product_id);
    if ($product) {
        ?>
      <div class="product woocommerce">
		<div id="productBox" <?php post_class('product'); ?>>
        
<div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images">
  <?php

        $attachment_ids = $product->get_gallery_image_ids();
        if ($attachment_ids && $image = $product->get_image_id()) {
            $image_thumb = wp_get_attachment_image_src($image, 'woocommerce_thumbnail', false);
            remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
            echo "<div class='quickViewSlider'><ul class='slides'>";
            echo "<li data-thumb= '{$image_thumb[0]}'><img src='{$image_thumb[0]}'></li>";

            foreach ($attachment_ids as $attachment_id) {
                $image_src = wp_get_attachment_image_src($attachment_id, 'woocommerce_thumbnail', false);
                echo "<li data-thumb='{$image_src[0]}'><img src='{$image_src[0]}'></li>";
            }
            echo "</ul></div>";
        } else {
            $featured_image_id = $product->get_image_id();
            $featured_image_url = wp_get_attachment_url($featured_image_id);
            echo '<img src="' . $featured_image_url . '" />';
        }
        ?>
</div>
    <div class="summary entry-summary">
      <h1 class="product_title entry-title">
        <?php echo $product->get_name();?>
    </h1>
      <p class="price">
           <?php  echo $product->get_price_html();?>
      </p>

        <?php  if (!empty($product->get_short_description())) { ?>
    <div class="woocommerce-product-details__short-description">
        <p><?php echo $product->get_short_description()?></p>
    </div> 
    
<?php }
        do_action('rpart_quickView');

        ?>
    </div>
    <script>
        jQuery(".quickViewSlider").flexslider({
  animation: "fade",
  directionNav: false,
  controlNav: "thumbnails",
  easing: "swing",
  slideshowSpeed: 7000,
  animationSpeed: 600,
});
    </script>
 <?php
    }


    wp_die();
}
add_action('wp_ajax_custom_quick_view', 'custom_quick_view');
add_action('wp_ajax_nopriv_custom_quick_view', 'custom_quick_view');


if (! function_exists('chromium_output_variables')) {
    function chromium_output_variables()
    {
        global $product;
        if ($product->get_type() == "variable" && (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy())) {
            woocommerce_variable_add_to_cart();
            wc_get_template_part('loop/add-to-cart.php');
        } else {
            wc_get_template_part('loop/add-to-cart.php');
        }
    }
    add_action('woocommerce_after_shop_loop_item', 'chromium_output_variables', 10);
}
