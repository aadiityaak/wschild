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
		wp_enqueue_script(
			'alpine-collapse',
			'https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js',
			[],
			null,
			true
		);

		wp_enqueue_script(
			'alpinejs',
			'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js',
			['alpine-collapse'],
			null,
			true
		);
	}

	if (is_page_template('page-templates/landing-jasa-website-umroh.php') || is_page_template('page-templates/home.php') || is_page_template('page-templates/about-us.php') || is_page_template('page-templates/services.php') || is_page_template('page-templates/pricing.php') || is_page_template('page-templates/contact.php')) {
		wp_enqueue_style(
			'swiper-css',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
			[],
			'11.0.0'
		);

		wp_enqueue_script(
			'swiper-js',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
			[],
			'11.0.0',
			true
		);

		wp_enqueue_script(
			'gsap',
			'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
			[],
			null,
			true
		);

		wp_add_inline_script(
			'alpinejs',
			"window.wschildPricing=function(designs){return{designs:designs,activeKey:null,isOpen:false,openDesign:function(key){this.activeKey=key;this.isOpen=true;},closeDesign:function(){this.isOpen=false;},get active(){var empty={title:\"\",subtitle:\"\",items:[]};if(!this.activeKey){return empty;}return this.designs&&this.designs[this.activeKey]?this.designs[this.activeKey]:empty;}}};",
			'after'
		);
	}
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
	echo '<link rel="dns-prefetch" href="//cdn.jsdelivr.net">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link rel="preconnect" href="https://unpkg.com" crossorigin>' . "\n";
	echo '<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>' . "\n";
	echo '<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>' . "\n";
}, 1);

add_filter('script_loader_tag', function ($tag, $handle, $src) {
	if (! in_array($handle, ['alpinejs', 'alpine-collapse'], true)) {
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
