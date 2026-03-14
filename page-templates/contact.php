<?php
/*
Template Name: Contact Template
*/

if (! defined('ABSPATH')) {
	exit;
}

get_header();
?>

<main id="primary" class="wschild-contact-page">
	<?php
	// Hero section for Contact
	get_template_part(
		'src/component/home/hero',
		null,
		[
			'title'     => 'Contact Us',
			'subtitle'  => 'Punya pertanyaan atau ingin memulai proyek baru? Kami siap membantu Anda mewujudkan ide digital Anda menjadi kenyataan.',
			'cta_label' => 'Chat WhatsApp',
			'cta_url'   => 'https://wa.me/6285175227339',
		]
	);
	?>

	<?php
	// Contact info component
	get_template_part('src/component/contact/info');

	// Contact map component
	get_template_part('src/component/contact/map');
	?>
</main>

<?php
get_footer();
