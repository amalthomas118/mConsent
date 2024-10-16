<!-- Post type name : Cards -->
<?php
function cards_custom_post_type() {
    // Register the custom post type
    $labels = array(
        'name'                  => 'Cards',
        'singular_name'         => 'Card',
        'menu_name'             => 'Cards',
        'name_admin_bar'        => 'Card',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Card',
        'new_item'              => 'New Card',
        'edit_item'             => 'Edit Card',
        'view_item'             => 'View Card',
        'all_items'             => 'All Cards',
        'search_items'          => 'Search Cards',
        'parent_item_colon'     => 'Parent Cards:',
        'not_found'             => 'No cards found.',
        'not_found_in_trash'    => 'No cards found in Trash.'
    );
  
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'cards' ),
        'supports'              => array( 'title' ),
        'show_in_rest'          => true, // For block editor support
        'publicly_queryable'    => true, // Disable single page
    );
  
    register_post_type( 'cards', $args );
    
    // Register custom taxonomy (categories: Product and Blog)
    $tax_labels = array(
        'name'              => 'Categories',
        'singular_name'     => 'Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'parent_item'       => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Categories',
    );
    
    $tax_args = array(
        'hierarchical'      => true,
        'labels'            => $tax_labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'card-category' ),
    );
    
    register_taxonomy( 'card_category', array( 'cards' ), $tax_args );

    // Add default categories: Product and Blog
    if (!term_exists('Product', 'card_category')) {
        wp_insert_term('Product', 'card_category');
    }
    if (!term_exists('Blog', 'card_category')) {
        wp_insert_term('Blog', 'card_category');
    }
}
add_action( 'init', 'cards_custom_post_type' );

?>

<!-- Post type name : Leads -->
<?php
function create_contact_cpt() {
    $labels = array(
        'name' => __('Leads', 'textdomain'),
        'singular_name' => __('Lead', 'textdomain'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'custom-fields'),
    );
    
    register_post_type('leads', $args);
}
add_action('init', 'create_contact_cpt');

function add_leads_meta_boxes() {
    add_meta_box(
        'leads_meta_box',       
        'Lead Information',     
        'leads_meta_box_callback', 
        'leads',                
        'normal',               
        'high'                 
    );
}
add_action('add_meta_boxes', 'add_leads_meta_boxes');

// Meta box callback function
function leads_meta_box_callback($post) {
    // Get the meta data
    $mobile = get_post_meta($post->ID, 'mobile', true);
    $email = get_post_meta($post->ID, 'email', true);
    $message = get_post_meta($post->ID, 'message', true);
    ?>
    <p>
        <label for="mobile"><strong>Mobile:</strong></label><br>
        <input type="text" id="mobile" name="mobile" value="<?php echo esc_attr($mobile); ?>">
    </p>
    <p>
        <label for="email"><strong>Email:</strong></label><br>
        <input type="email" id="email" name="email" value="<?php echo esc_attr($email); ?>">
    </p>
    <p>
        <label for="message"><strong>Message:</strong></label><br>
        <textarea id="message" name="message"><?php echo esc_textarea($message); ?></textarea>
    </p>
    <?php
}

// Save the meta box data when the post is saved
function save_leads_meta_box_data($post_id) {
    if (array_key_exists('mobile', $_POST)) {
        update_post_meta($post_id, 'mobile', sanitize_text_field($_POST['mobile']));
    }
    if (array_key_exists('email', $_POST)) {
        update_post_meta($post_id, 'email', sanitize_email($_POST['email']));
    }
    if (array_key_exists('message', $_POST)) {
        update_post_meta($post_id, 'message', sanitize_textarea_field($_POST['message']));
    }
}
add_action('save_post', 'save_leads_meta_box_data');

?>
