<?php
namespace DanzerpressChild;

/**
 * This class should be used only to change the context/template 
 * that is theme specific not plugin specific. Use hooks within 
 * the plugin.
 */
class Hooks {
    public function __construct() 
    {   
        add_filter('calendar_render', [$this, 'calendar_render'], 10, 1);
    }

    public function calendar_render($render_arr) 
    {
        return $render_arr;
    }
}