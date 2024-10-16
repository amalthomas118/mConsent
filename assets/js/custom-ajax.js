jQuery(document).ready(function($) {
    $('#contactForm').submit(function(event) {
        event.preventDefault(); // Prevent form submission

        var formData = {
            'action': 'save_contact_form',
            'name': $('#name').val(),
            'mobile': $('#mobile').val(),
            'address': $('#address').val(),
            'email': $('#email').val(),
            'comments': $('#comments').val(),
        };

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url, 
            data: formData,
            success: function(response) {
                $('#form-messages').html(response.message);
            },
            error: function(xhr, status, error) {
                $('#form-messages').html('An error occurred. Please try again.');
            }
        });
    });
});
