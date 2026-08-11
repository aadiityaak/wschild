<?php

if (! defined('ABSPATH')) {
  exit;
}

get_header();
?>

<main id="primary" class="wschild-page">
  <?php
  while (have_posts()) {
    the_post();
  ?>
    <article id="page-<?php the_ID(); ?>" <?php post_class('wschild-article'); ?>>
      <header class="wschild-article__header">
        <div class="wschild-container">
          <h1 class="wschild-article__title"><?php the_title(); ?></h1>
        </div>
      </header>

      <div class="wschild-article__body">
        <div class="wschild-container wschild-container--narrow">
          <div class="wschild-article__content">
            <?php
            the_content();

            wp_link_pages([
              'before' => '<div class="page-links">' . esc_html__('Halaman:', 'wschild'),
              'after'  => '</div>',
            ]);
            ?>
          </div>
        </div>
      </div>
    </article>
  <?php } ?>
</main>

<?php
get_footer();
