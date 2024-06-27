$(document).ready(function() {


        $('#birthdate').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            maxDate: '0', // Restrict future dates
            showButtonPanel: true, // Show today and clear buttons
            
        });

    $('#profileForm').submit(function(event) {
        event.preventDefault();

        // var email = $('#email').val();
        // if (!isValidEmail(email)) {
        //     displayError('Please enter a valid email address.');
        //     return;
        // }

  
        var fileInput = document.getElementById('image');
        var maxFileSize = 2 * 1024 * 1024; // 2MB in bytes
        if (fileInput.files.length > 0) {
            var allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
            var fileExtension = fileInput.files[0].name.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                displayError('Please select a valid image file (.jpg, .jpeg, .gif, .png).');
                return;
            }
            if (fileInput.files[0].size > maxFileSize) {
                displayError('Selected image file exceeds 2MB. Please choose a smaller file.');
                return;
            }
        }

        var formData = new FormData($(this)[0]);

        $.ajax({
            type: 'POST',
            url: '/users/profile', 
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                console.log('Profile updated successfully:', response);
                if (response.success) {
                    alert(response.message);
                    window.location.href = '/users/dashboard';
                } else {
                    displayError(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    });

    // Preview image before upload
    $('#image').change(function() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result).show();
                $('#existingImage').hide(); 
            }
            reader.readAsDataURL(input.files[0]);
        }
    });

  
    function isValidEmail(email) {
        var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }


    function displayError(message) {
        $('#validation-messages').html('<div class="alert alert-danger">' + message + '</div>');

        setTimeout(() => {
            $('#validation-messages').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 3000);
        
    }

  
    //this is register ajax form submit
    $('#registerForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        var actionUrl = $(this).attr('action'); 
        ajax_request('POST', actionUrl, formData, 'registerForm');
    });


    //this is login ajax form submit
    $('#loginForm').submit(function(event) {
        event.preventDefault(); 
        var formData = $(this).serialize();
        var actionUrl = $(this).attr('action'); 
        ajax_request('POST', actionUrl, formData, 'loginForm');
    
    })

    function ajax_request(type, url, payload, id){
        $.ajax({
            type: type,
            url: url, 
            dataType: 'json',
            data: payload,
            success: function(response) {

                if (response.success) {
                    alert(response.message);

                    if(id === "registerForm"){
                        window.location.href = '/users/thankyou';
                        return;
                    }

                    window.location.href = "/users/dashboard";

                } else {


                    var messages = '<div id="validation-alert" class="alert alert-danger"><ul style="list-style-type: none;">';
                    if (id === "registerForm") {
                        $.each(response.message, function(index, error) {
                            messages += '<li>' + error + '</li>';
                        });
                    } else {
                        messages += '<li>' + response.message + '</li>';
                    }
                    messages += '</ul></div>';
                    
                    $('#validation-messages').html(messages);
                    
                    setTimeout(() => {
                        $('#validation-alert').fadeOut('slow', function() {
                            $(this).remove();
                        });
                    }, 3000);
                    
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error); 
                alert('An error occurred. Please try again.'); 
            }
        });
    }

    var states = [];
    
    function formatState(state) {
        if (!state.id) {
            return state.text;
        }
       
        var $state = $(
            '<span><img class="img-flag rounded-circle" /> ' + state.text + '</span>'
        );
    
  
        return $state;
    }
    
    $(document).ready(function() {
        $(".js-example-templating").select2({
            data: states, // Use the 'states' array as data source
            templateSelection: formatState, // Apply custom template for selected item
            templateResult: formatState // Apply custom template for dropdown options
        });
    });

    $('#sendMessageForm').submit(function(event) {
        event.preventDefault(); 

        var formData = $(this).serialize();
    
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json', // Expect JSON response
            success: function(response) {
                // Handle successful response (optional)
                console.log('Message sent successfully');
                alert('Message sent successfully');
                $('#sendMessageForm')[0].reset(); // Reset form fields
             
            },
            error: function(xhr, status, error) {
                // Handle error response (optional)
                console.error('Error sending message:', error);
                alert('Error sending message');
            }
        });
    });
   
    $('#replyMessageForm').on('submit', function(e) {
        e.preventDefault(); 
  
        $.ajax({
            url: $(this).attr('action'), 
            type: 'post', 
            data: $(this).serialize(), // Serialize the form data
            dataType: 'json', // Expect JSON response
            success: function(response) {
                alert('Message sent successfully');
                $('#message-reply-container').empty();
                $('#replyMessageForm')[0].reset(); 
                loadAllReplyMessages();
                return;
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the request
                console.error(error);
                alert('An error occurred while sending the reply.');
            }
        });
    });



    var offset = 0; 
    var limit = 10; 
    var url = new URL(window.location.href);
    var receiverId = url.searchParams.get('receiver_id');
    var sender_id = url.searchParams.get('sender_id');
    var senderOwnerId = url.searchParams.get('sender_owner_id');

    $('#show-more').show();

    function loadMoreMessages() {

        $.ajax({
            url: "/users/getAllMessages",
            type: 'GET',
            data: {
                offset: offset,
                limit: limit
            },
            success: function(response) {
                 const {success, messages, user_id } = JSON.parse(response);

              
                if (success) {
                        
                    $('#messages-container').empty();

                    if (messages.length === 0) {
                        $('#no-messages').show(); 
                        $('#show-more').text('Back to first page');
                        offset = -1;
                    } else {
                        $('#no-messages').hide(); 
                        $('#show-more').text('Show more');
                    }

                    if(messages.length <= 10){
                        $('#show-more').hide();
                    }
                    for (var i = 0; i < messages.length; i++) {

                        var message = messages[i];
                        
                        var senderImageUrl = message.data.sender_image ? '/img/uploads/' + message.data.sender_image : '/img/default_image.png';
                        var isCurrentUserSender = (message.data.sender_id == user_id);
                        var messageHtml = '';

                        if (isCurrentUserSender) {
                            messageHtml = `
                                <div class="message-item mb-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="${senderImageUrl}" alt="${message.data.sender_name}" class="img-fluid rounded-circle">
                                        </div>
                                        <div class="col-md-8 text-star">
                                            <div class="d-flex gap-2">
                                                ${isCurrentUserSender ? 'Message to: ' : 'Message from: '}
                                                <div class="message-sender">${message.data.receiver_name} (${message.data.receiver_email})</div>
                                            </div>
                                            <div class="message-content mb-2">Message: ${message.data.message_details}</div>
                                            <div class="message-date">${moment(message.data.created_at).calendar()}</div>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <div class="message-actions  d-flex flex-column gap-2">
                                                <a href="/messages/message_details?receiver_id=${message.data.receiver_id}&sender_id=${message.data.sender_id}" class="btn btn-sm btn-primary ml-2 w-100"><i class="fas fa-eye"></i> View</a>
                                                <button class="btn btn-sm btn-danger delete-all-message w-100" data-receiver-id= "${message.data.receiver_id}" data-receiver-name="${message.data.receiver_name}">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        } else {
                            messageHtml = `
                                <div class="message-item mb-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="message-actions d-flex flex-column gap-2 ">
                                                 <button class="btn btn-sm btn-danger delete-all-message w-100" data-receiver-id= "${message.data.receiver_id}" data-owner-id="${message.data.sender_id}" data-receiver-name="${message.data.receiver_name}">
                                                    Delete
                                                </button>
                                                <a href="/messages/message_details?receiver_id=${message.data.receiver_id}&sender_owner_id=${message.data.sender_id}" class="btn btn-sm btn-primary ml-2 w-100"><i class="fas fa-eye"></i> View</a>
                                            </div>
                                        </div>
                                        <div class="col-md-8 text-end">
                                            <div class="d-flex gap-2 justify-content-end">
                                                ${isCurrentUserSender ? 'Message to: ' : 'Message from: '}
                                                <div class="message-sender">${message.data.sender_name} (${message.data.sender_email})</div>
                                            </div>
                                            <div class="message-content">${message.data.message_details}</div>
                                            <div class="message-date">${moment(message.data.created_at).calendar()}</div>
                                        </div>
                                        <div class="col-md-2">
                                            <img src="${senderImageUrl}" alt="${message.data.sender_name}" class="img-fluid rounded-circle">
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
    
                        $('#messages-container').append(messageHtml);
                 
                       
                    }
                } else {
                    alert('Error: No more messages to load.');
                }
            }
        });
    }
    

    $('#show-more').on('click', function() {
        offset += limit;
        loadMoreMessages();
    });

    $('#show-more-replies').on('click', function() {
        offset += limit;
        loadAllReplyMessages();
    });


    $(document).on('click', '.delete-all-message', function() {
       
        var receiver_id = $(this).data('receiver-id');
        var owner_id = $(this).data('owner-id');
        var receiverName = $(this).data('receiver-name');

        var confirmMessage = `Are you sure you want to delete this messages? This will delete all your conversations with ${receiverName}.`;

        if (confirm(confirmMessage)) {

            if(owner_id) {
                deleteAllMessages(receiver_id, owner_id);
                return;
            }
            
            deleteAllMessages(receiver_id);
        }
    });

 

    $(document).on('click', '.delete-message', function() {
       
        var messageId = $(this).data('message-id');
        if(confirm("Do you want to delete this message?")) {
                $.ajax({
                    url: "/messages/delete_message/" + messageId,
                    type: 'POST',
                    data: { id: messageId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#message-' + messageId).fadeOut();
                            $('#deleteMessageModal').modal('hide');
                        } else {
                            alert('Failed to delete message.');
                        }
                    },
                    error: function() {
                        alert('Error: Unable to delete message.');
                    }
                });
          

        }else{
            alert("Cancelled deleting message.");
        }
    });
  
  
    function deleteAllMessages(receiver_id, owner_id = null) {
        $.ajax({
            url: owner_id ? `/messages/delete_all_message/${receiver_id}?owner_id=${owner_id}` : `/messages/delete_all_message/${receiver_id}`,
            type: 'POST',
            success: function(response) {
                alert('All messages deleted successfully.');
                loadMoreMessages();
            },
            error: function() {
                alert('Error: Unable to delete all messages.');
            }
        });
        
    }


    function loadAllReplyMessages(){

        $.ajax({
            url: !sender_id ? `/messages/getAll_reply_message/${receiverId}?sender_owner_id=${senderOwnerId}` : `/messages/getAll_reply_message/${receiverId}?sender_id=${sender_id}`,
            type: 'GET',
            data: {
                offset: offset,
                limit: limit
            },
            success: function(response) {
            
                const {success, messages } = JSON.parse(response);
           
                if (success) {
                   

                    if (messages.length === 0) {
                        $('#reply-empty').show(); 
                        $('#show-more-replies').text('Back');
                        $('#message-reply-container').empty();
                        $('#message-reply-container').hide();
                        offset = -1;
                        limit = 2;
                    } else {
                        $('#show-more-replies').text('Show more');
                        $('#message-reply-container').show();
                        $('#reply-empty').hide(); 
                    }

                    if(messages.length < 10){
                        $('#show-more-replies').hide();
                    }
                    
        
                    messages.forEach(function(message) {
                        var messageHtml = `
                            <div class="message-item mb-3" id="message-${message.Message.id}">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="${message.Message.score == 0 ? 
                                            message.Sender.sender_image ?
                                            '/img/uploads/' + message.Sender.sender_image :
                                            '/img/default_image.png'
                                            : message.Receiver.receiver_image ? 
                                            '/img/uploads/' + message.Receiver.receiver_image :
                                            '/img/default_image.png'
                                         }" class="img-thumbnail" alt="Sender Image">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="message-sender" style="opacity:0.70"><strong>${message.Message.score == 0 ? message.Sender.sender_name + ` (${message.Sender.sender_email})` : message.Receiver.receiver_name + ` (${message.Receiver.receiver_email})`}</strong></div>
                                        <div class="message-content mb-2 text text-danger">*${message.Message.message_details}</div>
                                        <div class="message-date text-muted " style="font-size:10px;">${moment(message.Message.created_at).calendar()}</div>
                                    </div>
                                    <div class="col-md-2">
                                        ${message.Message.score == 1 ? `<button type="button" class="btn btn-sm btn-danger delete-message" data-message-id="${message.Message.id}"><i class="fas fa-trash"></i> Delete</button>` : ''}
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        $('#message-reply-container').append(messageHtml); 
                    });
                }
            }
        });


    }

    loadAllReplyMessages();
    loadMoreMessages();


    

  
});