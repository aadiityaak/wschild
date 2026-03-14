<?php
/*
Template Name: About Us Template
*/

if (! defined('ABSPATH')) {
  exit;
}

get_header();
?>

<main id="primary" class="wschild-about-us">
  <?php
  // Hero section for About Us
  get_template_part(
    'src/component/home/hero',
    null,
    [
      'title'     => 'Tentang Kami',
      'subtitle'  => 'Dengan pengalaman kami yang luas dalam industri ini, kami telah melayani berbagai klien dengan kebutuhan yang beragam, dan kami bangga memberikan solusi kreatif yang memenuhi harapan mereka.',
      'cta_label' => 'Hubungi Kami',
      'cta_url'   => '/kontak',
    ]
  );
  ?>

  <div class="wschild-container">
    <div class="wschild-content-area" style="padding: 60px 0;">
      <?php
      while (have_posts()) {
        the_post();
        the_content();
      }
      ?>
    </div>
  </div>
</main>

<?php
get_footer();
