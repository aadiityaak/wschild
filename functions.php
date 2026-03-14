<?php

if (! defined('ABSPATH')) {
	exit;
}

add_action('wp_enqueue_scripts', function () {
	$parent_handle = 'hello-elementor-parent';

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

	if (is_page_template('page-templates/landing-jasa-website-umroh.php') || is_page_template('page-templates/trial.php')) {
		wp_enqueue_script(
			'wschild-alpine',
			'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js',
			[],
			null,
			true
		);

		wp_add_inline_script(
			'wschild-alpine',
			"window.wschildPricing=function(designs){return{designs:designs,activeKey:null,isOpen:false,openDesign:function(key){this.activeKey=key;this.isOpen=true;},closeDesign:function(){this.isOpen=false;},get active(){var empty={title:\"\",subtitle:\"\",items:[]};if(!this.activeKey){return empty;}return this.designs&&this.designs[this.activeKey]?this.designs[this.activeKey]:empty;}}};",
			'after'
		);
	}
});

add_filter('script_loader_tag', function ($tag, $handle, $src) {
	if ($handle !== 'wschild-alpine') {
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
