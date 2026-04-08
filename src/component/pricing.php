<?php

/**
 * Pricing Component Main
 * Includes Header and 3 Pricing Cards
 */

// Default data
$pricing_plans = [
	[
		'category'   => 'umkm',
		'name'         => 'Paket UMKM',
		'price'        => 'Rp 600K',
		'old_price'    => 'Rp 650K',
		'features'     => [
			'Hosting 0.5GB',
			'Free Domain .com',
			'Free Support & Maintenance',
			'10+ Pilihan Desain',
		],
		'cta_label'    => 'Pilih UMKM',
		'design_label' => 'Pilihan Desain',
		'featured'     => false,
		'theme'        => 'purple',
	],
	[
		'category'   => '',
		'name'         => 'Paket Instant',
		'price'        => 'Rp 750K',
		'old_price'    => 'Rp 990K',
		'features'     => [
			'Hosting 1GB',
			'Free Domain .com',
			'Free Support & Maintenance',
			'50+ Pilihan Desain',
		],
		'cta_label'    => 'Pilih Instant',
		'design_label' => 'Pilihan Desain',
		'featured'     => true,
		'theme'        => 'orange',
	],
	[
		'category'   => '',
		'name'         => 'Paket Custom',
		'price'        => 'Rp 1450K',
		'features'     => [
			'Hosting 1GB',
			'Free Domain .com',
			'Free Support & Maintenance',
			'Custom Desain',
		],
		'cta_label'    => 'Pilih Custom',
		'design_label' => 'Pilihan Desain',
		'featured'     => false,
		'theme'        => 'pink',
	],
];

$design_data = [
	'umkm' => [
		'title'    => 'Pilihan Desain Paket UMKM',
		'subtitle' => 'Pilih dari 10+ desain ekonomis namun tetap profesional untuk travel umroh Anda.',
		'items'    => [
			'Desain ringan & responsif',
			'Struktur konten standar',
			'Integrasi WhatsApp',
			'SEO Friendly Basic',
		],
	],
	'instant' => [
		'title'    => 'Pilihan Desain Paket Instant',
		'subtitle' => 'Pilih dari 50+ desain premium siap pakai dengan fitur lebih lengkap.',
		'items'    => [
			'Desain modern & clean',
			'Desain fokus konversi (CTA jelas)',
			'Layout paket & itinerary rapi',
			'Siap dioptimasi untuk kecepatan',
		],
	],
	'custom' => [
		'title'    => 'Pilihan Desain Paket Custom',
		'subtitle' => 'Desain dibuat sesuai branding, target market, dan kebutuhan konten Anda.',
		'items'    => [
			'Brief kebutuhan & referensi',
			'Mockup desain eksklusif',
			'Revisi sampai cocok',
			'Implementasi ke WordPress',
		],
	],
];

// Check if primary_cta_url is passed
$primary_cta_url = $args['primary_cta_url'] ?? '#';

?>

<div class="wschild-pricing-main">
	<div class="wschild-pricing-header">
		<h2 class="wschild-pricing-main__title">Pricing</h2>
		<p class="wschild-pricing-main__subtitle">Pilih Paket yang Sesuai dengan Kebutuhan Bisnis Anda</p>
	</div>

	<div x-data='wschildPricing(<?php echo wp_json_encode($design_data); ?>)'>
		<div class="wschild-grid wschild-grid--3 wschild-pricing">
			<?php foreach ($pricing_plans as $plan) : ?>
				<?php wschild_render_pricing_card($plan, $primary_cta_url); ?>
			<?php endforeach; ?>
		</div>

		<!-- Modal Container -->
		<div class="wschild-modal" x-cloak x-show="isOpen" x-transition.opacity @keydown.escape.window="closeDesign()" role="dialog" aria-modal="true">
			<div class="wschild-modal__backdrop" @click="closeDesign()"></div>
			<div class="wschild-modal__panel" @click.stop>
				<div class="wschild-modal__header">
					<div>
						<h3 class="wschild-modal__title" x-text="active().title"></h3>
						<p class="wschild-modal__subtitle" x-text="active().subtitle"></p>
					</div>
					<button type="button" class="wschild-modal__close" @click="closeDesign()">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<line x1="18" y1="6" x2="6" y2="18"></line>
							<line x1="6" y1="6" x2="18" y2="18"></line>
						</svg>
					</button>
				</div>
				<div class="wschild-modal__body">
					<ul class="wschild-check-list">
						<template x-for="item in active().items" :key="item">
							<li>
								<svg class="wschild-check-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
									<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
								</svg>
								<span x-text="item"></span>
							</li>
						</template>
					</ul>
					<div class="wschild-modal__cta">
						<a class="wschild-button wschild-button--primary wschild-button--block" href="<?php echo esc_url($primary_cta_url); ?>">Konsultasi Desain Ini</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
		gsap.registerPlugin(ScrollTrigger);

		// Header animation
		gsap.from('.wschild-pricing-header > *', {
			scrollTrigger: {
				trigger: '.wschild-pricing-header',
				start: 'top 85%',
				toggleActions: 'play none none reverse'
			},
			y: 30,
			opacity: 0,
			duration: 0.8,
			stagger: 0.2,
			ease: 'power3.out'
		});

		// Pricing Cards animation
		var pricingCards = document.querySelectorAll('.wschild-pricing-card');
		pricingCards.forEach(function(card, i) {
			var startPct = Math.floor(75 + Math.random() * 15); // 75% - 90%
			var randDelay = Math.random() * 0.15;
			gsap.from(card, {
				scrollTrigger: {
					trigger: card,
					start: 'top ' + startPct + '%',
					toggleActions: 'play none none reverse'
				},
				y: 40,
				opacity: 0,
				duration: 0.9,
				ease: 'power3.out',
				delay: randDelay
			});
		});
	});
</script>