<?php namespace AaronHipple\CarolShure;

use WP_Customize_Color_Control;

class Customizer {

    private $colors = [
        'header_nav_bg' => [
            'label' => 'Header Accent/Nav Color',
            'default' => '#79172A',
            'rules' => [
                'background-color' => [
                    '.scrolled header > div nav',
                    'header nav li ul',
                ],
                'border-bottom-color' => [
                    'header',
                ],
            ],
        ],
        'buttons_accents' => [
            'label' => 'Buttons and Other Accents',
            'default' => '#E69021',
            'rules' => [
                'background-color' => [
                    '#content button',
                    '#content .button',
                ],
                'border-top-color' => [
                    'aside',
                ],
                'border-bottom-color' => [
                    'aside',
                ],
                'border-left-color' => [
                    'blockquote',
                ]

            ],
        ],
        'footer_bg' => [
            'label' => 'Footer Background Color',
            'default' => '#7188DA',
            'rules' => [
                'background-color' => [
                    'footer',
                    'footer nav li ul',
                ]
            ]
        ],
    ];

    public function __construct() {
        add_action('customize_register', [$this, 'registerCustomizerOptions']);
        add_action('wp_head', [$this, 'writeStyle'], 99);
        add_theme_support( 'custom-background' );
    }

    public function registerCustomizerOptions($wp_customize) {

        $priority = 10;

        foreach ($this->colors as $id => $color) {
            $wp_customize->add_setting( $id,
                array(
                    'default'    => $color['default'],
                    'type'       => 'theme_mod',
                    'capability' => 'edit_theme_options',
                    'transport'  => 'refresh',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    $id,
                    array(
                        'label'    => $color['label'],
                        'section'  => 'colors',
                        'settings' => $id,
                        'priority' => $priority++,
                    )
                )
            );
        }
        
        return $wp_customize;
    }

    public function writeStyle() {
        $css = '';
        foreach ($this->colors as $id => $color) {
            foreach ($color['rules'] as $property => $selectors) {
                $css .= implode(',', $selectors);
                $css .= '{' . $property . ':' . get_theme_mod($id, $color['default']) . '}';
            }
        }
        echo '<!-- Customizer CSS -->';
        echo '<style type="text/css">' . $css . '</style>';
    }
}