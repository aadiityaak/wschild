<?php
/*
Template Name: Landing Page - Jasa Website Umroh
*/

if (! defined('ABSPATH')) {
	exit;
}

get_header();

$primary_cta_url   = '#';
$secondary_cta_url = '#';

// Pricing component is loaded from src/component/umroh/pricing.php
// Function wschild_render_pricing_card() is now in functions.php
?>

<main id="primary" class="wschild-landing">
	<section class="wschild-hero">
		<div class="wschild-container">
			<p class="wschild-badge">Landing Page</p>
			<h1 class="wschild-title">Jasa Website Umroh Profesional</h1>
			<p class="wschild-subtitle">
				Bantu travel umroh Anda tampil lebih terpercaya, mudah ditemukan di Google, dan siap menerima
				lead calon jamaah.
			</p>
			<div class="wschild-cta">
				<a class="wschild-button wschild-button--primary" href="<?php echo esc_url($primary_cta_url); ?>">Konsultasi Gratis</a>
				<a class="wschild-button wschild-button--ghost" href="<?php echo esc_url($secondary_cta_url); ?>">Lihat Paket</a>
			</div>
			<div class="wschild-highlights">
				<div class="wschild-highlight">
					<div class="wschild-highlight__title">Cepat Online</div>
					<div class="wschild-highlight__desc">Website siap tayang 3–7 hari kerja</div>
				</div>
				<div class="wschild-highlight">
					<div class="wschild-highlight__title">Mobile-First</div>
					<div class="wschild-highlight__desc">Ringan, rapi, dan nyaman di HP</div>
				</div>
				<div class="wschild-highlight">
					<div class="wschild-highlight__title">SEO Dasar</div>
					<div class="wschild-highlight__desc">Struktur halaman siap bersaing</div>
				</div>
			</div>
		</div>
	</section>

	<section class="wschild-section">
		<div class="wschild-container">
			<h2 class="wschild-section__title">Solusi Website untuk Travel Umroh</h2>
			<p class="wschild-section__subtitle">
				Didesain khusus untuk kebutuhan promosi paket, edukasi jamaah, dan konversi konsultasi.
			</p>
			<div class="wschild-grid wschild-grid--3">
				<div class="wschild-card">
					<h3 class="wschild-card__title">Landing Page Paket</h3>
					<p class="wschild-card__desc">Tampilan paket umroh yang jelas, meyakinkan, dan fokus konversi.</p>
				</div>
				<div class="wschild-card">
					<h3 class="wschild-card__title">Form & WhatsApp</h3>
					<p class="wschild-card__desc">Call-to-action siap pakai untuk follow up lebih cepat.</p>
				</div>
				<div class="wschild-card">
					<h3 class="wschild-card__title">Konten Edukasi</h3>
					<p class="wschild-card__desc">Halaman FAQ, syarat, itinerary, hingga tips persiapan umroh.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="wschild-section wschild-section--alt">
		<div class="wschild-container">
			<h2 class="wschild-section__title">Kenapa Pilih Kami</h2>
			<div class="wschild-grid wschild-grid--2">
				<div class="wschild-list">
					<div class="wschild-list__item">
						<div class="wschild-list__title">Desain rapi & profesional</div>
						<div class="wschild-list__desc">Cocok untuk membangun trust travel umroh.</div>
					</div>
					<div class="wschild-list__item">
						<div class="wschild-list__title">Struktur siap SEO</div>
						<div class="wschild-list__desc">Heading, copy, dan layout dipikirkan untuk pencarian.</div>
					</div>
					<div class="wschild-list__item">
						<div class="wschild-list__title">Mudah dikelola</div>
						<div class="wschild-list__desc">Update paket dan konten tanpa ribet.</div>
					</div>
				</div>
				<div class="wschild-proof">
					<div class="wschild-proof__box">
						<div class="wschild-proof__kpi">+30%</div>
						<div class="wschild-proof__label">Peningkatan inquiry (estimasi)</div>
					</div>
					<div class="wschild-proof__box">
						<div class="wschild-proof__kpi">&lt;2s</div>
						<div class="wschild-proof__label">Target loading time (best practice)</div>
					</div>
					<div class="wschild-proof__box">
						<div class="wschild-proof__kpi">100%</div>
						<div class="wschild-proof__label">Mobile friendly</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="wschild-section">
		<div class="wschild-container">
			<h2 class="wschild-section__title">Paket Pembuatan Website</h2>
			<?php
			// Include pricing component
			get_template_part(
				'src/component/umroh/pricing',
				null,
				[
					'primary_cta_url' => $primary_cta_url,
				]
			);
			?>
			<p class="wschild-note">Harga bisa menyesuaikan kebutuhan fitur dan jumlah halaman.</p>
		</div>
	</section>

	<section class="wschild-section wschild-section--alt">
		<div class="wschild-container">
			<h2 class="wschild-section__title">FAQ</h2>
			<div class="wschild-faq">
				<details class="wschild-faq__item">
					<summary class="wschild-faq__q">Apakah bisa pakai Elementor?</summary>
					<div class="wschild-faq__a">Bisa. Template ini tetap kompatibel, dan Anda bisa menambahkan konten tambahan lewat editor.</div>
				</details>
				<details class="wschild-faq__item">
					<summary class="wschild-faq__q">Domain & hosting termasuk?</summary>
					<div class="wschild-faq__a">Bisa include atau menggunakan yang sudah Anda miliki.</div>
				</details>
				<details class="wschild-faq__item">
					<summary class="wschild-faq__q">Berapa lama pengerjaan?</summary>
					<div class="wschild-faq__a">Umumnya 3–7 hari kerja tergantung kelengkapan materi dan revisi.</div>
				</details>
			</div>
		</div>
	</section>

	<section class="wschild-section wschild-section--cta">
		<div class="wschild-container">
			<div class="wschild-final">
				<div>
					<h2 class="wschild-final__title">Siap tingkatkan penjualan paket umroh?</h2>
					<p class="wschild-final__subtitle">Kirim kebutuhan Anda, kami bantu rekomendasikan struktur landing page yang tepat.</p>
				</div>
				<div class="wschild-final__actions">
					<a class="wschild-button wschild-button--primary wschild-button--block" href="<?php echo esc_url($primary_cta_url); ?>">Konsultasi Sekarang</a>
				</div>
			</div>
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
