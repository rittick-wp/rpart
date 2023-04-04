<?php
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_get_items_count' ) ) {
  function yith_wcwl_get_items_count() {
    ob_start();
    ?>
      <a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>">
<svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M27.6294 3.35086C26.1063 1.83329 24.0438 0.981201 21.8936 0.981201C19.7435 0.981201 17.681 1.83329 16.1579 3.35086L15 4.50873L13.8421 3.35086C12.319 1.83329 10.2565 0.981201 8.10635 0.981201C5.95623 0.981201 3.89374 1.83329 2.37058 3.35086C0.852362 4.87584 0 6.94011 0 9.09199C0 11.2439 0.852362 13.3081 2.37058 14.8331L14.2388 26.7013C14.3385 26.8018 14.457 26.8816 14.5877 26.936C14.7183 26.9904 14.8585 27.0185 15 27.0185C15.1415 27.0185 15.2817 26.9904 15.4123 26.936C15.543 26.8816 15.6615 26.8018 15.7612 26.7013L27.6294 14.8331C29.1476 13.3081 30 11.2439 30 9.09199C30 6.94011 29.1476 4.87584 27.6294 3.35086ZM26.1177 13.3107L15 24.4285L3.88225 13.3107C2.7647 12.1911 2.13704 10.6739 2.13704 9.09199C2.13704 7.51009 2.7647 5.99283 3.88225 4.87325C5.00367 3.75504 6.5227 3.12711 8.10635 3.12711C9.69 3.12711 11.209 3.75504 12.3305 4.87325L14.2388 6.7816C14.3385 6.88208 14.457 6.96184 14.5877 7.01627C14.7183 7.0707 14.8585 7.09873 15 7.09873C15.1415 7.09873 15.2817 7.0707 15.4123 7.01627C15.543 6.96184 15.6615 6.88208 15.7612 6.7816L17.6695 4.87325C18.791 3.75504 20.31 3.12711 21.8936 3.12711C23.4773 3.12711 24.9963 3.75504 26.1177 4.87325C27.2353 5.99283 27.863 7.51009 27.863 9.09199C27.863 10.6739 27.2353 12.1911 26.1177 13.3107Z" fill="#272727"/>
</svg>
<span class="cartNo wishlistCounter">
<?php echo esc_html( yith_wcwl_count_all_products() ); ?>
</span>
      </a>
    <?php
    return ob_get_clean();
  }

  add_shortcode( 'yith_wcwl_items_count', 'yith_wcwl_get_items_count' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ) {
  function yith_wcwl_ajax_update_count() {
    wp_send_json( array(
      'count' => yith_wcwl_count_all_products()
    ) );
  }

  add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
  add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_enqueue_custom_script' ) ) {
  function yith_wcwl_enqueue_custom_script() {
    wp_add_inline_script(
      'jquery-yith-wcwl',
      "
        jQuery( function( $ ) {
          $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
            $.get( yith_wcwl_l10n.ajax_url, {
              action: 'yith_wcwl_update_wishlist_count'
            }, function( data ) {
              $('.wishlistCounter').html( data.count );
            } );
          } );
        } );
      "
    );
  }

  add_action( 'wp_enqueue_scripts', 'yith_wcwl_enqueue_custom_script', 20 );
}