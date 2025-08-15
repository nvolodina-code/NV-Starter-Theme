<?php
function nonna_enqueue_assets() {
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.min.css', [], '1.0');
    wp_enqueue_style('reset-css', get_template_directory_uri() . '/assets/css/reset.css', [], '1.0');
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', [], '1.0', true);
    wp_enqueue_style(
        'nonna-montserrat',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap',
        false
    );
    wp_enqueue_style(
        'nonna-gilda',
        'https://fonts.googleapis.com/css2?family=Gilda+Display&display=swap',
        false
    );
    wp_enqueue_style('nonna-reset', get_template_directory_uri() . '/assets/css/reset.css', [], '1.0');
    wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.min.css', ['nonna-reset', 'nonna-montserrat', 'nonna-display'], '1.0');
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'nonna_enqueue_assets');