<?php
function nonna_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption']);
    add_theme_support('custom-logo');
    register_nav_menus(['primary' => __('Primary Menu', 'nonna-portfolio')]);
}
add_action('after_setup_theme', 'nonna_theme_setup');