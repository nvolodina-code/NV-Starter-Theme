<?php
/**
 * Admin Menus
 */
function nonna_register_theme_options() {
    add_menu_page(
        'Theme Options',                  // Page title
        'Customize Theme',                // Menu title
        'manage_options',                 // Capability
        'nonna_theme_options',            // Slug
        'nonna_theme_options_page',       // Callback
        'dashicons-admin-customizer',     // Icon
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


/**
 * Root “Theme Options” page
 */
function nonna_theme_options_page() { ?>
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
<?php }

/**
 * Root page settings (Intro)
 */
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
        function () {
            $value = get_option('nonna_portfolio_intro', '');
            echo '<textarea name="nonna_portfolio_intro" rows="5" cols="60">' . esc_textarea($value) . '</textarea>';
        },
        'nonna_theme_options',
        'nonna_main_section'
    );
}
add_action('admin_init', 'nonna_register_theme_settings');


/**
 * Hero Section page + settings
 */
function nonna_theme_hero_section() { ?>
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
<?php }

function nonna_register_hero_settings() {
    // Settings
    register_setting('nonna_hero_group', 'nonna_hero_layout');
    register_setting('nonna_hero_group', 'nonna_hero_bg_color');
    register_setting('nonna_hero_group', 'nonna_hero_bg_image');
    register_setting('nonna_hero_group', 'nonna_hero_image');
    register_setting('nonna_hero_group', 'nonna_hero_heading');
    register_setting('nonna_hero_group', 'nonna_hero_subheading');
    register_setting('nonna_hero_group', 'nonna_hero_text');
    register_setting('nonna_hero_group', 'nonna_hero_cta_text');
    register_setting('nonna_hero_group', 'nonna_hero_cta_url');

    // Section
    add_settings_section(
        'nonna_hero_section',
        'Hero Section Settings',
        null,
        'nonna_theme_hero'
    );

    // Fields
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
        echo ' <button type="button" class="button nonna-upload-btn" data-target="' . esc_attr($input_id) . '" data-type="image">Choose Image</button>';
    }, 'nonna_theme_hero', 'nonna_hero_section');

    add_settings_field('nonna_hero_image', 'Hero Image', function () {
        $value = get_option('nonna_hero_image', '');
        $input_id = 'nonna_hero_image';
        echo '<input type="text" id="' . esc_attr($input_id) . '" name="nonna_hero_image" value="' . esc_attr($value) . '" size="60" />';
        echo ' <button type="button" class="button nonna-upload-btn" data-target="' . esc_attr($input_id) . '" data-type="image">Choose Image</button>';
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


/**
 * About Section page + settings
 */
function nonna_theme_about_section() { ?>
    <div class="wrap">
        <h1>About Section</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('nonna_about_group');
            do_settings_sections('nonna_theme_about');
            submit_button();
            ?>
        </form>
    </div>
<?php }

function nonna_register_about_settings() {

    /**
     * SETTINGS (register_setting)
     */

    // Repeater: About Sections (heading + text)
    register_setting(
        'nonna_about_group',
        'nonna_about_sections',
        array(
            'type'              => 'array',
            'sanitize_callback' => function($input) {
                $out = array();
                if (is_array($input)) {
                    foreach ($input as $row) {
                        $heading = isset($row['heading']) ? sanitize_text_field($row['heading']) : '';
                        $text    = isset($row['text']) ? wp_kses_post($row['text']) : '';
                        if ($heading !== '' || $text !== '') {
                            $out[] = array('heading' => $heading, 'text' => $text);
                        }
                    }
                }
                return $out;
            }
        )
    );

    // Repeater: Education (degree, school, years)
    register_setting(
        'nonna_about_group',
        'nonna_about_education',
        array(
            'type'              => 'array',
            'sanitize_callback' => function($input){
                $out = array();
                if (is_array($input)) {
                    foreach ($input as $row) {
                        $degree = isset($row['degree']) ? sanitize_text_field($row['degree']) : '';
                        $school = isset($row['school']) ? sanitize_text_field($row['school']) : '';
                        $years  = isset($row['years'])  ? sanitize_text_field($row['years'])  : '';
                        if ($degree !== '' || $school !== '' || $years !== '') {
                            $out[] = compact('degree','school','years');
                        }
                    }
                }
                return $out;
            }
        )
    );

    // Resume CTA
    register_setting('nonna_about_group', 'nonna_about_resume_label');
    register_setting('nonna_about_group', 'nonna_about_resume_file');

    // About Image
    register_setting('nonna_about_group', 'nonna_about_image');

    // Badge (enabled/position/text only)
    register_setting('nonna_about_group', 'nonna_about_badge_enabled', array(
        'type'              => 'boolean',
        'sanitize_callback' => function($v){ return $v ? 1 : 0; },
        'default'           => 0,
    ));
    register_setting('nonna_about_group', 'nonna_about_badge_position', array(
        'type'              => 'string',
        'sanitize_callback' => function($v){
            $allowed = array('top-left','top-right','bottom-left','bottom-right');
            return in_array($v, $allowed, true) ? $v : 'top-right';
        },
        'default'           => 'top-right',
    ));
    register_setting('nonna_about_group', 'nonna_about_badge_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ));

    /**
     * SECTION (add_settings_section)
     */
    add_settings_section(
        'nonna_about_section',
        'About Section Settings',
        null,
        'nonna_theme_about'
    );

    /**
     * FIELDS (add_settings_field)
     */

    // Repeater: About Sections
    add_settings_field(
        'nonna_about_sections',
        'About Sections',
        function () {
            $rows = get_option('nonna_about_sections', array());
            if (!is_array($rows)) $rows = array();
            $field_name = 'nonna_about_sections';

            echo '<div id="nonna-about-repeater">';

            if (!empty($rows)) {
                foreach ($rows as $i => $row) {
                    $heading = isset($row['heading']) ? $row['heading'] : '';
                    $text    = isset($row['text']) ? $row['text'] : '';
                    ?>
                    <div class="nonna-repeater-row" style="margin:0 0 16px; padding:12px; border:1px solid #ddd; background:#fff;">
                        <p>
                            <label><strong>Heading</strong></label><br>
                            <input type="text"
                                   name="<?php echo esc_attr($field_name); ?>[<?php echo (int)$i; ?>][heading]"
                                   value="<?php echo esc_attr($heading); ?>"
                                   size="60">
                        </p>
                        <p>
                            <label><strong>Text</strong></label><br>
                            <textarea name="<?php echo esc_attr($field_name); ?>[<?php echo (int)$i; ?>][text]"
                                      rows="5" cols="60"><?php echo esc_textarea($text); ?></textarea>
                        </p>
                        <button type="button" class="button link-delete-row">Remove</button>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="nonna-repeater-row" style="margin:0 0 16px; padding:12px; border:1px solid #ddd; background:#fff;">
                    <p>
                        <label><strong>Heading</strong></label><br>
                        <input type="text" name="<?php echo esc_attr($field_name); ?>[0][heading]" value="" size="60">
                    </p>
                    <p>
                        <label><strong>Text</strong></label><br>
                        <textarea name="<?php echo esc_attr($field_name); ?>[0][text]" rows="5" cols="60"></textarea>
                    </p>
                    <button type="button" class="button link-delete-row">Remove</button>
                </div>
                <?php
            }

            echo '</div>';
            echo '<p><button type="button" class="button button-secondary" id="nonna-add-row">Add Section</button></p>';
            ?>
            <script type="text/html" id="tmpl-nonna-repeater-row">
                <div class="nonna-repeater-row" style="margin:0 0 16px; padding:12px; border:1px solid #ddd; background:#fff;">
                    <p>
                        <label><strong>Heading</strong></label><br>
                        <input type="text" name="<?php echo esc_attr($field_name); ?>[{{INDEX}}][heading]" value="" size="60">
                    </p>
                    <p>
                        <label><strong>Text</strong></label><br>
                        <textarea name="<?php echo esc_attr($field_name); ?>[{{INDEX}}][text]" rows="5" cols="60"></textarea>
                    </p>
                    <button type="button" class="button link-delete-row">Remove</button>
                </div>
            </script>
            <script>
            (function(){
                const wrap  = document.getElementById('nonna-about-repeater');
                const add   = document.getElementById('nonna-add-row');
                const tmpl  = document.getElementById('tmpl-nonna-repeater-row').textContent;

                function getNextIndex(){
                    const rows = wrap.querySelectorAll('.nonna-repeater-row');
                    let max = -1;
                    rows.forEach(function(row){
                        const inp = row.querySelector('input[name^="nonna_about_sections["]');
                        if (!inp) return;
                        const m = inp.name.match(/nonna_about_sections\[(\d+)\]\[heading\]/);
                        if (m) { const idx = parseInt(m[1], 10); if (idx > max) max = idx; }
                    });
                    return max + 1;
                }

                function bindRemove(scope){
                    (scope || document).querySelectorAll('.link-delete-row').forEach(function(btn){
                        btn.addEventListener('click', function(){
                            const row = this.closest('.nonna-repeater-row');
                            if (row && wrap.children.length > 1) row.remove();
                            else if (row) {
                                const input = row.querySelector('input[type="text"]');
                                const textarea = row.querySelector('textarea');
                                if (input) input.value = '';
                                if (textarea) textarea.value = '';
                            }
                        });
                    });
                }

                add.addEventListener('click', function(){
                    const idx = getNextIndex();
                    const html = tmpl.replace(/{{INDEX}}/g, String(idx));
                    const temp = document.createElement('div');
                    temp.innerHTML = html.trim();
                    const node = temp.firstElementChild;
                    wrap.appendChild(node);
                    bindRemove(node);
                });

                bindRemove();
            })();
            </script>
            <?php
        },
        'nonna_theme_about',
        'nonna_about_section'
    );

    // Repeater: Education
    add_settings_field(
        'nonna_about_education',
        'Education',
        function () {
            $rows = get_option('nonna_about_education', array());
            if (!is_array($rows)) $rows = array();
            $field_name = 'nonna_about_education';

            echo '<div id="nonna-education-repeater">';

            if (!empty($rows)) {
                foreach ($rows as $i => $row) {
                    $degree = isset($row['degree']) ? $row['degree'] : '';
                    $school = isset($row['school']) ? $row['school'] : '';
                    $years  = isset($row['years'])  ? $row['years']  : '';
                    ?>
                    <div class="nonna-repeater-row" style="margin:0 0 16px; padding:12px; border:1px solid #ddd; background:#fff;">
                        <p style="margin-bottom:8px;">
                            <label><strong>Degree</strong></label><br>
                            <input type="text" name="<?php echo esc_attr($field_name); ?>[<?php echo (int)$i; ?>][degree]" value="<?php echo esc_attr($degree); ?>" size="40" placeholder="e.g., MLIS">
                        </p>
                        <p style="margin-bottom:8px;">
                            <label><strong>School</strong></label><br>
                            <input type="text" name="<?php echo esc_attr($field_name); ?>[<?php echo (int)$i; ?>][school]" value="<?php echo esc_attr($school); ?>" size="40" placeholder="e.g., University of Toronto">
                        </p>
                        <p style="margin-bottom:8px;">
                            <label><strong>Years</strong></label><br>
                            <input type="text" name="<?php echo esc_attr($field_name); ?>[<?php echo (int)$i; ?>][years]" value="<?php echo esc_attr($years); ?>" size="20" placeholder="e.g., 2012–2016">
                        </p>
                        <button type="button" class="button link-delete-row">Remove</button>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="nonna-repeater-row" style="margin:0 0 16px; padding:12px; border:1px solid #ddd; background:#fff;">
                    <p style="margin-bottom:8px;">
                        <label><strong>Degree</strong></label><br>
                        <input type="text" name="<?php echo esc_attr($field_name); ?>[0][degree]" value="" size="40" placeholder="e.g., MLIS">
                    </p>
                    <p style="margin-bottom:8px;">
                        <label><strong>School</strong></label><br>
                        <input type="text" name="<?php echo esc_attr($field_name); ?>[0][school]" value="" size="40" placeholder="e.g., University of Toronto">
                    </p>
                    <p style="margin-bottom:8px;">
                        <label><strong>Years</strong></label><br>
                        <input type="text" name="<?php echo esc_attr($field_name); ?>[0][years]" value="" size="20" placeholder="e.g., 2012–2016">
                    </p>
                    <button type="button" class="button link-delete-row">Remove</button>
                </div>
                <?php
            }

            echo '</div>';
            echo '<p><button type="button" class="button button-secondary" id="nonna-education-add">Add Education</button></p>';
            ?>
            <script type="text/html" id="tmpl-nonna-education-row">
                <div class="nonna-repeater-row" style="margin:0 0 16px; padding:12px; border:1px solid #ddd; background:#fff;">
                    <p style="margin-bottom:8px;">
                        <label><strong>Degree</strong></label><br>
                        <input type="text" name="<?php echo esc_attr($field_name); ?>[{{INDEX}}][degree]" value="" size="40" placeholder="e.g., MLIS">
                    </p>
                    <p style="margin-bottom:8px;">
                        <label><strong>School</strong></label><br>
                        <input type="text" name="<?php echo esc_attr($field_name); ?>[{{INDEX}}][school]" value="" size="40" placeholder="e.g., University of Toronto">
                    </p>
                    <p style="margin-bottom:8px;">
                        <label><strong>Years</strong></label><br>
                        <input type="text" name="<?php echo esc_attr($field_name); ?>[{{INDEX}}][years]" value="" size="20" placeholder="e.g., 2012–2016">
                    </p>
                    <button type="button" class="button link-delete-row">Remove</button>
                </div>
            </script>
            <script>
            (function(){
                const wrap  = document.getElementById('nonna-education-repeater');
                const add   = document.getElementById('nonna-education-add');
                const tmpl  = document.getElementById('tmpl-nonna-education-row').textContent;

                function getNextIndex(){
                    const rows = wrap.querySelectorAll('.nonna-repeater-row');
                    let max = -1;
                    rows.forEach(function(row){
                        const inp = row.querySelector('input[name^="nonna_about_education["]');
                        if (!inp) return;
                        const m = inp.name.match(/nonna_about_education\[(\d+)\]\[degree\]/);
                        if (m) { const idx = parseInt(m[1], 10); if (idx > max) max = idx; }
                    });
                    return max + 1;
                }

                function bindRemove(scope){
                    (scope || document).querySelectorAll('.link-delete-row').forEach(function(btn){
                        btn.addEventListener('click', function(){
                            const row = this.closest('.nonna-repeater-row');
                            if (row && wrap.children.length > 1) row.remove();
                            else if (row) {
                                row.querySelectorAll('input').forEach(i => i.value = '');
                            }
                        });
                    });
                }

                add.addEventListener('click', function(){
                    const idx = getNextIndex();
                    const html = tmpl.replace(/{{INDEX}}/g, String(idx));
                    const temp = document.createElement('div');
                    temp.innerHTML = html.trim();
                    const node = temp.firstElementChild;
                    wrap.appendChild(node);
                    bindRemove(node);
                });

                bindRemove();
            })();
            </script>
            <?php
        },
        'nonna_theme_about',
        'nonna_about_section'
    );

    // Resume CTA
    add_settings_field('nonna_about_resume_label', 'Resume Button Label', function () {
        $value = get_option('nonna_about_resume_label', '');
        echo '<input type="text" name="nonna_about_resume_label" value="' . esc_attr($value) . '" size="60">';
    }, 'nonna_theme_about', 'nonna_about_section');

    add_settings_field('nonna_about_resume_file', 'Resume File URL', function () {
        $value = get_option('nonna_about_resume_file', '');
        $input_id = 'nonna_about_resume_file';
        echo '<input type="text" id="' . esc_attr($input_id) . '" name="nonna_about_resume_file" value="' . esc_attr($value) . '" size="60" />';
        echo ' <button type="button" class="button nonna-upload-btn" data-target="' . esc_attr($input_id) . '" data-type="file">Choose File</button>';
    }, 'nonna_theme_about', 'nonna_about_section');

    // About Image
    add_settings_field('nonna_about_image', 'About Image', function () {
        $value = get_option('nonna_about_image', '');
        $input_id = 'nonna_about_image';
        echo '<input type="text" id="' . esc_attr($input_id) . '" name="nonna_about_image" value="' . esc_attr($value) . '" size="60" />';
        echo ' <button type="button" class="button nonna-upload-btn" data-target="' . esc_attr($input_id) . '" data-type="image">Choose Image</button>';
    }, 'nonna_theme_about', 'nonna_about_section');

    // Badge (enabled / position / text only)
    add_settings_field('nonna_about_badge_enabled', 'Show Badge', function () {
        $value = (int) get_option('nonna_about_badge_enabled', 0);
        echo '<label><input type="checkbox" id="nonna_about_badge_enabled" name="nonna_about_badge_enabled" value="1" ' . checked(1, $value, false) . '> Enable badge</label>';
    }, 'nonna_theme_about', 'nonna_about_section');

    add_settings_field('nonna_about_badge_position', 'Badge Position', function () {
        $value   = get_option('nonna_about_badge_position', 'top-right');
        $options = array(
            'top-left'     => 'Top Left',
            'top-right'    => 'Top Right',
            'bottom-left'  => 'Bottom Left',
            'bottom-right' => 'Bottom Right',
        );
        echo '<select id="nonna_about_badge_position" name="nonna_about_badge_position">';
        foreach ($options as $k => $label) {
            echo '<option value="'.esc_attr($k).'" '.selected($value, $k, false).'>'.esc_html($label).'</option>';
        }
        echo '</select>';
    }, 'nonna_theme_about', 'nonna_about_section');

    add_settings_field('nonna_about_badge_text', 'Badge Text', function () {
        $value = get_option('nonna_about_badge_text', '');
        echo '<input type="text" id="nonna_about_badge_text" name="nonna_about_badge_text" value="' . esc_attr($value) . '" size="60" placeholder="e.g., Available for hire">';
    }, 'nonna_theme_about', 'nonna_about_section');
}


/**
 * Hook settings registrations
 */
add_action('admin_init', function () {
    nonna_register_hero_settings();
    nonna_register_about_settings();
});
