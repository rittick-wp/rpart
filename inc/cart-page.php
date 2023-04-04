<?php
// First, hide the Update Cart button
add_action('wp_head', 'ecommercehints_hide_update_cart_button');
function ecommercehints_hide_update_cart_button()
{ ?>
	<style>
		button[name="update_cart"], input[name="update_cart"] {
			display: none;
		}
</style>
<?php }

// Second, add the jQuery to update the cart automaitcally on quantity change
add_action('wp_footer', 'ecommercehints_update_cart_on_quantity_change');
function ecommercehints_update_cart_on_quantity_change()
{ ?>
	<script>
	jQuery( function( $ ) {
		let timeout;
		$('.woocommerce').on('change', 'input.qty', function(){
			if ( timeout !== undefined ) {
				clearTimeout( timeout );
			}
			timeout = setTimeout(function() {
				$("[name='update_cart']").trigger("click");
			}, 500 ); // 500 being MS (half a second)
		});
	} );
	</script>
<?php }

function action_woocommerce_after_cart_totals()
{ ?>
    <div class="secure-payment">
		<img src="<?php echo get_theme_file_uri('/assets/images/razorpay-secure-payment.jpg') ?>" alt="razorpay-secure-payment">
	</div>
	<?php
};
add_action('woocommerce_after_cart_totals', 'action_woocommerce_after_cart_totals', 10, 0);



add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
    ?>
    <li class="cart counter"><a href="<?php echo site_url('/cart'); ?>"><svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M23.7533 20.2468C21.6907 20.2468 20.0127 21.9248 20.0127 23.9874C20.0127 26.05 21.6907 27.7281 23.7533 27.7281C25.8159 27.7281 27.494 26.05 27.494 23.9874C27.494 21.9248 25.8159 20.2468 23.7533 20.2468ZM23.7533 25.4837C22.9281 25.4837 22.257 24.8126 22.257 23.9874C22.257 23.1622 22.9281 22.4912 23.7533 22.4912C24.5785 22.4912 25.2496 23.1622 25.2496 23.9874C25.2496 24.8126 24.5785 25.4837 23.7533 25.4837ZM29.7616 5.78942C29.6567 5.65524 29.5226 5.54673 29.3695 5.47213C29.2164 5.39752 29.0483 5.35879 28.878 5.35887H6.927L5.91701 1.13306C5.85832 0.887709 5.7187 0.669279 5.52066 0.512993C5.32263 0.356707 5.07774 0.271674 4.82546 0.271606H1.1222C0.502386 0.271548 0 0.773934 0 1.39374C0 2.01355 0.502386 2.51594 1.1222 2.51594H3.93969L7.58683 17.7764C7.64546 18.0218 7.78506 18.2402 7.98311 18.3965C8.18115 18.5528 8.42609 18.6378 8.67838 18.6378H26.1473C26.6632 18.6378 27.1128 18.2862 27.2366 17.7857L29.9673 6.75071C30.0081 6.58536 30.0107 6.41291 29.9751 6.24638C29.9394 6.07985 29.8664 5.9236 29.7616 5.78942ZM25.2694 16.3935H9.56415L7.46337 7.60326H27.4442L25.2694 16.3935ZM10.1746 20.2468C8.11201 20.2468 6.43399 21.9248 6.43399 23.9874C6.43399 26.05 8.11207 27.7281 10.1746 27.7281C12.2372 27.7281 13.9153 26.05 13.9153 23.9874C13.9153 21.9248 12.2372 20.2468 10.1746 20.2468ZM10.1746 25.4837C9.34946 25.4837 8.67838 24.8126 8.67838 23.9874C8.67838 23.1622 9.34946 22.4912 10.1746 22.4912C10.9998 22.4912 11.6709 23.1622 11.6709 23.9874C11.6709 24.8126 10.9998 25.4837 10.1746 25.4837Z" fill="#272727"/>
</svg></a>
<span class="cartNo">
<?php echo WC()->cart->get_cart_contents_count(); ?>
</span></li>
    <?php $fragments['li.cart'] = ob_get_clean();
    return $fragments;
});
