<?php
/*
Template Name: Services Template
*/

if (! defined('ABSPATH')) {
	exit;
}

get_header();
?>

<main id="primary" class="wschild-services">
	<?php
	// Hero section for Services
	get_template_part(
		'src/component/home/hero',
		null,
		[
			'title'        => 'Layanan Kami',
			'subtitle'     => 'Kami menghadirkan solusi digital komprehensif mulai dari pembuatan website profesional, optimasi SEO, hingga pengelolaan sistem yang dirancang untuk mempercepat pertumbuhan bisnis Anda.',
			'cta_label'    => 'Konsultasi Sekarang',
			'cta_url'      => '/kontak',
			'image_url'    => 'https://websweetstudio.com/wp-content/uploads/2024/07/layanan.webp',
			'image_srcset' => 'https://websweetstudio.com/wp-content/uploads/2024/07/layanan.webp 823w, https://websweetstudio.com/wp-content/uploads/2024/07/layanan-241x300.webp 241w, https://websweetstudio.com/wp-content/uploads/2024/07/layanan-768x956.webp 768w, https://websweetstudio.com/wp-content/uploads/2024/07/layanan-600x747.webp 600w',
		]
	);

	// Services list section
	get_template_part('src/component/services/list');
	?>
</main>

<?php
get_footer();
