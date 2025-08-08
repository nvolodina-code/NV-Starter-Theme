<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="site-header" style="position: fixed; width: 100%;">
    <div class="container wrapper" style="display: flex; justify-content: space-between; align-items: center;">
      <div class="site-branding">
        <?php if (has_custom_logo()) : ?>
          <?php the_custom_logo(); ?>
        <?php else : ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" style="text-decoration: none;">
            <h1 class="site-title" style="margin: 0;"><?php bloginfo('name'); ?></h1>
            <p class="site-description" style="margin: 0;"><?php bloginfo('description'); ?></p>
          </a>
        <?php endif; ?>
      </div>

      <nav class="main-navigation" role="navigation">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'menu_class'     => 'menu',
            'container'      => false
          ]);
        ?>
      </nav>
    </div>
  </header>
