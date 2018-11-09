<?php
namespace DanzerpressChild;

use Roots\Sage\Assets;

class DanzerpressChild {
    public function __construct() 
    {   
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts'], 101);
    }

    public function enqueue_scripts() 
    {
        // enqueue parent styles
        wp_enqueue_style('parent-theme', Assets\asset_path('styles/main.css'), false, null);

        // enqueue child styles
        wp_enqueue_style('child-theme', get_stylesheet_directory_uri() . '/dist/style.min.css', ['parent-theme']);
    
        //child theme js
        wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/dist/main.min.js', array(), null, true);
    
        //google fonts
        wp_enqueue_style('child-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:400,700');	
    }
}