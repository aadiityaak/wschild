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

	// Enqueue Alpine Collapse only on home page
	if (is_page_template('page-templates/home.php') && ! wp_script_is('alpine-collapse', 'enqueued') && ! wp_script_is('alpine-collapse', 'registered')) {
		wp_enqueue_script(
			'alpine-collapse',
			'https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js',
			[],
			null,
			false // Move to head
		);
	}

	// Always enqueue theme-specific Alpine components FIRST
	wp_enqueue_script(
		'wschild-pricing',
		get_stylesheet_directory_uri() . '/assets/js/pricing.js',
		[], // Remove alpinejs dependency to control order
		wp_get_theme()->get('Version'),
		false // Move to head
	);

	// Enqueue Alpine.js LAST (with defer, it will wait for components)
	if (! wp_script_is('alpinejs', 'enqueued') && ! wp_script_is('alpinejs', 'registered')) {
		wp_enqueue_script(
			'alpinejs',
			'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js',
			is_page_template('page-templates/home.php') ? ['alpine-collapse', 'wschild-pricing'] : ['wschild-pricing'],
			null,
			false // Move to head
		);
	}

	// GSAP for Mouse Movement Effects (Hero & Why Us components)
	if (! wp_script_is('gsap', 'enqueued')) {
		wp_enqueue_script(
			'gsap',
			'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
			[],
			null,
			true
		);
	}
	if (! wp_script_is('gsap-scrolltrigger', 'enqueued')) {
		wp_enqueue_script(
			'gsap-scrolltrigger',
			'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
			['gsap'],
			null,
			true
		);
	}

	// Barba.js (Page Transitions)
	if (! wp_script_is('barba', 'enqueued')) {
		wp_enqueue_script(
			'barba',
			'https://unpkg.com/@barba/core',
			['gsap'],
			null,
			true
		);
	}

	wp_add_inline_script(
		'barba',
		"(function(){\n" .
			"if (typeof window === 'undefined' || typeof window.barba === 'undefined') return;\n" .
			"window.wschildBarbaEnabled = true;\n" .
			"var canAnimate = typeof window.gsap !== 'undefined';\n" .
			"var killScrollTriggersIn = function(root){\n" .
			"  if (!root || typeof window.ScrollTrigger === 'undefined') return;\n" .
			"  try {\n" .
			"    window.ScrollTrigger.getAll().forEach(function(t){\n" .
			"      var trg = t && t.trigger;\n" .
			"      if (trg && root.contains && root.contains(trg)) t.kill();\n" .
			"    });\n" .
			"  } catch (e) {}\n" .
			"};\n" .
			"window.wschildInitPage = function(container){\n" .
			"  if (typeof window.wschildInitRevealAnimations === 'function') window.wschildInitRevealAnimations(container);\n" .
			"  if (typeof window.wschildInitScrambleScroll === 'function') window.wschildInitScrambleScroll(container);\n" .
			"  if (typeof window.wschildInitPricingHover === 'function') window.wschildInitPricingHover(container);\n" .
			"  if (typeof window.wschildInitPricingScroll === 'function') window.wschildInitPricingScroll(container);\n" .
			"};\n" .
			"\n" .
			"window.barba.init({\n" .
			"  preventRunning: true,\n" .
			"  prevent: function(_ref){\n" .
			"    var el = _ref.el, event = _ref.event, href = _ref.href;\n" .
			"    if (!el || !href) return false;\n" .
			"    if (event && (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey)) return true;\n" .
			"    if (el.target && el.target === '_blank') return true;\n" .
			"    if (el.hasAttribute && el.hasAttribute('download')) return true;\n" .
			"    if (typeof href === 'string') {\n" .
			"      if (href.indexOf('#') === 0) return true;\n" .
			"      if (href.indexOf('mailto:') === 0 || href.indexOf('tel:') === 0) return true;\n" .
			"      if (href.indexOf('/wp-admin') !== -1 || href.indexOf('/wp-login') !== -1) return true;\n" .
			"    }\n" .
			"    if (el.closest && el.closest('[data-no-barba]')) return true;\n" .
			"    return false;\n" .
			"  },\n" .
			"  requestError: function(_trigger, action, url){\n" .
			"    if (action === 'click' && url) window.location.href = url;\n" .
			"    return false;\n" .
			"  },\n" .
			"  transitions: [{\n" .
			"    name: 'wschild-fade',\n" .
			"    leave: function(data){\n" .
			"      killScrollTriggersIn(data && data.current ? data.current.container : null);\n" .
			"      if (!canAnimate) return;\n" .
			"      return window.gsap.to(data.current.container, { opacity: 0, duration: 0.25, ease: 'power1.out' });\n" .
			"    },\n" .
			"    enter: function(data){\n" .
			"      if (!canAnimate) return;\n" .
			"      return window.gsap.from(data.next.container, { opacity: 0, duration: 0.25, ease: 'power1.out' });\n" .
			"    },\n" .
			"    beforeEnter: function(_ref2){\n" .
			"      var next = _ref2.next;\n" .
			"      if (!next || !next.html) return;\n" .
			"      var matches = next.html.match(/<body[^>]*class=([\\\"\\'])(.*?)\\1/i);\n" .
			"      document.body.setAttribute('class', (matches && matches[2]) ? matches[2] : '');\n" .
			"    },\n" .
			"    afterEnter: function(data){\n" .
			"      if (data && data.next && data.next.container) window.wschildInitPage(data.next.container);\n" .
			"      var trig = data ? data.trigger : null;\n" .
			"      if (trig !== 'back' && trig !== 'forward') window.scrollTo(0, 0);\n" .
			"    }\n" .
			"  }]\n" .
			"});\n" .
			"\n" .
			"window.barba.hooks.once(function(data){\n" .
			"  if (data && data.current && data.current.container) window.wschildInitPage(data.current.container);\n" .
			"});\n" .
			"})();",
		'after'
	);

	// Scramble Scroll Effect
	wp_enqueue_script(
		'wschild-scramble-scroll',
		get_stylesheet_directory_uri() . '/assets/js/scramble-scroll.js',
		['gsap', 'gsap-scrolltrigger'],
		wp_get_theme()->get('Version'),
		true
	);

	// Reveal Animations
	wp_enqueue_script(
		'wschild-reveal-animation',
		get_stylesheet_directory_uri() . '/assets/js/reveal-animation.js',
		['gsap', 'gsap-scrolltrigger'],
		wp_get_theme()->get('Version'),
		true
	);

	// Pricing Card Hover Animation
	wp_enqueue_script(
		'wschild-pricing-hover',
		get_stylesheet_directory_uri() . '/assets/js/pricing-hover.js',
		['gsap'],
		wp_get_theme()->get('Version'),
		true
	);

	// Pricing Card Scroll Speed Parallax
	wp_enqueue_script(
		'wschild-pricing-scroll',
		get_stylesheet_directory_uri() . '/assets/js/pricing-scroll.js',
		['gsap', 'gsap-scrolltrigger'],
		wp_get_theme()->get('Version'),
		true
	);

	// Logo Animation
	wp_enqueue_script(
		'wschild-logo-animation',
		get_stylesheet_directory_uri() . '/assets/js/logo-animation.js',
		['gsap'],
		wp_get_theme()->get('Version'),
		true
	);

	// Circle Cursor
	$cursor_css_path = get_stylesheet_directory() . '/assets/css/cursor.css';
	$cursor_js_path = get_stylesheet_directory() . '/assets/js/cursor.js';
	$cursor_css_ver = file_exists($cursor_css_path) ? (string) filemtime($cursor_css_path) : wp_get_theme()->get('Version');
	$cursor_js_ver = file_exists($cursor_js_path) ? (string) filemtime($cursor_js_path) : wp_get_theme()->get('Version');

	wp_enqueue_style(
		'wschild-cursor',
		get_stylesheet_directory_uri() . '/assets/css/cursor.css',
		[],
		$cursor_css_ver
	);

	wp_enqueue_style(
		'wschild-header',
		get_stylesheet_directory_uri() . '/assets/css/header.css',
		[],
		wp_get_theme()->get('Version')
	);

	wp_enqueue_script(
		'wschild-cursor',
		get_stylesheet_directory_uri() . '/assets/js/cursor.js',
		['gsap'],
		$cursor_js_ver,
		true
	);

	wp_enqueue_script(
		'wschild-header',
		get_stylesheet_directory_uri() . '/assets/js/header.js',
		[],
		wp_get_theme()->get('Version'),
		true
	);
});

