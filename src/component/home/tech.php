<?php

/**
 * Tech Component (Carousel)
 * Path: src/component/home/tech.php
 */

$tech_images = [
	'https://websweetstudio.com/wp-content/uploads/2022/03/1-300x96.webp',
	'https://websweetstudio.com/wp-content/uploads/2022/03/2-300x96.webp',
	'https://websweetstudio.com/wp-content/uploads/2022/03/3-300x96.webp',
	'https://websweetstudio.com/wp-content/uploads/2022/03/4-300x96.webp',
	'https://websweetstudio.com/wp-content/uploads/2022/03/5-300x96.webp',
	'https://websweetstudio.com/wp-content/uploads/2022/03/6-300x96.webp',
];
?>

<section class="home-tech">
	<div class="umroh-container home-tech__container">
		<div class="swiper home-tech__carousel">
			<div class="swiper-wrapper">
				<?php foreach ($tech_images as $index => $img_url) : ?>
					<div class="swiper-slide">
						<figure class="home-tech__item">
							<img src="<?php echo esc_url($img_url); ?>" alt="Tech Logo <?php echo $index + 1; ?>" loading="lazy">
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