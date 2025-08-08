<?php
function nonna_register_theme_options() {
    add_menu_page(
        'Theme Options',          // Page title
        'Customize Theme',          // Menu title
        'manage_options',         // Capability
        'nonna_theme_options',    // Slug
        'nonna_theme_options_page', // Callback
        'dashicons-admin-customizer', // Icon
        61
    );

    add_submenu_page(
        'nonna_theme_options',
        'Hero Section',
        'Hero Section',
        'manage_options',
        'nonna_theme_hero',
        'nonna_theme_hero_section'
    );

    add_submenu_page(
        'nonna_theme_options',
        'About Section',
        'About Section',
        'manage_options',
        'nonna_theme_about',
        'nonna_theme_about_section'
    );
}
add_action('admin_menu', 'nonna_register_theme_options');

function nonna_theme_options_page() {
    ?>
    <div class="wrap">
        <h1>Customize Your Website Using the Sub Pages</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('nonna_theme_options_group');
            do_settings_sections('nonna_theme_options');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function nonna_register_theme_settings() {
    register_setting('nonna_theme_options_group', 'nonna_portfolio_intro');

    add_settings_section(
        'nonna_main_section',
        'Make the Website Your Own',
        null,
        'nonna_theme_options'
    );

    add_settings_field(
        'nonna_portfolio_intro',
        'Intro Text',
        'nonna_portfolio_intro_callback',
        'nonna_theme_options',
        'nonna_main_section'
    );
}
add_action('admin_init', 'nonna_register_theme_settings');

function nonna_portfolio_intro_callback() {
    $value = get_option('nonna_portfolio_intro', '');
    echo '<textarea name="nonna_portfolio_intro" rows="5" cols="60">' . esc_textarea($value) . '</textarea>';
}

// Hero Section
function nonna_theme_hero_section() {
    ?>
    <div class="wrap">
        <h1>Hero Section</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('nonna_hero_group');
            do_settings_sections('nonna_theme_hero');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function nonna_register_hero_settings() {
    register_setting('nonna_hero_group', 'nonna_hero_layout');
    register_setting('nonna_hero_group', 'nonna_hero_bg_color');
    register_setting('nonna_hero_group', 'nonna_hero_bg_image');
    register_setting('nonna_hero_group', 'nonna_hero_image');
    register_setting('nonna_hero_group', 'nonna_hero_heading');
    register_setting('nonna_hero_group', 'nonna_hero_subheading');
    register_setting('nonna_hero_group', 'nonna_hero_text');
    register_setting('nonna_hero_group', 'nonna_hero_cta_text');
    register_setting('nonna_hero_group', 'nonna_hero_cta_url');

    add_settings_section(
        'nonna_hero_section',
        'Hero Section Settings',
        null,
        'nonna_theme_hero'
    );

    add_settings_field('nonna_hero_layout', 'Hero Layout', function () {
    $value = get_option('nonna_hero_layout', 'image-left');

    $options = [
        'image-left'   => 'Image Left / Content Right',
        'content-left' => 'Content Left / Image Right',
        'image-top'    => 'Image Top / Content Bottom',
        'content-top'  => 'Content Top / Image Bottom',
    ];

    foreach ($options as $key => $label) {
        echo '<label style="display:block; margin-bottom:4px;">';
        echo '<input type="radio" name="nonna_hero_layout" value="' . esc_attr($key) . '" ' . checked($value, $key, false) . '> ';
        echo esc_html($label);
        echo '</label>';
    }
}, 'nonna_theme_hero', 'nonna_hero_section');

    add_settings_field('nonna_hero_bg_color', 'Background Colour', function () {
        $value = get_option('nonna_hero_bg_color', '#ffffff');
        echo '<input type="color" name="nonna_hero_bg_color" value="' . esc_attr($value) . '">';
    }, 'nonna_theme_hero', 'nonna_hero_section');

    add_settings_field('nonna_hero_bg_image', 'Background Image', function () {
        $value = get_option('nonna_hero_bg_image', '');
        $input_id = 'nonna_hero_bg_image';
        echo '<input type="text" id="' . esc_attr($input_id) . '" name="nonna_hero_bg_image" value="' . esc_attr($value) . '" size="60" />';
        echo ' <button type="button" class="button nonna-upload-btn" data-target="' . esc_attr($input_id) . '">Choose Image</button>';
    }, 'nonna_theme_hero', 'nonna_hero_section');


    add_settings_field('nonna_hero_image', 'Hero Image', function () {
        $value = get_option('nonna_hero_image', '');
        $input_id = 'nonna_hero_image';
        echo '<input type="text" id="' . esc_attr($input_id) . '" name="nonna_hero_image" value="' . esc_attr($value) . '" size="60" />';
        echo ' <button type="button" class="button nonna-upload-btn" data-target="' . esc_attr($input_id) . '">Choose Image</button>';
    }, 'nonna_theme_hero', 'nonna_hero_section');

    add_settings_field('nonna_hero_heading', 'Heading', function () {
        $value = get_option('nonna_hero_heading', '');
        echo '<input type="text" name="nonna_hero_heading" value="' . esc_attr($value) . '" size="60">';
    }, 'nonna_theme_hero', 'nonna_hero_section');

    add_settings_field('nonna_hero_subheading', 'Subheading', function () {
        $value = get_option('nonna_hero_subheading', '');
        echo '<input type="text" name="nonna_hero_subheading" value="' . esc_attr($value) . '" size="60">';
    }, 'nonna_theme_hero', 'nonna_hero_section');

    add_settings_field('nonna_hero_text', 'Text Block', function () {
        $value = get_option('nonna_hero_text', '');
        echo '<textarea name="nonna_hero_text" rows="5" cols="60">' . esc_textarea($value) . '</textarea>';
    }, 'nonna_theme_hero', 'nonna_hero_section');

    add_settings_field('nonna_hero_cta_text', 'CTA Button Text', function () {
        $value = get_option('nonna_hero_cta_text', '');
        echo '<input type="text" name="nonna_hero_cta_text" value="' . esc_attr($value) . '" size="60">';
    }, 'nonna_theme_hero', 'nonna_hero_section');

    add_settings_field('nonna_hero_cta_url', 'CTA Button URL', function () {
        $value = get_option('nonna_hero_cta_url', '');
        echo '<input type="url" name="nonna_hero_cta_url" value="' . esc_attr($value) . '" size="60">';
    }, 'nonna_theme_hero', 'nonna_hero_section');
}


// SOCIAL MEDIA PAGE CONTENT
function nonna_theme_about_section() {
    ?>
    <div class="wrap">
        <h1>About Section</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('nonna_social_group');
            do_settings_sections('nonna_theme_about');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', function () {
    nonna_register_hero_settings();
});
