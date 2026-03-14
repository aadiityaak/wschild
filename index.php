<?php

/**
 * The main template file
 * Path: index.php
 */

if (! defined('ABSPATH')) {
	exit;
}

get_header();

// Show the front page if it's set in the WordPress settings
if (is_front_page() && ! is_home()) {
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			the_content();
		}
	}
} else {
	// Show the blog archive
	$blog_title = get_the_title(get_option('page_for_posts', true));
	$blog_desc = get_the_archive_description();
?>
	<main id="primary" class="wschild-blog-page">
		<header class="wschild-blog-header">
			<div class="wschild-container">
				<h1 class="wschild-blog-header__title"><?php echo esc_html($blog_title ?: 'Blog'); ?></h1>
				<?php if ($blog_desc) : ?>
					<div class="wschild-blog-header__desc"><?php echo wp_kses_post($blog_desc); ?></div>
				<?php endif; ?>
			</div>
		</header>

		<section class="wschild-blog-section">
			<div class="wschild-container">
				<?php if (have_posts()) : ?>
					<div class="wschild-blog-grid">
						<?php
						while (have_posts()) :
							the_post();
							get_template_part('src/component/blog/card');
						endwhile;
						?>
					</div>

					<div class="wschild-pagination">
						<?php
						the_posts_pagination([
							'mid_size'  => 2,
							'prev_text' => __('&laquo; Sebelumnya', 'wschild'),
							'next_text' => __('Selanjutnya &raquo;', 'wschild'),
						]);
						?>
					</div>

				<?php else : ?>
					<div class="wschild-no-posts">
						<p><?php _e('Maaf, tidak ada postingan yang ditemukan.', 'wschild'); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</section>
	</main>
<?php
}

get_footer();
