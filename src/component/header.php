<?php

/**
 * Header Component
 * Path: src/component/header.php
 */

$logo_url = 'https://websweetstudio.com/wp-content/uploads/2023/04/black.png';
$home_url = home_url('/');
?>

<div class="wschild-header" x-data="{ mobileMenuOpen: false }">
  <div class="umroh-container">
    <div class="wschild-header__inner">
      <!-- Logo Section -->
      <div class="wschild-header__logo">
        <a href="<?php echo esc_url($home_url); ?>">
          <img fetchpriority="high" width="120" src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>">
        </a>
      </div>

      <!-- Navigation Section -->
      <div class="wschild-header__nav">
        <!-- Desktop Menu -->
        <nav class="wschild-header__desktop-nav">
          <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'wschild-menu',
            'fallback_cb'    => false,
          ]);
          ?>
        </nav>

        <!-- Mobile Trigger -->
        <button class="wschild-header__mobile-trigger" @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Toggle Menu">
          <svg x-show="!mobileMenuOpen" aria-hidden="true" class="e-font-icon-svg e-fas-bars" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
            <path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path>
          </svg>
          <svg x-show="mobileMenuOpen" x-cloak aria-hidden="true" class="e-font-icon-svg e-fas-times" viewBox="0 0 352 512" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
            <path d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu Overlay -->
  <div
    class="wschild-header__mobile-overlay"
    x-show="mobileMenuOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-4"
    x-cloak>
    <div class="umroh-container">
      <nav class="wschild-header__mobile-nav">
        <?php
        wp_nav_menu([
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'wschild-mobile-menu',
          'fallback_cb'    => false,
        ]);
        ?>
      </nav>
    </div>
  </div>
</div>