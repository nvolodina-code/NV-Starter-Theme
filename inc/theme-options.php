<?php
function nonna_register_theme_options() {
    add_menu_page(
        'Theme Options',          // Page title
        'Customize',          // Menu title
        'manage_options',         // Capability
        'nonna_theme_options',    // Slug
        'nonna_theme_options_page', // Callback
        'dashicons-admin-customizer', // Icon
        61
    );
}
add_action('admin_menu', 'nonna_register_theme_options');

function nonna_theme_options_page() {
    ?>
    <div class="wrap">
        <h1>Customize Your Website Here!</h1>
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
