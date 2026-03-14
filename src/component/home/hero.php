<?php

/**
 * Hero Component
 * Path: src/component/home/hero.php
 */

$title = $args['title'] ?? 'Jasa Pembuatan Website';
$subtitle = $args['subtitle'] ?? 'Dapatkan website yang dirancang profesional, mudah digunakan, dan dioptimalkan untuk meningkatkan kehadiran online bisnis Anda.';
$cta_label = $args['cta_label'] ?? 'Selengkapnya';
$cta_url = $args['cta_url'] ?? '#';
?>

<section class="home-hero">
	<div class="umroh-container">
		<div class="home-hero__grid">
			<div class="home-hero__content">
				<h1 class="home-hero__title"><?php echo esc_html($title); ?></h1>
				<p class="home-hero__subtitle"><?php echo esc_html($subtitle); ?></p>
				<div class="home-hero__actions">
					<a href="<?php echo esc_url($cta_url); ?>" class="umroh-button umroh-button--dark umroh-button--pill">
						<?php echo esc_html($cta_label); ?>
					</a>
				</div>
			</div>
			<div class="home-hero__image-wrapper" id="hero-image-container">
				<img
					id="hero-main-image"
					decoding="async"
					width="800"
					height="995"
					src="https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home.webp"
					class="home-hero__image"
					alt="Websweetstudio Home"
					srcset="https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home.webp 823w, https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home-600x747.webp 600w, https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home-241x300.webp 241w, https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home-768x956.webp 768w"
					sizes="(max-width: 800px) 100vw, 800px">
			</div>
		</div>
	</div>
</section>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const container = document.getElementById('hero-image-container');
		const image = document.getElementById('hero-main-image');

		if (container && image && typeof gsap !== 'undefined') {
			window.addEventListener('mousemove', (e) => {
				const {
					clientX,
					clientY
				} = e;
				const {
					innerWidth,
					innerHeight
				} = window;

				// Hitung pergerakan berlawanan (multiplier negatif)
				// Range -15px sampai 15px
				const moveX = (clientX - innerWidth / 2) / (innerWidth / 2) * -15;
				const moveY = (clientY - innerHeight / 2) / (innerHeight / 2) * -15;

				gsap.to(image, {
					x: moveX,
					y: moveY,
					duration: 1,
					ease: 'power2.out'
				});
			});
		}
	});
</script>