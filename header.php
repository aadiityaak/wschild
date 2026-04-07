<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Wschild
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> x-data="{ mobileMenuOpen: false }">
	<?php wp_body_open(); ?>

	<!-- Global Gooey Filter -->
	<svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="display:none; position: absolute; width: 0; height: 0;">
		<defs>
			<filter id="gooey">
				<feGaussianBlur in="SourceGraphic" stdDeviation="12" result="blur" />
				<feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 25 -10" result="goo" />
			</filter>
		</defs>
	</svg>

	<header id="masthead" class="site-header sticky-header">
		<?php get_template_part('src/component/header'); ?>
	</header>

	<div id="content" class="site-content">