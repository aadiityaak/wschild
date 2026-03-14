<?php

/**
 * The template for displaying archive pages
 * Path: archive.php
 */

if (! defined('ABSPATH')) {
	exit;
}

get_header();

// Get archive title and description
$archive_title = get_the_archive_title();
$archive_description = get_the_archive_description();
?>

<main id="primary" class="wschild-archive-page">
	<header class="wschild-archive-header">
		<div class="wschild-container">
			<h1 class="wschild-archive-header__title"><?php echo wp_kses_post($archive_title); ?></h1>
			<?php if ($archive_description) : ?>
				<div class="wschild-archive-header__desc"><?php echo wp_kses_post($archive_description); ?></div>
			<?php endif; ?>
		</div>
	</header>

	<section class="wschild-archive-section">
		<div class="wschild-container">
			<?php if (have_posts()) : ?>
				<div class="wschild-archive-grid">
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
get_footer();
