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

	if (is_page_template('page-templates/landing-jasa-website-umroh.php')) {
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
		$classes = 'umroh-price';
		if (! empty($plan['featured'])) {
			$classes .= ' umroh-price--featured';
		}

?>
		<div class="<?php echo esc_attr($classes); ?>">
			<div class="umroh-price__name"><?php echo esc_html($plan['name']); ?></div>
			<div class="umroh-price__row">
				<div class="umroh-price__price"><?php echo esc_html($plan['price']); ?></div>
				<?php if (! empty($plan['old_price'])) : ?>
					<div class="umroh-price__old"><?php echo esc_html($plan['old_price']); ?></div>
				<?php endif; ?>
			</div>
			<ul class="umroh-price__list">
				<?php foreach (($plan['features'] ?? []) as $feature) : ?>
					<li><?php echo esc_html($feature); ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="umroh-price__actions">
				<a class="umroh-button umroh-button--primary umroh-button--block" href="<?php echo esc_url($primary_cta_url); ?>">
					<?php echo esc_html($plan['cta_label']); ?>
				</a>
				<?php if (! empty($plan['design_key'])) : ?>
					<button type="button" class="umroh-button umroh-button--ghost umroh-button--block" @click="openDesign('<?php echo esc_js($plan['design_key']); ?>')">
						<?php echo esc_html($plan['design_label'] ?? 'Pilihan Desain'); ?>
					</button>
				<?php endif; ?>
			</div>
		</div>
<?php
	}
}
