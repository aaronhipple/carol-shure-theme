<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'ClassLoader.php';

$classLoader = new AaronHipple\CarolShure\ClassLoader(
    'AaronHipple\CarolShure',
    __DIR__ . DIRECTORY_SEPARATOR . 'classes'
);
$classLoader->register();


if ( ! class_exists( 'Timber' ) ) {
    add_action( 'admin_notices', function() {
            echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
        } );
    return;
}

Timber::$dirname = array('templates');

new AaronHipple\CarolShure\Site();
