<?php

if (! defined('ABSPATH')) {
	exit;
}

get_header();

$query = get_search_query();
?>

<main id="primary" class="wschild-archive-page wschild-search-page" data-barba="container" data-barba-namespace="search">
	<header class="wschild-archive-header">
		<div class="wschild-container">
			<h1 class="wschild-archive-header__title"><?php echo esc_html('Hasil Pencarian: ' . $query); ?></h1>
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
					<p><?php _e('Tidak ada hasil yang cocok.', 'wschild'); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();

