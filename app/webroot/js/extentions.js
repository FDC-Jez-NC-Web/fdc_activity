$(document).ready(function() {

    $('#changeEmailForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '/users/change_email',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#changeEmailMessage').html('<div class="alert alert-success">Email changed successfully.</div>');
                $('#changeEmailForm')[0].reset();
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred while changing the email.';
                $('#changeEmailMessage').html('<div class="alert alert-danger">' + errorMessage + '</div>');
            }
        });
    });

    $('#changePasswordForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '/users/change_password', 
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
             
                const { success, message , errors} = JSON.parse(response);
                console.log(errors);
                if(success === true) {
                    $('#changePasswordMessage').html('<div class="alert alert-success">Password changed successfully.</div>');
                }else{
                    $('#changePasswordMessage').html('<div class="alert alert-danger">' + message + '</div>');
                }
                $('#changePasswordForm')[0].reset();
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred while changing the password.';
                $('#changePasswordMessage').html('<div class="alert alert-danger">' + errorMessage + '</div>');
            }
        });
    });
});
