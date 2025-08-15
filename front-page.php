<?php get_header(); ?>

<?php
// Hero Options
$hero_bg_color      = get_option('nonna_hero_bg_color', '#fff');
$hero_bg_image      = get_option('nonna_hero_bg_image', '');
$hero_image         = get_option('nonna_hero_image', '');
$heading            = get_option('nonna_hero_heading', '');
$subheading         = get_option('nonna_hero_subheading', '');
$text               = get_option('nonna_hero_text', '');
$cta_text           = get_option('nonna_hero_cta_text', '');
$cta_url            = get_option('nonna_hero_cta_url', '');
$layout             = get_option('nonna_hero_layout', 'image-left');
// About Options
$about_bg_color     = get_option('nonna_about_bg_color', '#ffff');
$about_image        = get_option('nonna_about_image', '');
$badge_enabled      = (int) get_option('nonna_about_badge_enabled', 0);
$badge_img          = trim( get_option('nonna_about_badge_image', '') );
$badge_pos          = get_option('nonna_about_badge_position', 'top-right');
$about_cta_text     = get_option('nonna_about_resume_label', '');
$about_cta_url      = get_option('nonna_about_resume_file', '');
// Skills Options
$skills_bg_color    = get_option('nonna_skills_bg', '#fff');
$skills_heading     = get_option('nonna_skills_heading', '');
$skills_rows = get_option('nonna_skills_items', []);


$hero_style = "background-color: {$hero_bg_color};";
if ($hero_bg_image) {
    $hero_style .= " background-image: url({$hero_bg_image}); background-size: cover; background-position: center;";
}
?>

<section class="hero" style="<?php echo esc_attr($hero_style); ?>">
    <div class="wrapper">
        <div class="container">
            <?php
            $hero_image_html = $hero_image ? '<figure class="container__image hero__image"><img src="' . esc_url($hero_image) . '" alt=""></figure>' : '';
            $content_html = '<div class="container__content hero__content">'
                . ($heading ? '<h1>' . esc_html($heading) . '</h1>' : '')
                . ($subheading ? '<h2>' . esc_html($subheading) . '</h2>' : '')
                . ($text ? '<p>' . esc_html($text) . '</p>' : '')
                . ($cta_text && $cta_url ? '<a href="' . esc_url($cta_url) . '" class="cta cta__yellow">' . esc_html($cta_text) . '</a>' : '')
                . '</div>';

            switch ($layout) {
                case 'image-left':
                    echo $hero_image_html . $content_html;
                    break;
                case 'content-left':
                    echo $content_html . $hero_image_html;
                    break;
                case 'image-top':
                    echo '<div style="flex-basis: 100%; text-align: center;">' . $hero_image_html . '</div>';
                    echo '<div style="flex-basis: 100%; text-align: center;">' . $content_html . '</div>';
                    break;
                case 'content-top':
                    echo '<div style="flex-basis: 100%; text-align: center;">' . $content_html . '</div>';
                    echo '<div style="flex-basis: 100%; text-align: center;">' . $hero_image_html . '</div>';
                    break;
            }
            ?>
        </div>
    </div>
</section>
<section class="about section-padding" style="background-color: <?php echo $about_bg_color ?>">
    <div class="wrapper">
        <div class="container">
            <div class="about__content container__content">
                <?php $sections = get_option('nonna_about_sections', array());
                if (!empty($sections) && is_array($sections)) {
                    foreach ($sections as $row) {
                        $heading = isset($row['heading']) ? $row['heading'] : '';
                        $text    = isset($row['text']) ? $row['text'] : '';
                        if ($heading || $text) {
                            echo '<div class="about-me">';
                                if ($heading) echo '<h3>'.esc_html($heading).'</h3>';
                                if ($text)    echo wpautop(wp_kses_post($text));
                            echo '</div>';
                        }
                    }
                } ?>
                <a class="about-cta cta cta__pink" href="<?php echo $about_cta_url ?>"><?php echo $about_cta_text ?></a> 
            </div>
            <?php if ( ! empty( $about_image ) ) : ?>
                <figure class="about__image-container container__image">
                    <?php if ( $badge_enabled && $badge_img !== '' ) : ?>
                        <span class="about-badge badge--<?php echo esc_attr( $badge_pos ); ?>">
                            <img class="about-badge__img" src="<?php echo esc_url( $badge_img ); ?>" alt="" />
                        </span>
                    <?php endif; ?>
                    <img class="about-image" src="<?php echo esc_url( $about_image ); ?>" alt="">
                </figure>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="skills section-padding" style="background-color: <?php echo $skills_bg_color ?>;">
    <div class="wrapper">
        <h3><?php echo $skills_heading ?></h3>
        <ul class="skills__list">
            <?php foreach ($skills_rows as $row) :
                $icon = trim($row['icon_class'] ?? '');
                $desc = trim($row['description'] ?? '');
                if ($icon === '' && $desc === '') continue;
                ?>
                <li class="skills__item">
                    <?php if ($icon) : ?>
                        <i class="<?php echo $icon ?>" aria-hidden="true"></i>
                    <?php endif; ?>
                    <?php if ($desc) : ?>
                        <span class="skills__label"><?php echo esc_html($desc); ?></span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<?php get_footer(); ?>
