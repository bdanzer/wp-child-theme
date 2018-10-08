<?php
namespace DanzerPressChild;

use Roots\Sage\Assets;

class DanzerpressChild {
    public function __construct() 
    {   
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts'], 101);
        add_filter('danzerpress_menu_html', [$this, 'hook']);
        add_filter('ajax_template', [$this, 'ajax_template']);

        if (IS_DEV) {
            add_filter('acf/settings/save_json', [$this, 'my_acf_json_save_point'], 99);
            add_filter('acf/settings/load_json', [$this, 'my_acf_json_load_point'], 99);
        } 
    }

    public function ajax_template($template) 
    {
        return 'child-front-content.twig';
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

    public function hook($menu) 
    {
        $menu = '<li id="danzerpress-search"><a class="danzerpress-search"><i class="fa fa-search"></i></a></li>';
        return $menu;
    }

    public function my_acf_json_save_point( $path ) {
        // update path
        $path = WP_PLUGIN_DIR . '/acf-json';
        
        // return
        return $path;
    }

    public function my_acf_json_load_point( $paths ) {
        
        // remove original path (optional)
        unset($paths[0]);
        
        // append path
        $paths[] = WP_PLUGIN_DIR  . '/acf-json';
        
        // return
        return $paths;
        
    }
}