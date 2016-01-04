<?php namespace AaronHipple\CarolShure;

use TimberMenu;

class Menus {
    public function __construct() {
        $this->registerMenus();
        add_filter('timber_context', [$this, 'addToContext']);
    }

    public function registerMenus() {
        register_nav_menus([
            'header_menu' => 'Header Menu',
            'footer_menu' => 'Footer Menu',
        ]);
    }

    public function addToContext($context) {
        $context['header_menu'] = new TimberMenu('header_menu');
        $context['footer_menu'] = new TimberMenu('footer_menu');
        return $context;
    }

}