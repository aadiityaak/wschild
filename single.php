<?php
/**
 * The template for displaying all single posts
 * Path: single.php
 */

if (! defined('ABSPATH')) {
	exit;
}

get_header();
?>

<main id="primary" class="wschild-single-post">
	<?php
	while (have_posts()) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('wschild-article'); ?>>
			<header class="wschild-article__header">
				<div class="wschild-container">
					<div class="wschild-article__meta">
						<span class="wschild-article__date"><?php echo get_the_date(); ?></span>
						<?php
						$categories = get_the_category();
						if ($categories) : ?>
							<span class="wschild-article__sep">|</span>
							<span class="wschild-article__cat"><?php echo esc_html($categories[0]->name); ?></span>
						<?php endif; ?>
					</div>
					<h1 class="wschild-article__title"><?php the_title(); ?></h1>
				</div>
			</header>

			<?php if (has_post_thumbnail()) : ?>
				<div class="wschild-article__featured-image">
					<div class="wschild-container">
						<div class="wschild-article__image-wrapper">
							<?php the_post_thumbnail('full', [
								'loading'       => 'eager',
								'fetchpriority' => 'high',
								'decoding'      => 'async',
							]); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

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

					<footer class="wschild-article__footer">
						<?php
						$tags = get_the_tags();
						if ($tags) : ?>
							<div class="wschild-article__tags">
								<span class="wschild-article__tags-label"><?php esc_html_e('Tags:', 'wschild'); ?></span>
								<?php foreach ($tags as $tag) : ?>
									<a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="wschild-tag"><?php echo esc_html($tag->name); ?></a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</footer>

					<nav class="wschild-post-navigation">
						<div class="wschild-post-nav wschild-post-nav--prev">
							<?php previous_post_link('%link', '<span class="wschild-post-nav__label">&laquo; Sebelumnya</span> <span class="wschild-post-nav__title">%title</span>'); ?>
						</div>
						<div class="wschild-post-nav wschild-post-nav--next">
							<?php next_post_link('%link', '<span class="wschild-post-nav__label">Berikutnya &raquo;</span> <span class="wschild-post-nav__title">%title</span>'); ?>
						</div>
					</nav>
				</div>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php
get_footer();
