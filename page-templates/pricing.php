<?php
/*
Template Name: Pricing Template
*/

if (! defined('ABSPATH')) {
	exit;
}

get_header();
?>

<main id="primary" class="wschild-pricing-page">
	<?php
	// Hero section for Pricing
	get_template_part(
		'src/component/home/hero',
		null,
		[
			'title'     => 'Pricing',
			'subtitle'  => 'Websweet Studio mengerti bahwa setiap bisnis memiliki kebutuhan dan preferensi yang berbeda. Oleh karena itu, mereka menyediakan pilihan desain yang beragam agar Anda dapat memilih yang sesuai dengan kepribadian, visi, dan tujuan bisnis Anda.',
			'cta_label' => 'Lihat Paket',
			'cta_url'   => '#pricing-section',
		]
	);
	?>

	<section id="pricing-section" class="wschild-section" style="padding: 80px 0;">
		<div class="wschild-container">
			<?php
			// Include the pricing component
			get_template_part(
				'src/component/pricing',
				null,
				[
					'primary_cta_url' => '/order',
				]
			);
			?>
		</div>
	</section>
</main>

<?php
get_footer();
