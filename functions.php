<?php

if (! defined('ABSPATH')) {
	exit;
}

add_action('wp_enqueue_scripts', function () {
	$parent_handle = 'hello-elementor-parent';

	// Enqueue Fonts
	wp_enqueue_style(
		'wschild-fonts',
		'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&display=swap',
		[],
		null
	);

	wp_enqueue_style(
		$parent_handle,
		get_template_directory_uri() . '/style.css',
		[],
		wp_get_theme(get_template())->get('Version')
	);

	wp_enqueue_style(
		'wschild',
		get_stylesheet_directory_uri() . '/style.css',
		[$parent_handle],
		wp_get_theme()->get('Version')
	);

	if (! wp_script_is('alpinejs', 'enqueued') && ! wp_script_is('alpinejs', 'registered')) {
		// Enqueue Alpine Collapse only on home page (used in QNA component)
		if (is_page_template('page-templates/home.php')) {
			wp_enqueue_script(
				'alpine-collapse',
				'https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js',
				[],
				null,
				true
			);
		}

		wp_enqueue_script(
			'alpinejs',
			'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js',
			is_page_template('page-templates/home.php') ? ['alpine-collapse'] : [],
			null,
			true
		);

		// Pricing & Modal Logic (Always include if AlpineJS is present for robustness)
		wp_add_inline_script(
			'alpinejs',
			"window.wschildPricing=function(designs){return{designs:designs,activeKey:null,isOpen:false,openDesign(key){this.activeKey=key;this.isOpen=true;},closeDesign(){this.isOpen=false;},active(){const empty={title:'',subtitle:'',items:[]};if(!this.activeKey){return empty;}return this.designs&&this.designs[this.activeKey]?this.designs[this.activeKey]:empty;}}};",
			'after'
		);
	}

	// GSAP for Mouse Movement Effects (Hero & Why Us components)
	if (! wp_script_is('gsap', 'enqueued') && ! wp_script_is('gsap', 'registered')) {
		wp_enqueue_script(
			'gsap',
			'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
			[],
			null,
			true
		);
	}

	// Circle Cursor
	wp_enqueue_style(
		'wschild-cursor',
		get_stylesheet_directory_uri() . '/assets/css/cursor.css',
		[],
		wp_get_theme()->get('Version')
	);

	wp_enqueue_script(
		'wschild-cursor',
		get_stylesheet_directory_uri() . '/assets/js/cursor.js',
		['gsap'],
		wp_get_theme()->get('Version'),
		true
	);
});

/**
 * Register Navigation Menus & Theme Support
 */
add_action('after_setup_theme', function () {
	register_nav_menus([
		'primary' => __('Primary Menu', 'wschild'),
	]);

	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
});

/**
 * Add SEO Speed Optimizations
 */
