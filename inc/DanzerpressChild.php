<?php
namespace DanzerpressChild;

use Roots\Sage\Assets;

class DanzerpressChild {
    public function __construct() 
    {   
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts'], 101);
        add_filter('acf/settings/save_json', [$this, 'my_acf_json_save_point']);
        add_filter('acf/settings/load_json', [$this, 'my_acf_json_load_point']);
        add_filter('dp_json_dir_location', [$this, 'dp_json_dir_location']);
        define('IS_DEV', true);
    }

    public function enqueue_scripts() 
    {
        // enqueue parent styles
        wp_enqueue_style('parent-theme', Assets\asset_path('styles/main.css'), false, \Danzerpress\DP_Theme::get_ver());

        // enqueue child styles
        wp_enqueue_style('child-theme', get_stylesheet_directory_uri() . '/dist/style.min.css', ['parent-theme'], self::get_ver());
    
        //child theme js
        wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/dist/main.min.js', array(), self::get_ver(), true);
    
        //google fonts
        wp_enqueue_style('child-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:400,700');	
    }

    public function dp_json_dir_location($dir) 
    {
        return get_stylesheet_directory() . '/dp-json/';
    }

    public function my_acf_json_save_point($path) {
        $path = get_template_directory() . '/acf-json';
        
        // return
        return $path;
    }

    public function my_acf_json_load_point($paths) {
        
        // remove original path (optional)
        unset($paths[0]);

        $path = get_template_directory() . '/acf-json';
        
        // append path
        $paths[] = $path;
        
        // return
        return $paths; 
    }

    public static function get_ver() 
    {
        return wp_get_theme()->get('Version');
    }
}