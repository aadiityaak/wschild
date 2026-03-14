<?php
/*
Template Name: Home Template
*/

if (! defined('ABSPATH')) {
	exit;
}

get_header();

$primary_cta_url = '#';
?>

<main id="primary" class="umroh-landing">
	<?php
	// Include the new Hero component
	get_template_part('src/component/home/hero');

	// Include the Tech carousel component
	get_template_part('src/component/home/tech');

	// Include the Why Us component
	get_template_part('src/component/home/why-us');
	?>

	<section class="umroh-section">
		<div class="wschild-container">
			<?php
			// Include the new pricing component for testing
			get_template_part(
				'src/component/pricing',
				null,
				[
					'primary_cta_url' => $primary_cta_url,
				]
			);
			?>
		</div>
	</section>

	<?php
	// Include the QNA component
	get_template_part('src/component/home/qna');
	?>
</main>

<?php
get_footer();
