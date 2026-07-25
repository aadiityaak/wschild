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
	$subtitle_html = 'Websweet Studio menghadirkan desain yang memikat dan pengalaman pengguna yang lembut, dirancang khusus untuk memperkuat kredibilitas <span class="wschild-typing" data-wschild-typing data-words="' . $words_attr . '"></span> Anda.';
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