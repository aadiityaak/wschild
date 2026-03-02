<?php
/*
Template Name: Landing Page - Jasa Website Umroh
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$primary_cta_url   = '#';
$secondary_cta_url = '#';
?>

<main id="primary" class="umroh-landing">
	<section class="umroh-hero">
		<div class="umroh-container">
			<p class="umroh-badge">Landing Page</p>
			<h1 class="umroh-title">Jasa Website Umroh Profesional</h1>
			<p class="umroh-subtitle">
				Bantu travel umroh Anda tampil lebih terpercaya, mudah ditemukan di Google, dan siap menerima
				lead calon jamaah.
			</p>
			<div class="umroh-cta">
				<a class="umroh-button umroh-button--primary" href="<?php echo esc_url( $primary_cta_url ); ?>">Konsultasi Gratis</a>
				<a class="umroh-button umroh-button--ghost" href="<?php echo esc_url( $secondary_cta_url ); ?>">Lihat Paket</a>
			</div>
			<div class="umroh-highlights">
				<div class="umroh-highlight">
					<div class="umroh-highlight__title">Cepat Online</div>
					<div class="umroh-highlight__desc">Website siap tayang 3–7 hari kerja</div>
				</div>
				<div class="umroh-highlight">
					<div class="umroh-highlight__title">Mobile-First</div>
					<div class="umroh-highlight__desc">Ringan, rapi, dan nyaman di HP</div>
				</div>
				<div class="umroh-highlight">
					<div class="umroh-highlight__title">SEO Dasar</div>
					<div class="umroh-highlight__desc">Struktur halaman siap bersaing</div>
				</div>
			</div>
		</div>
	</section>

	<section class="umroh-section">
		<div class="umroh-container">
			<h2 class="umroh-section__title">Solusi Website untuk Travel Umroh</h2>
			<p class="umroh-section__subtitle">
				Didesain khusus untuk kebutuhan promosi paket, edukasi jamaah, dan konversi konsultasi.
			</p>
			<div class="umroh-grid umroh-grid--3">
				<div class="umroh-card">
					<h3 class="umroh-card__title">Landing Page Paket</h3>
					<p class="umroh-card__desc">Tampilan paket umroh yang jelas, meyakinkan, dan fokus konversi.</p>
				</div>
				<div class="umroh-card">
					<h3 class="umroh-card__title">Form & WhatsApp</h3>
					<p class="umroh-card__desc">Call-to-action siap pakai untuk follow up lebih cepat.</p>
				</div>
				<div class="umroh-card">
					<h3 class="umroh-card__title">Konten Edukasi</h3>
					<p class="umroh-card__desc">Halaman FAQ, syarat, itinerary, hingga tips persiapan umroh.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="umroh-section umroh-section--alt">
		<div class="umroh-container">
			<h2 class="umroh-section__title">Kenapa Pilih Kami</h2>
			<div class="umroh-grid umroh-grid--2">
				<div class="umroh-list">
					<div class="umroh-list__item">
						<div class="umroh-list__title">Desain rapi & profesional</div>
						<div class="umroh-list__desc">Cocok untuk membangun trust travel umroh.</div>
					</div>
					<div class="umroh-list__item">
						<div class="umroh-list__title">Struktur siap SEO</div>
						<div class="umroh-list__desc">Heading, copy, dan layout dipikirkan untuk pencarian.</div>
					</div>
					<div class="umroh-list__item">
						<div class="umroh-list__title">Mudah dikelola</div>
						<div class="umroh-list__desc">Update paket dan konten tanpa ribet.</div>
					</div>
				</div>
				<div class="umroh-proof">
					<div class="umroh-proof__box">
						<div class="umroh-proof__kpi">+30%</div>
						<div class="umroh-proof__label">Peningkatan inquiry (estimasi)</div>
					</div>
					<div class="umroh-proof__box">
						<div class="umroh-proof__kpi">&lt;2s</div>
						<div class="umroh-proof__label">Target loading time (best practice)</div>
					</div>
					<div class="umroh-proof__box">
						<div class="umroh-proof__kpi">100%</div>
						<div class="umroh-proof__label">Mobile friendly</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="umroh-section">
		<div class="umroh-container">
			<h2 class="umroh-section__title">Paket Pembuatan Website</h2>
			<div class="umroh-grid umroh-grid--3">
				<div class="umroh-price">
					<div class="umroh-price__name">Starter</div>
					<div class="umroh-price__price">Mulai 1,9jt</div>
					<ul class="umroh-price__list">
						<li>1 landing page</li>
						<li>CTA WhatsApp</li>
						<li>SEO dasar</li>
					</ul>
					<a class="umroh-button umroh-button--primary umroh-button--block" href="<?php echo esc_url( $primary_cta_url ); ?>">Pilih Starter</a>
				</div>
				<div class="umroh-price umroh-price--featured">
					<div class="umroh-price__name">Business</div>
					<div class="umroh-price__price">Mulai 3,9jt</div>
					<ul class="umroh-price__list">
						<li>Landing + profil travel</li>
						<li>Halaman paket & detail</li>
						<li>Form lead + WhatsApp</li>
					</ul>
					<a class="umroh-button umroh-button--primary umroh-button--block" href="<?php echo esc_url( $primary_cta_url ); ?>">Pilih Business</a>
				</div>
				<div class="umroh-price">
					<div class="umroh-price__name">Premium</div>
					<div class="umroh-price__price">Mulai 6,9jt</div>
					<ul class="umroh-price__list">
						<li>Desain custom</li>
						<li>Optimasi kecepatan</li>
						<li>Setup analytics</li>
					</ul>
					<a class="umroh-button umroh-button--primary umroh-button--block" href="<?php echo esc_url( $primary_cta_url ); ?>">Pilih Premium</a>
				</div>
			</div>
			<p class="umroh-note">Harga bisa menyesuaikan kebutuhan fitur dan jumlah halaman.</p>
		</div>
	</section>

	<section class="umroh-section umroh-section--alt">
		<div class="umroh-container">
			<h2 class="umroh-section__title">FAQ</h2>
			<div class="umroh-faq">
				<details class="umroh-faq__item">
					<summary class="umroh-faq__q">Apakah bisa pakai Elementor?</summary>
					<div class="umroh-faq__a">Bisa. Template ini tetap kompatibel, dan Anda bisa menambahkan konten tambahan lewat editor.</div>
				</details>
				<details class="umroh-faq__item">
					<summary class="umroh-faq__q">Domain & hosting termasuk?</summary>
					<div class="umroh-faq__a">Bisa include atau menggunakan yang sudah Anda miliki.</div>
				</details>
				<details class="umroh-faq__item">
					<summary class="umroh-faq__q">Berapa lama pengerjaan?</summary>
					<div class="umroh-faq__a">Umumnya 3–7 hari kerja tergantung kelengkapan materi dan revisi.</div>
				</details>
			</div>
		</div>
	</section>

	<section class="umroh-section umroh-section--cta">
		<div class="umroh-container">
			<div class="umroh-final">
				<div>
					<h2 class="umroh-final__title">Siap tingkatkan penjualan paket umroh?</h2>
					<p class="umroh-final__subtitle">Kirim kebutuhan Anda, kami bantu rekomendasikan struktur landing page yang tepat.</p>
				</div>
				<div class="umroh-final__actions">
					<a class="umroh-button umroh-button--primary umroh-button--block" href="<?php echo esc_url( $primary_cta_url ); ?>">Konsultasi Sekarang</a>
				</div>
			</div>
		</div>
	</section>

	<?php
	while ( have_posts() ) {
		the_post();
		the_content();
	}
	?>
</main>

<?php
get_footer();