/**
 * Add defer attribute to Alpine.js and related scripts
 */
add_filter('script_loader_tag', function ($tag, $handle) {
	if (in_array($handle, ['alpinejs', 'alpine-collapse', 'wschild-pricing'])) {
		if (strpos($tag, 'defer') === false) {
			return str_replace(' src', ' defer src', $tag);
		}
	}
	return $tag;
}, 10, 2);


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
	if (! in_array($handle, ['alpinejs', 'alpine-collapse', 'gsap', 'barba', 'wschild-cursor', 'wschild-pricing'], true)) {
		return $tag;
	}

	$src_attr = esc_url($src);
	return "<script src=\"{$src_attr}\" defer></script>\n";
}, 10, 3);

if (! function_exists('wschild_render_pricing_card')) {
	function wschild_render_pricing_card(array $plan, string $primary_cta_url): void
	{
		$theme = $plan['theme'] ?? 'purple';
		$classes = 'wschild-price wschild-price--' . $theme . ' wschild-pricing-card';
		if (! empty($plan['featured'])) {
			$classes .= ' wschild-price--featured';
		}
?>
		<div class="<?php echo esc_attr($classes); ?>">
			<div class="wschild-price__header">
				<div class="wschild-price__name"><?php echo esc_html($plan['name']); ?></div>
			</div>
			<div class="wschild-price__body">
				<div class="wschild-price__badge">
					<div class="wschild-price__amount"><?php echo esc_html($plan['price']); ?></div>
					<?php if (! empty($plan['old_price'])) : ?>
						<div class="wschild-price__old"><?php echo esc_html($plan['old_price']); ?></div>
					<?php endif; ?>
				</div>

				<ul class="wschild-price__list">
					<?php foreach (($plan['features'] ?? []) as $feature) : ?>
						<li>
							<svg class="wschild-check-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="var(--theme-solid, #4c4c80)">
								<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
							</svg>
							<span><?php echo esc_html($feature); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>

				<div class="wschild-price__actions">
					<?php
					$url_portofolio = 'https://websweetstudio.com/portfolio/';
					?>
					<a type="button" class="wschild-button wschild-button--dark wschild-button--pill" href="<?php echo esc_url($url_portofolio . '?halaman=1&jenis_web=' . $plan['category']); ?>">
						<?php echo esc_html($plan['design_label'] ?? 'Pilihan Desain'); ?>
					</a>
				</div>
			</div>
		</div>
<?php
	}
}
