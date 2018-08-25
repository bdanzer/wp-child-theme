<?php
use Roots\Sage\Assets;
// enqueue styles for child theme
// @ https://digwp.com/2016/01/include-styles-child-theme/
function danzerpress_child_enqueue() {
	
	// enqueue parent styles
	wp_enqueue_style('parent-theme', Assets\asset_path('styles/main.css'), false, null);
	
	// enqueue child styles
	wp_enqueue_style('child-theme', get_stylesheet_directory_uri() . '/style.css', ['parent-theme']);

    //child theme js
	wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/js/dist/scripts.min.js', array(), null, true);

	//google fonts
	wp_enqueue_style('child-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:400,700');	
}