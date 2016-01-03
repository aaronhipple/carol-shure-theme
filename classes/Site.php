<?php namespace AaronHipple\CarolShure;

use TimberSite, TimberMenu, Timber, Twig_Extension_StringLoader;

class Site extends TimberSite {

    function __construct() {
        add_theme_support( 'post-formats' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );
        add_filter( 'timber_context', array( $this, 'add_to_context' ) );
        add_filter( 'get_twig', array( $this, 'add_to_twig' ) );        
        parent::__construct();
    }

    function add_to_context( $context ) {
        $context['menu'] = new TimberMenu();
        $context['site'] = $this;
        return $context;
    }

    function add_to_twig( $twig ) {
        $twig->addExtension( new Twig_Extension_StringLoader() );
        return $twig;
    }

}
