<?php

/**
 * QNA Component (Accordion)
 * Path: src/component/home/qna.php
 */

$qna_items = [
	[
		'q' => 'Mengapa harus punya website?',
		'a' => 'Website & bisnis saat ini tidak dapat dipisahkan. Dengan memiliki website sebuah perusahaan akan terlihat lebih profesional, tidak ada batasan jarak dengan customer & sebagai sarana promosi online.',
	],
	[
		'q' => 'Bisakah mengedit sendiri setelah web selesai?',
		'a' => 'Tentu saja, kami akan memberikan login ke website & cpanel setelah selesai pengerjaan. Kami juga akan memberikan link dokumentasi pengelolaan webya.',
	],
	[
		'q' => 'Apakah ada support jika ada masalah teknis/update?',
		'a' => 'Tentu, kami akan membantu jika menemukan kendala teknis dalam pengelolaan atau ditemukan bug dalam system kami melalui tiket di member area yang sudah di sediakan.',
	],
	[
		'q' => 'Apakah bisa mengganti template sendiri?',
		'a' => 'Tidak, setelah mengganti template support teknis terkait pengelolaan website tidak berlaku lagi.',
	],
	[
		'q' => 'Apakah bisa saya menjadi reseller website?',
		'a' => 'Bisa, kami menawarkan potongan harga sampai 30% untuk reseller website. Kami akan membuatkan website sesuai spesifikasi yang anda berikan. Dapatkan penghasilan tambahan dengan bergabung menjadi reseller website kami dan buka agency website anda sendiri bersama kami.',
	],
];
?>

<section class="home-qna">
	<div class="umroh-container">
		<div class="home-qna__header">
			<h2 class="home-qna__title">Tanya Jawab Jasa Pembuatan Website</h2>
			<p class="home-qna__subtitle">Beberapa hal yang sering ditanyakan oleh klien kami.</p>
		</div>

		<div class="home-qna__content" x-data="{ active: 1 }">
			<div class="home-qna__list">
				<?php foreach ($qna_items as $index => $item) : $id = $index + 1; ?>
					<div class="home-qna__item">
						<button
							type="button"
							class="home-qna__trigger"
							:class="{ 'home-qna__trigger--active': active === <?php echo $id; ?> }"
							@click="active = (active === <?php echo $id; ?> ? null : <?php echo $id; ?>)"
							:aria-expanded="active === <?php echo $id; ?> ? 'true' : 'false'">
							<span><?php echo esc_html($item['q']); ?></span>
							<svg class="home-qna__icon" :class="{ 'home-qna__icon--rotated': active === <?php echo $id; ?> }" viewBox="0 0 192 512" xmlns="http://www.w3.org/2000/svg">
								<path fill="currentColor" d="M0 384.662V127.338c0-17.818 21.543-26.741 34.142-14.142l128.662 128.662c7.81 7.81 7.81 20.474 0 28.284L34.142 398.804C21.543 411.404 0 402.48 0 384.662z"></path>
							</svg>
						</button>
						<div
							class="home-qna__answer"
							x-show="active === <?php echo $id; ?>"
							x-collapse
							x-cloak>
							<div class="home-qna__answer-inner">
								<?php echo wp_kses_post($item['a']); ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<!-- FAQ Structured Data (SEO) -->
<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity": [
			<?php foreach ($qna_items as $index => $item) : ?> {
					"@type": "Question",
					"name": "<?php echo esc_attr($item['q']); ?>",
					"acceptedAnswer": {
						"@type": "Answer",
						"text": "<?php echo esc_attr(strip_tags($item['a'])); ?>"
					}
				}
				<?php echo ($index < count($qna_items) - 1) ? ',' : ''; ?>
			<?php endforeach; ?>
		]
	}
</script>