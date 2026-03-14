<?php

/**
 * Tech Component (Carousel)
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
	<div class="wschild-container home-tech__container">
		<h2 class="screen-reader-text">Teknologi Pengembangan Website yang Kami Gunakan</h2>
		<div class="swiper home-tech__carousel">
			<div class="swiper-wrapper">
				<?php foreach ($tech_images as $item) : ?>
					<div class="swiper-slide">
						<figure class="home-tech__item">
							<img src="<?php echo esc_url($item['url']); ?>" alt="Teknologi <?php echo esc_attr($item['name']); ?> untuk Pembuatan Website" loading="lazy" decoding="async">
						</figure>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<!-- Navigation Arrows -->
		<div class="swiper-button-prev home-tech__prev"></div>
		<div class="swiper-button-next home-tech__next"></div>
	</div>
</section>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		if (typeof Swiper !== 'undefined') {
			new Swiper('.home-tech__carousel', {
				slidesPerView: 1, // Mobile 1
				spaceBetween: 30,
				loop: true,
				speed: 1500, // Memperlambat transisi slide (1.5 detik)
				autoplay: {
					delay: 4000, // Menambah jeda antar slide (4 detik)
					disableOnInteraction: false,
				},
				navigation: {
					nextEl: '.home-tech__next',
					prevEl: '.home-tech__prev',
				},
				breakpoints: {
					768: { // Tablet 3
						slidesPerView: 3,
					},
					1024: { // Desktop 4
						slidesPerView: 4,
					},
				},
			});
		}
	});
</script>