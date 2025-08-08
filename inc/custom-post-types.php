<?php
function nonna_register_cpt() {
    register_post_type('portfolio', [
        'labels' => ['name' => __('Portfolio'), 'singular_name' => __('Project')],
        'public' => true, 'has_archive' => true,
        'rewrite' => ['slug' => 'portfolio'],
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
    ]);
}
add_action('init', 'nonna_register_cpt');