add_action('wp_head', function () {
	// Speed Optimizations: Resource Hints
	echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
	echo '<link rel="dns-prefetch" href="//fonts.gstatic.com">' . "\n";
	echo '<link rel="dns-prefetch" href="//unpkg.com">' . "\n";
	echo '<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link rel="preconnect" href="https://unpkg.com" crossorigin>' . "\n";
	echo '<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>' . "\n";

	// 3. LCP Image Preload
	$lcp_image = '';
	$lcp_srcset = '';

	if (is_page_template('page-templates/home.php') || is_page_template('page-templates/about-us.php') || is_page_template('page-templates/pricing.php') || is_page_template('page-templates/contact.php') || is_front_page()) {
		$lcp_image = 'https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home.webp';
		$lcp_srcset = 'https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home.webp 823w, https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home-600x747.webp 600w, https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home-241x300.webp 241w, https://websweetstudio.com/wp-content/uploads/2023/07/websweetstudio-home-768x956.webp 768w';
	} elseif (is_page_template('page-templates/services.php')) {
		$lcp_image = 'https://websweetstudio.com/wp-content/uploads/2024/07/layanan.webp';
		$lcp_srcset = 'https://websweetstudio.com/wp-content/uploads/2024/07/layanan.webp 823w, https://websweetstudio.com/wp-content/uploads/2024/07/layanan-241x300.webp 241w, https://websweetstudio.com/wp-content/uploads/2024/07/layanan-768x956.webp 768w, https://websweetstudio.com/wp-content/uploads/2024/07/layanan-600x747.webp 600w';
	} elseif (is_single() && has_post_thumbnail()) {
		$lcp_id = get_post_thumbnail_id();
		$lcp_data = wp_get_attachment_image_src($lcp_id, 'full');
		if ($lcp_data) {
			$lcp_image = $lcp_data[0];
			$lcp_srcset = wp_get_attachment_image_srcset($lcp_id, 'full');
		}
	} elseif (is_archive() && have_posts()) {
		// Preload first post thumbnail for archive pages
		global $wp_query;
		if (isset($wp_query->posts[0])) {
			$first_post_id = $wp_query->posts[0]->ID;
			if (has_post_thumbnail($first_post_id)) {
				$lcp_id = get_post_thumbnail_id($first_post_id);
				$lcp_data = wp_get_attachment_image_src($lcp_id, 'full');
				if ($lcp_data) {
					$lcp_image = $lcp_data[0];
					$lcp_srcset = wp_get_attachment_image_srcset($lcp_id, 'full');
				}
			}
		}
	}

	if ($lcp_image) {
		echo '<link rel="preload" as="image" href="' . esc_url($lcp_image) . '" imagesrcset="' . esc_attr($lcp_srcset) . '" imagesizes="(max-width: 480px) 241px, (max-width: 768px) 600px, (max-width: 1024px) 768px, 800px" fetchpriority="high">' . "\n";
	}
}, 1);

add_filter('script_loader_tag', function ($tag, $handle, $src) {
	if (! in_array($handle, ['alpinejs', 'alpine-collapse', 'gsap', 'wschild-cursor'], true)) {
		return $tag;
	}

	$src_attr = esc_url($src);
	return "<script src=\"{$src_attr}\" defer></script>\n";
}, 10, 3);

if (! function_exists('wschild_render_pricing_card')) {
	function wschild_render_pricing_card(array $plan, string $primary_cta_url): void
	{
		$theme = $plan['theme'] ?? 'purple';
		$classes = 'umroh-price umroh-price--' . $theme;
		if (! empty($plan['featured'])) {
			$classes .= ' umroh-price--featured';
		}
?>
		<div class="<?php echo esc_attr($classes); ?>">
			<div class="umroh-price__header">
				<div class="umroh-price__name"><?php echo esc_html($plan['name']); ?></div>
			</div>
			<div class="umroh-price__body">
				<div class="umroh-price__badge">
					<div class="umroh-price__amount"><?php echo esc_html($plan['price']); ?></div>
					<?php if (! empty($plan['old_price'])) : ?>
						<div class="umroh-price__old"><?php echo esc_html($plan['old_price']); ?></div>
					<?php endif; ?>
				</div>

				<ul class="umroh-price__list">
					<?php foreach (($plan['features'] ?? []) as $feature) : ?>
						<li>
							<svg class="umroh-check-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="var(--theme-solid, #4c4c80)">
								<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
							</svg>
							<span><?php echo esc_html($feature); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>

				<div class="umroh-price__actions">
					<?php
					$url_portofolio = 'https://websweetstudio.com/portfolio/';
					?>
					<a type="button" class="umroh-button umroh-button--dark umroh-button--pill" href="<?php echo esc_url($url_portofolio . '?halaman=1&jenis_web=' . $plan['category']); ?>">
						<?php echo esc_html($plan['design_label'] ?? 'Pilihan Desain'); ?>
					</a>
				</div>
			</div>
		</div>
<?php
	}
}
