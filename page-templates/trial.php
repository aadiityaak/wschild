<?php
/*
Template Name: Trial Component Test
*/

if (! defined('ABSPATH')) {
	exit;
}

get_header();

$primary_cta_url = '#';
?>

<main id="primary" class="umroh-landing">
	<section class="umroh-section">
		<div class="umroh-container">
			<?php
			// Include the new pricing-main component for testing
			get_template_part(
				'src/component/umroh/pricing-main',
				null,
				[
					'primary_cta_url' => $primary_cta_url,
				]
			);
			?>
		</div>
	</section>

	<?php
	while (have_posts()) {
		the_post();
		the_content();
	}
	?>
</main>

<?php
get_footer();
