<?php
/**
 * Class mConsentACFHandler  
 */
class mConsentACFHandler
{
    public function __construct()
    {
        // Create a option page to manage general settings
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(
                array(
                    'page_title' => 'Theme Settings',
                    'menu_title' => 'Theme Settings',
                    'menu_slug'  => 'mconsent-theme-settings',
                    'capability' => 'edit_posts',
                    'redirect'   => false
                )
            );
        }
    }
}
new mConsentACFHandler();