<?php
/**
 * File Name:- theme-hooks.php
 * @category WordPress
 * @package  mConsent
 * 
 * Class MconsentHooks
 *
 */
class MconsentHooks {

    public function __construct() {
        // Menu Setup
        add_action('after_setup_theme', array($this, 'mconsent_menu_setup'));

        // Include Scripts
        add_action('wp_enqueue_scripts', array($this, 'mconsent_scripts'), 1);

        // Include Style
        add_action('wp_enqueue_scripts', array($this, 'mconsent_styles'));
        
    }

    // Function for the custom Menu
    public function mconsent_menu_setup() {

        register_nav_menus(array(
            'primary_menu' => esc_html__('Primary menu', 'mconsent'),
            'footer_menu' => esc_html__('Footer menu', 'mconsent'),
            'bottom_menu' => esc_html__('Bottom menu', 'mconsent'),
        ));
    }

    //function to load the main css 
    public function mconsent_styles() {
        wp_enqueue_style('theme-css', get_template_directory_uri() . '/assets/css/theme.css', array(), filemtime(get_theme_file_path('/assets/css/theme.css')), 'all');
    }

    // Function to load the scripts 
    public function mconsent_scripts() {

        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js', false, null, true);
        wp_enqueue_script('jquery');
        wp_enqueue_script(
            'ripples-js','https://cdnjs.cloudflare.com/ajax/libs/jquery.ripples/0.5.3/jquery.ripples.js',
            array('jquery'),
            '1.0',
            true
        );

        wp_enqueue_script(
            'mconsent-js',
            get_template_directory_uri() . '/assets/js/jquery-migrate.min.js',
            array('jquery'),
            filemtime( get_template_directory() . '/assets/js/jquery-migrate.min.js'),
            true
        );

        // Add additional Scripts 
        wp_enqueue_script(
            'custom-js',
            get_template_directory_uri() . '/assets/js/custom-scripts.js',
            array('jquery'),
            filemtime( get_template_directory() . '/assets/js/custom-scripts.js'),
            true
        );

        wp_enqueue_script('jquery');
        wp_enqueue_script('custom-ajax-script', get_template_directory_uri() . 'assets/js/custom-ajax.js', array('jquery'), null, true );
        wp_localize_script('custom-ajax-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

    }

    


}
$theme_hooks = new MconsentHooks;