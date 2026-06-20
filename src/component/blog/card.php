<?php

/**
 * Blog Card Component
 * Path: src/component/blog/card.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('wschild-blog-card'); ?>>
	<div class="wschild-blog-card__inner">
		<?php if (has_post_thumbnail()) : ?>
			<div class="wschild-blog-card__image-wrapper">
				<a href="<?php the_permalink(); ?>">
					<?php
					global $wp_query;
					$thumbnail_args = ['class' => 'wschild-blog-card__image'];
					// Apply LCP optimizations only for the first post in archives/blog home
					if ($wp_query->current_post === 0 && (is_home() || is_archive())) {
						$thumbnail_args['fetchpriority'] = 'high';
						$thumbnail_args['loading']       = 'eager';
					}
					the_post_thumbnail('medium_large', $thumbnail_args);
					?>
				</a>
			</div>
		<?php endif; ?>

		<div class="wschild-blog-card__avatar-wrap">
			<?php echo get_avatar(get_the_author_meta('ID'), 48, '', '', ['class' => 'wschild-blog-card__author-avatar']); ?>
		</div>

		<div class="wschild-blog-card__content">
			<div class="wschild-blog-card__meta">
				<span class="wschild-blog-card__author-name"><?php the_author(); ?></span>
				<?php
				$categories = get_the_category();
				if ($categories) : ?>
					<span class="wschild-blog-card__sep">|</span>
					<span class="wschild-blog-card__cat"><?php echo esc_html($categories[0]->name); ?></span>
				<?php endif; ?>
			</div>

			<h2 class="wschild-blog-card__title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

			<div class="wschild-blog-card__excerpt">
				<?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
			</div>

			<div class="wschild-blog-card__date-row">
				<svg class="wschild-blog-card__date-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
					<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
				</svg>
				<time class="wschild-blog-card__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
					<?php echo get_the_date(); ?>
				</time>
			</div>

			<div class="wschild-blog-card__footer">
				<a href="<?php the_permalink(); ?>" class="wschild-blog-card__readmore">
					Baca Selengkapnya
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
					</svg>
				</a>
			</div>
		</div>
	</div>
</article>