<?php

/**
 * Why Us Component
 * Path: src/component/home/why-us.php
 */

$why_us_items = [
	[
		'title' => 'Kredibilitas yang Memikat',
		'desc'  => 'Kami merancang website yang tidak hanya indah, tapi juga membangun kepercayaan mendalam bagi calon pelanggan Anda.',
		'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-backpack-icon lucide-backpack"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M8 10h8"/><path d="M8 18h8"/><path d="M8 22v-6a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v6"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/></svg>',
	],
	[
		'title' => 'Perluas Jangkauan Bisnis',
		'desc'  => 'Hadirkan bisnis Anda di ranah digital dengan strategi yang tepat untuk menjangkau pasar yang lebih luas dan potensial.',
		'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-expand-icon lucide-expand"><path d="m15 15 6 6"/><path d="m15 9 6-6"/><path d="M21 16v5h-5"/><path d="M21 8V3h-5"/><path d="M3 16v5h5"/><path d="m3 21 6-6"/><path d="M3 8V3h5"/><path d="M9 9 3 3"/></svg>',
	],
	[
		'title' => 'Desain Estetik & Fungsional',
		'desc'  => 'Setiap desain kami buat secara eksklusif, memadukan keindahan visual dengan kemudahan penggunaan bagi pengunjung.',
		'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-line-squiggle-icon lucide-line-squiggle"><path d="M7 3.5c5-2 7 2.5 3 4C1.5 10 2 15 5 16c5 2 9-10 14-7s.5 13.5-4 12c-5-2.5.5-11 6-2"/></svg>',
	],
	[
		'title' => 'User Experience yang Lembut',
		'desc'  => 'Kami memastikan navigasi website terasa intuitif dan mengalir, memberikan kenyamanan maksimal bagi setiap pengunjung.',
		'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet-cards-icon lucide-wallet-cards"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2"/><path d="M3 11h3c.8 0 1.6.3 2.1.9l1.1.9c1.6 1.6 4.1 1.6 5.7 0l1.1-.9c.5-.5 1.3-.9 2.1-.9H21"/></svg>',
	],
	[
		'title' => 'Optimasi Performa & SEO',
		'desc'  => 'Website yang cepat dan mudah ditemukan di mesin pencari untuk mendukung pertumbuhan organik bisnis Anda.',
		'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-crown-icon lucide-crown"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></svg>',
	],
	[
		'title' => 'Layanan Profesional & Responsif',
		'desc'  => 'Kami siap mendampingi perjalanan digital Anda dengan dukungan teknis yang profesional dan solusi yang tepat sasaran.',
		'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hard-drive-upload-icon lucide-hard-drive-upload"><path d="m16 6-4-4-4 4"/><path d="M12 2v8"/><rect width="20" height="8" x="2" y="14" rx="2"/><path d="M6 18h.01"/><path d="M10 18h.01"/></svg>',
	],
];
?>

<section class="home-why-us">
	<div class="wschild-container">
		<div class="home-why-us__header">
			<h2 class="home-why-us__title">Mengapa Memilih Websweet Studio?</h2>
			<p class="home-why-us__subtitle">Kami memadukan kreativitas desain dengan keunggulan teknis untuk menciptakan website yang estetik dan berperforma tinggi.</p>
		</div>

		<div class="wschild-grid wschild-grid--3 home-why-us__grid">
			<?php foreach ($why_us_items as $item) : ?>
				<div class="home-why-us__card">
					<div class="home-why-us__icon">
						<?php echo $item['icon']; ?>
					</div>
					<h3 class="home-why-us__card-title"><?php echo esc_html($item['title']); ?></h3>
					<p class="home-why-us__card-desc"><?php echo esc_html($item['desc']); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>