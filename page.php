<?php

if (! defined('ABSPATH')) {
	exit;
}

get_header();
?>

<main id="primary" class="wschild-page" data-barba="container" data-barba-namespace="page">
	<?php
	while (have_posts()) {
		the_post();
		the_content();
	}
	?>
</main>

<?php
get_footer();

