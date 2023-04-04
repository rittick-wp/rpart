<?php

// Register Style
function rpart_add_theme_style()
{
    wp_register_style('rpart-style', get_theme_file_uri('/assets/css/style.min.css'), array(), '1.0.0', 'all');
    wp_register_script('theme-main', get_theme_file_uri('/assets/js/main.js'), array(), '1.0.0', true);

    wp_enqueue_style('rpart-style');
    wp_enqueue_script('flexslider');

    function custom_quick_view_ajaxurl()
    {
        echo '<script type="text/javascript">
                var ajaxurl = "' . admin_url('admin-ajax.php') . '";
              </script>';
    }
    add_action('wp_head', 'custom_quick_view_ajaxurl');
    wp_enqueue_script('theme-main');
}
add_action('wp_enqueue_scripts', 'rpart_add_theme_style');

// Fully Disable Gutenberg editor.
add_filter('use_block_editor_for_post_type', '__return_false', 10);
remove_action('enqueue_block_assets', 'wp_enqueue_registered_block_scripts_and_styles');
add_action('wp_enqueue_scripts', 'remove_block_css', 100);
function remove_block_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('global-styles-inline');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
}

if (defined('YITH_WCWL')) {
    function yith_wcwl_dequeue_font_awesome_styles()
    {
        wp_deregister_style('woocommerce_prettyPhoto_css');
        wp_deregister_style('jquery-selectBox');
        wp_deregister_style('yith-wcwl-font-awesome');
        wp_deregister_style('yith-wcwl-main');

        $assets_path = str_replace(array( 'http:', 'https:' ), '', WC()->plugin_url()) . '/assets/';
        wp_register_style('jquery-selectBox', YITH_WCWL_URL . 'assets/css/jquery.selectBox.css', array(), '1.2.0');
        wp_register_style('woocommerce_prettyPhoto_css', $assets_path . 'css/prettyPhoto.css');
        wp_register_style('yith-wcwl-main', YITH_WCWL_URL . 'assets/css/style.css', array( 'jquery-selectBox' ), '1.0.0');
    }
    add_action('wp_enqueue_scripts', 'yith_wcwl_dequeue_font_awesome_styles', 11);
}
