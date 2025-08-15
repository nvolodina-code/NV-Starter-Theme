<?php
function nonna_enqueue_assets() {
    wp_enqueue_style(
        'nonna-montserrat',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'nonna-gilda',
        'https://fonts.googleapis.com/css2?family=Gilda+Display&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        [],
        '6.5.2'
    );

    wp_enqueue_style(
        'nonna-reset',
        get_template_directory_uri() . '/assets/css/reset.css',
        [],
        '1.0'
    );

    wp_enqueue_style(
        'nonna-main',
        get_template_directory_uri() . '/assets/css/main.min.css',
        ['nonna-reset', 'nonna-montserrat', 'nonna-gilda'],
        '1.0'
    );

    wp_enqueue_script(
        'nonna-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'nonna_enqueue_assets');
