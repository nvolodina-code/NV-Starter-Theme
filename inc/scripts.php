<?php
function nonna_enqueue_assets() {
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css', [], '1.0');
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'nonna_enqueue_assets');