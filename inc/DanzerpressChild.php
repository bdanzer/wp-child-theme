<?php
namespace DanzerPressChild;

use Roots\Sage\Assets;

class DanzerpressChild {
    public function __construct() 
    {   
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts'], 101);
        add_filter('acf/settings/save_json', [$this, 'my_acf_json_save_point']);
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

    public function my_acf_json_save_point( $path ) {
        // update path
        $path = get_template_directory_uri() . '/acf-json';
        
        // return
        return $path;
    }
}