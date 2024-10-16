<?php 
function save_cf7_to_leads_cpt($contact_form) {
    // Get the submitted form data
    $submission = WPCF7_Submission::get_instance();
    
    if ($submission) {
        $posted_data = $submission->get_posted_data();

        // Log the posted data to ensure it's being captured
        error_log('Form Data: ' . print_r($posted_data, true));

        // Capture form field values
        $name = isset($posted_data['name']) ? sanitize_text_field($posted_data['name']) : '';
        $mobile = isset($posted_data['mobile']) ? sanitize_text_field($posted_data['mobile']) : '';
        $email = isset($posted_data['email']) ? sanitize_email($posted_data['email']) : '';
        $message = isset($posted_data['your-message']) ? sanitize_textarea_field($posted_data['your-message']) : '';

        // Log the captured values
        error_log("Captured Data: Name: $name, Mobile: $mobile, Email: $email, Message: $message");

        // Only proceed if name and email are provided (required fields)
        if (!empty($name) && !empty($email)) {
            // Create new custom post in Leads post type
            $new_post = array(
                'post_title'   => $name,
                'post_type'    => 'leads',  // Save to Leads CPT
                'post_status'  => 'publish',
            );

            // Insert the post and check for errors
            $post_id = wp_insert_post($new_post);

            if (is_wp_error($post_id)) {
                // Log the error if the post insertion fails
                $error_message = $post_id->get_error_message();
                error_log('Error saving form submission to Leads CPT: ' . $error_message);
            } else {
                // Log the successful post creation
                error_log('Form submission saved successfully to Leads CPT with Post ID: ' . $post_id);

                // Save custom fields using update_post_meta()
                update_post_meta($post_id, 'mobile', $mobile);
                update_post_meta($post_id, 'email', $email);
                update_post_meta($post_id, 'message', $message);
            }
        } else {
            error_log('Required fields (name, email) are missing.');
        }
    } else {
        error_log('Contact Form 7 submission instance not found.');
    }

    return $contact_form;  // Return the form object to continue with the mailing process
}
add_action('wpcf7_before_send_mail', 'save_cf7_to_leads_cpt');



?>