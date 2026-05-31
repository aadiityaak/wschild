<?php

/**
 * Hero Component
 * Path: src/component/home/hero.php
 */

$title = $args['title'] ?? 'Wujudkan Website Impian';
$subtitle = $args['subtitle'] ?? null;
$cta_label = $args['cta_label'] ?? 'Mulai Eksplorasi';
$cta_url = $args['cta_url'] ?? '#';

$image_url = $args['image_url'] ?? 'https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home.webp';
$image_srcset = $args['image_srcset'] ?? 'https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home-241x300.webp 241w, https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home-600x747.webp 600w, https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home-768x956.webp 768w, https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home.webp 823w';

$enable_typing = $args['enable_typing'] ?? (is_front_page() || is_page_template('page-templates/home.php'));
$typing_words = $args['typing_words'] ?? [
	'Bisnis',
	'Sekolah',
	'Perusahaan',
	'Profile',
	'Yayasan',
	'UMKM',
	'Toko Online',
	'Startup',
	'Klinik',
	'Restoran',
	'Instansi',
	'Komunitas',
	'Event',
	'Travel',
	'Hotel',
	'Aplikasi Web'
];

$subtitle_html = $subtitle ?? 'Websweet Studio menghadirkan desain yang memikat dan pengalaman pengguna yang lembut, dirancang khusus untuk memperkuat kredibilitas bisnis Anda di dunia digital.';

if ($subtitle === null && $enable_typing && ! empty($typing_words)) {
	$words_attr = esc_attr(implode('|', array_values($typing_words)));
	$subtitle_html = 'Websweet Studio menghadirkan desain yang memikat dan pengalaman pengguna yang lembut, dirancang khusus untuk memperkuat kredibilitas <span class="wschild-typing wschild-typing--dark" data-wschild-typing data-words="' . $words_attr . '"></span> Anda.';
}
?>

<section class="home-hero">
	<div class="wschild-container">
		<div class="home-hero__grid">
			<div class="home-hero__content">
				<h1 class="home-hero__title"><?php echo esc_html($title); ?></h1>
				<p class="home-hero__subtitle"><?php echo wp_kses_post($subtitle_html); ?></p>
				<div class="home-hero__actions">
					<a href="<?php echo esc_url($cta_url); ?>" class="wschild-button wschild-button--dark wschild-button--pill">
						<?php echo esc_html($cta_label); ?>
					</a>
				</div>
			</div>
			<div class="home-hero__image-wrapper" id="hero-image-container">
				<img
					id="hero-main-image"
					decoding="async"
					fetchpriority="high"
					loading="eager"
					width="800"
					height="995"
					src="<?php echo esc_url($image_url); ?>"
					class="home-hero__image"
					alt="<?php echo esc_attr($title); ?> - Websweetstudio"
					srcset="<?php echo esc_attr($image_srcset); ?>"
					sizes="(max-width: 480px) 241px, (max-width: 768px) 600px, (max-width: 1024px) 768px, 800px">
			</div>
		</div>
	</div>
</section>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		const typingEl = document.querySelector('[data-wschild-typing]');
		if (typingEl) {
			const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			const rawWords = typingEl.getAttribute('data-words') || '';
			const words = rawWords.split('|').map(w => w.trim()).filter(Boolean);

			if (words.length) {
				let wordIndex = 0;
				let charIndex = 0;
				let deleting = false;

				const typeSpeed = 65;
				const deleteSpeed = 35;
				const holdAfterType = 1100;
				const holdAfterDelete = 200;

				const render = () => {
					typingEl.textContent = words[wordIndex].slice(0, charIndex);
				};

				const tick = () => {
					if (prefersReducedMotion) {
						typingEl.textContent = words[0];
						return;
					}

					const current = words[wordIndex];
					if (!deleting) {
						charIndex = Math.min(current.length, charIndex + 1);
						render();
						if (charIndex === current.length) {
							deleting = true;
							window.setTimeout(tick, holdAfterType);
							return;
						}
						window.setTimeout(tick, typeSpeed);
						return;
					}

					charIndex = Math.max(0, charIndex - 1);
					render();
					if (charIndex === 0) {
						deleting = false;
						wordIndex = (wordIndex + 1) % words.length;
						window.setTimeout(tick, holdAfterDelete);
						return;
					}
					window.setTimeout(tick, deleteSpeed);
				};

				typingEl.textContent = words[0];
				charIndex = words[0].length;
				window.setTimeout(() => {
					deleting = true;
					tick();
				}, holdAfterType);
			}
		}

		const container = document.getElementById('hero-image-container');
		const image = document.getElementById('hero-main-image');
		const floatingItems = document.querySelectorAll('.floating-item');

		if (typeof gsap !== 'undefined') {
			// Initial floating animation
			floatingItems.forEach((item, index) => {
				gsap.to(item, {
					y: '+=20',
					x: '+=10',
					rotation: '+=15',
					duration: 2 + index,
					repeat: -1,
					yoyo: true,
					ease: 'sine.inOut'
				});
			});

			window.addEventListener('mousemove', (e) => {
				const {
					clientX,
					clientY
				} = e;
				const {
					innerWidth,
					innerHeight
				} = window;

				// Hero Image Tilt
				if (container && image) {
					const moveX = (clientX - innerWidth / 2) / (innerWidth / 2) * -15;
					const moveY = (clientY - innerHeight / 2) / (innerHeight / 2) * -15;
					const rotateX = (clientY - innerHeight / 2) / (innerHeight / 2) * 10;
					const rotateY = (clientX - innerWidth / 2) / (innerWidth / 2) * -10;

					gsap.to(image, {
						x: moveX,
						y: moveY,
						rotateX: rotateX,
						rotateY: rotateY,
						duration: 1.2,
						ease: 'power2.out',
						transformPerspective: 1200,
						transformOrigin: 'center center'
					});
				}

				// Floating Elements Mouse Follow (Parallax)
				floatingItems.forEach((item) => {
					const speed = item.getAttribute('data-speed') || 20;
					const x = (innerWidth - clientX * speed) / 100;
					const y = (innerHeight - clientY * speed) / 100;

					gsap.to(item, {
						x: x,
						y: y,
						duration: 1,
						ease: 'power1.out'
					});
				});
			});

			// Reset saat mouse meninggalkan window
			window.addEventListener('mouseleave', () => {
				if (image) {
					gsap.to(image, {
						x: 0,
						y: 0,
						rotateX: 0,
						rotateY: 0,
						duration: 1.5,
						ease: 'elastic.out(1, 0.5)'
					});
				}

				floatingItems.forEach((item) => {
					gsap.to(item, {
						x: 0,
						y: 0,
						duration: 1.5,
						ease: 'elastic.out(1, 0.5)'
					});
				});
			});
		}
	});
</script>