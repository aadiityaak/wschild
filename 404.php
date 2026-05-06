<?php

if (! defined('ABSPATH')) {
	exit;
}

get_header();
?>

<main id="primary" class="wschild-page wschild-404" data-barba="container" data-barba-namespace="404">
	<div class="wschild-container">
		<h1>Halaman tidak ditemukan</h1>
		<p>Maaf, halaman yang Anda cari tidak tersedia.</p>
		<p><a class="wschild-button wschild-button--dark wschild-button--pill" href="<?php echo esc_url(home_url('/')); ?>">Kembali ke Beranda</a></p>
	</div>
</main>

<?php
get_footer();

