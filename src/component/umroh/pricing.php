<?php
// Default data
$pricing_plans = [
	[
		'category'   => 'haji-umroh',
		'name'         => 'Paket Instant',
		'price'        => 'Rp 750K',
		'old_price'    => 'dari Rp 990K',
		'features'     => [
			'Hosting 1GB',
			'Free Domain .com',
			'Free Support & Maintenance',
			'50+ Pilihan Desain',
		],
		'cta_label'    => 'Pilih Instant',
		'design_label' => 'Pilihan Desain',
		'featured'     => false,
	],
	[
		'category'   => 'haji-umroh',
		'name'         => 'Paket Custom',
		'price'        => 'Rp 1.200K',
		'old_price'    => 'dari Rp 1.450K',
		'features'     => [
			'Hosting 1GB',
			'Free Domain .com',
			'Free Support & Maintenance',
			'Custom Desain',
		],
		'cta_label'    => 'Pilih Custom',
		'design_label' => 'Pilihan Desain',
		'featured'     => true,
	],
];

$design_data = [
	'instant' => [
		'title'    => 'Pilihan Desain Paket Instant',
		'subtitle' => 'Pilih dari 50+ desain siap pakai. Nanti kami sesuaikan warna/logo travel Anda.',
		'items'    => [
			'Desain modern & clean',
			'Desain fokus konversi (CTA jelas)',
			'Layout paket & itinerary rapi',
			'Siap dioptimasi untuk kecepatan',
		],
	],
	'custom'   => [
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

// Check if args are passed (WP 5.5+)
if (isset($args['pricing_plans'])) {
	$pricing_plans = $args['pricing_plans'];
}
if (isset($args['design_data'])) {
	$design_data = $args['design_data'];
}
if (isset($args['primary_cta_url'])) {
	$primary_cta_url = $args['primary_cta_url'];
}

// Fallback if primary_cta_url is not set
if (! isset($primary_cta_url)) {
	$primary_cta_url = '#';
}
?>

<div x-data='wschildPricing(<?php echo wp_json_encode($design_data); ?>)'>
	<div class="umroh-grid umroh-grid--2 umroh-pricing">
		<?php foreach ($pricing_plans as $plan) : ?>
			<?php wschild_render_pricing_card($plan, $primary_cta_url); ?>
		<?php endforeach; ?>
	</div>

	<div class="umroh-modal" x-cloak x-show="isOpen" x-transition.opacity @keydown.escape.window="closeDesign()" role="dialog" aria-modal="true">
		<div class="umroh-modal__backdrop" @click="closeDesign()"></div>
		<div class="umroh-modal__panel" @click.stop>
			<div class="umroh-modal__header">
				<div>
					<h3 class="umroh-modal__title" x-text="active.title"></h3>
					<p class="umroh-modal__subtitle" x-text="active.subtitle"></p>
				</div>
				<button type="button" class="umroh-modal__close" @click="closeDesign()">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</button>
			</div>
			<div class="umroh-modal__body">
				<ul class="umroh-check-list">
					<template x-for="item in active.items" :key="item">
						<li>
							<svg class="umroh-check-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
								<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
							</svg>
							<span x-text="item"></span>
						</li>
					</template>
				</ul>
				<div class="umroh-modal__cta">
					<a class="umroh-button umroh-button--primary umroh-button--block" href="<?php echo esc_url($primary_cta_url); ?>">Konsultasi Desain Ini</a>
				</div>
			</div>
		</div>
	</div>
</div>