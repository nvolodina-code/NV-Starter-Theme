<?php get_header(); ?>

<?php
// === HERO SECTION OPTIONS ===
$bg_color   = get_option('nonna_hero_bg_color', '#ffffff');
$bg_image   = get_option('nonna_hero_bg_image', '');
$image      = get_option('nonna_hero_image', '');
$heading    = get_option('nonna_hero_heading', '');
$subheading = get_option('nonna_hero_subheading', '');
$text       = get_option('nonna_hero_text', '');
$cta_text   = get_option('nonna_hero_cta_text', '');
$cta_url    = get_option('nonna_hero_cta_url', '');
$layout     = get_option('nonna_hero_layout', 'image-left');

// === HERO STYLES ===
$hero_style = "background-color: {$bg_color};";
if ($bg_image) {
    $hero_style .= " background-image: url({$bg_image}); background-size: cover; background-position: center;";
}
?>

<section class="hero" style="<?php echo esc_attr($hero_style); ?>">
    <div class="container wrapper" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 40px;">
        <?php
        $image_html = $image ? '<div class="hero-image" style="flex:1 1 300px;"><img src="' . esc_url($image) . '" alt="" style="width:100%; height:auto; border-radius: 10px;"></div>' : '';
        $content_html = '<div class="hero-content" style="flex:1 1 300px;">'
            . ($heading ? '<h1 style="margin-bottom: 10px;">' . esc_html($heading) . '</h1>' : '')
            . ($subheading ? '<h3 style="margin-bottom: 20px;">' . esc_html($subheading) . '</h3>' : '')
            . ($text ? '<p style="margin-bottom: 20px;">' . esc_html($text) . '</p>' : '')
            . ($cta_text && $cta_url ? '<a href="' . esc_url($cta_url) . '" class="hero-cta" style="display: inline-block; padding: 10px 20px; background: #333; color: #fff; border-radius: 4px;">' . esc_html($cta_text) . '</a>' : '')
            . '</div>';

        switch ($layout) {
            case 'image-left':
                echo $image_html . $content_html;
                break;
            case 'content-left':
                echo $content_html . $image_html;
                break;
            case 'image-top':
                echo '<div style="flex-basis: 100%; text-align: center;">' . $image_html . '</div>';
                echo '<div style="flex-basis: 100%; text-align: center;">' . $content_html . '</div>';
                break;
            case 'content-top':
                echo '<div style="flex-basis: 100%; text-align: center;">' . $content_html . '</div>';
                echo '<div style="flex-basis: 100%; text-align: center;">' . $image_html . '</div>';
                break;
        }
        ?>
    </div>
</section>

<?php get_footer(); ?>
