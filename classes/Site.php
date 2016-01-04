<?php namespace AaronHipple\CarolShure;

use TimberSite, TimberMenu, Timber, Twig_Extension_StringLoader;

class Site extends TimberSite {

    function __construct() {
        add_theme_support( 'post-formats' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );
        add_theme_support( 'html5' );
        add_filter( 'timber_context', [$this, 'add_to_context'] );
        add_filter( 'get_twig', [$this, 'add_to_twig'] );        
        add_filter( 'body_class', [$this, 'addBodyClasses'] );
        add_action( 'wp_enqueue_scripts', [$this, 'enqueueScripts']);
        add_action( 'admin_init', [$this, 'addEditorStyle'] );
        new Menus();
        new Customizer();
        parent::__construct();
    }

    function addEditorStyle() {
        add_editor_style( 'editor-style.css' );
    }

    function add_to_context( $context ) {
        $context['site'] = $this;
        return $context;
    }

    function add_to_twig( $twig ) {
        $twig->addExtension( new Twig_Extension_StringLoader() );
        return $twig;
    }

    function addBodyClasses( $classes ) {
        if ( is_front_page() ) {
            $classes[] = 'unscrolled';
        } else {
            $classes[] = 'scrolled';
        }
        return $classes;
    }

    function enqueueScripts() {
        if ( is_front_page() ) {
            wp_enqueue_script(
                'home-banner-scroll',
                get_template_directory_uri() . '/js/home-banner-scroll.js'
            );
        }
        wp_enqueue_style(
            'google-fonts',
            'https://fonts.googleapis.com/css?family=Josefin+Sans:100,300,600|Arvo:400,700'
        );
    }

}
