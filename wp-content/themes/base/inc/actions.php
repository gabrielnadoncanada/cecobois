<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), ASSET_VERSION);
    wp_enqueue_script('theme-script', SCRIPT_DIR . '/main.js', ['jquery'], ASSET_VERSION, true);
});

add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array(), ASSET_VERSION);
});


add_action('after_setup_theme', function () {
    remove_theme_support('core-block-patterns');
});




add_action('admin_menu', 'calculatrice_plugin_menu');

function calculatrice_plugin_menu()
{
    add_submenu_page('edit.php?post_type=calc_cecobois',
        'Calculatrices Iframe',
        'Calculatrices Iframe',
        'manage_options',
        'edit.php?post_type=calc_iframe'
    );
}

add_action('admin_init', function () {
    remove_submenu_page('edit.php?post_type=calc_cecobois', 'post-new.php?post_type=calc_cecobois');
});


function calc_redirect() {
    global $post;

    if(get_post_type() == 'calc_cecobois') {

        if(!is_user_logged_in()){
            wp_redirect( get_site_url() );
        }
    }
}
add_action( 'template_redirect', 'calc_redirect' );
