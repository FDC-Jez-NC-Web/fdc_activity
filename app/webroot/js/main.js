$(document).ready(function() {

    $('#image').change(function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreview').removeClass('d-none');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $('#profileForm').submit(function(event) {
        event.preventDefault();
        
        var formData = new FormData($(this)[0]);

        formData.append('token', localStorage.getItem('token'));

    
        $.ajax({
            url: 'profile/profile', 
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success
                console.log(response);
                alert('Profile submitted successfully!');
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
                alert('Error: ' + xhr.responseText);
            }
        });
    });



  

   
    $('#UserRegisterForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        ajax_request('POST', '/register', formData, 'UserRegisterForm');
    });

    $('#loginForm').submit(function(event) {
        event.preventDefault(); 
      
        var formData = $(this).serialize();
      
        ajax_request('POST', '/login', formData, 'loginForm');
    
    })

    function ajax_request(type, url, payload, id){
        $.ajax({
            type: type,
            url: url, 
            dataType: 'json',
            data: payload,
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect;
                } 
            },
            error: function(xhr, status, error) {
                console.error('Error:', error); 
                alert('An error occurred. Please try again.'); 
            }
        });
    }

    function isValidEmail(email) {
    var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
    }

});