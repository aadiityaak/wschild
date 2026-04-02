<?php

/**
 * Tech Component (Carousel) - AlpineJS Version
 * Path: src/component/home/tech.php
 */

$tech_images = [
	['url' => 'https://websweetstudio.com/wp-content/uploads/2022/03/1-300x96.webp', 'name' => 'WordPress'],
	['url' => 'https://websweetstudio.com/wp-content/uploads/2022/03/2-300x96.webp', 'name' => 'Elementor'],
	['url' => 'https://websweetstudio.com/wp-content/uploads/2022/03/3-300x96.webp', 'name' => 'WooCommerce'],
	['url' => 'https://websweetstudio.com/wp-content/uploads/2022/03/4-300x96.webp', 'name' => 'PHP'],
	['url' => 'https://websweetstudio.com/wp-content/uploads/2022/03/5-300x96.webp', 'name' => 'MySQL'],
	['url' => 'https://websweetstudio.com/wp-content/uploads/2022/03/6-300x96.webp', 'name' => 'JavaScript'],
];
?>

<section class="home-tech">
	<div class="wschild-container home-tech__container"
		x-data="{
			skip: 1,
			autoplay: null,
			next() {
				const container = this.$refs.carousel;
				const itemWidth = container.firstElementChild.firstElementChild.offsetWidth;
				const maxScroll = container.scrollWidth - container.offsetWidth;
				
				if (container.scrollLeft >= (maxScroll - 10)) {
					container.scrollTo({ left: 0, behavior: 'smooth' });
				} else {
					container.scrollBy({ left: itemWidth, behavior: 'smooth' });
				}
			},
			prev() {
				const container = this.$refs.carousel;
				const itemWidth = container.firstElementChild.firstElementChild.offsetWidth;
				
				if (container.scrollLeft <= 10) {
					container.scrollTo({ left: container.scrollWidth, behavior: 'smooth' });
				} else {
					container.scrollBy({ left: -itemWidth, behavior: 'smooth' });
				}
			},
			startAutoplay() {
				this.autoplay = setInterval(() => { this.next() }, 4000);
			},
			stopAutoplay() {
				clearInterval(this.autoplay);
			}
		}"
		x-init="startAutoplay()"
		@mouseenter="stopAutoplay()"
		@mouseleave="startAutoplay()">
		<h2 class="screen-reader-text">Teknologi Pengembangan Website yang Kami Gunakan</h2>

		<div class="home-tech__carousel-alpine" x-ref="carousel">
			<div class="home-tech__wrapper-alpine">
				<?php foreach ($tech_images as $item) : ?>
					<div class="home-tech__slide-alpine">
						<figure class="home-tech__item">
							<img src="<?php echo esc_url($item['url']); ?>" alt="Teknologi <?php echo esc_attr($item['name']); ?> untuk Pembuatan Website" loading="lazy" decoding="async">
						</figure>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<!-- Navigation Arrows -->
		<button type="button" class="home-tech__nav-btn home-tech__prev-btn" @click="prev()" aria-label="Previous Slide">
			<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
				<polyline points="15 18 9 12 15 6"></polyline>
			</svg>
		</button>
		<button type="button" class="home-tech__nav-btn home-tech__next-btn" @click="next()" aria-label="Next Slide">
			<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
				<polyline points="9 18 15 12 9 6"></polyline>
			</svg>
		</button>
	</div>
</section>
