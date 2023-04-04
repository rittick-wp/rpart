<?php 

function rpart_theme_support(){
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ));
    add_theme_support('title-tag');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('woocommerce');
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'wc-product-gallery-lightbox' );
}
add_action('after_setup_theme', 'rpart_theme_support');
// Register Navigation Menus
function rpart_navigation_menus(){
    register_nav_menus(array(
        'headerMenu' => 'Header Menu',
        'FooterCategory' => 'Footer Category Menu',
        'Policies' => 'Privacy Policies Menu',
    ));
}
add_action('init', 'rpart_navigation_menus');