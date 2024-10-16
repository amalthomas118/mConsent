<?php

/**
 * Template Name: Home page
 * 
 */

get_header(); 

// Banner
get_template_part('template-parts/home/banner');

//Load the contents from CPT
get_template_part('template-parts/home/cards');



//Footer
get_footer();