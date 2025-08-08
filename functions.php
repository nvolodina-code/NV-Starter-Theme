<?php

require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/scripts.php';
require_once get_template_directory() . '/inc/custom-post-types.php';
require_once get_template_directory() . '/inc/theme-options.php';

add_action('admin_enqueue_scripts', function($hook) {
    if (strpos($hook, 'nonna_theme_hero') !== false) {
        wp_enqueue_media();
        wp_enqueue_script('nonna-media-uploader', get_template_directory_uri() . '/assets/js/media-uploader.js', ['jquery'], null, true);
    }
});
