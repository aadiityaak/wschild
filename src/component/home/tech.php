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
		const techCarousel = document.querySelector('.home-tech__carousel');

		if (techCarousel && typeof Swiper !== 'undefined') {
			const initSwiper = () => {
				new Swiper('.home-tech__carousel', {
					slidesPerView: 2, // Mobile 2 for better balance
					spaceBetween: 20,
					loop: true,
					speed: 1000,
					autoplay: {
						delay: 3000,
						disableOnInteraction: false,
						pauseOnMouseEnter: true, // Reduce reflows when user interacts
					},
					navigation: {
						nextEl: '.home-tech__next',
						prevEl: '.home-tech__prev',
					},
					breakpoints: {
						768: {
							slidesPerView: 4,
							spaceBetween: 30,
						},
						1024: {
							slidesPerView: 6,
							spaceBetween: 40,
						},
					},
				});
			};

			// Lazy Load Swiper using Intersection Observer to mitigate forced reflow on load
			if ('IntersectionObserver' in window) {
				const observer = new IntersectionObserver((entries) => {
					entries.forEach(entry => {
						if (entry.isIntersecting) {
							initSwiper();
							observer.unobserve(entry.target);
						}
					});
				}, {
					rootMargin: '100px'
				}); // Load 100px before it enters viewport
				observer.observe(techCarousel);
			} else {
				// Fallback for older browsers
				initSwiper();
			}
		}
	});
</script>