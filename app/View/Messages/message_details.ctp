

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="card-title mb-0 text-uppercase">Message Details</h5>
                </div>
                <div class="card-body">
               
                <?php 
                echo $this->Form->create(null, ['id' => 'replyMessageForm', 'url' => ['controller' => 'messages', 'action' => 'replyMessage']]); ?>
           
                    <div class="form-group">
                        <?php

                        if(empty($sender_id)) {
                            echo $this->Form->hidden('message_receiver_id', ['value' => $receiver_id]);
                            echo $this->Form->hidden('message_sender_id', ['value' => $sender_owner_id]);
                        }else{
                            echo $this->Form->hidden('message_receiver_id', ['value' => $receiver_id]);
                        }
                        echo $this->Form->label('message', 'Reply Message:' , ['class' => 'form-label'  ]  );
                        echo $this->Form->textarea('message', ['class' => 'form-control', 'rows' => '5', 'name' => 'message', 'id' => 'message'  ]);
                        ?>
                    </div>
                    <?php
                    echo $this->Form->button('SEND REPLY', ['type' => 'submit', 'class' => 'btn btn-success mt-2 w-100']);
                    echo $this->Form->end();
                    ?>
                  

                <div id="reply-empty" class="text-center mt-5 mb-5" >
                        <p>No messages found.</p>
                </div>

                <div class="message-list mt-4" id="message-reply-container">
                  
                    <!-- Show more button -->
                  
                </div>
               

                <div class="d-flex justify-content-between">
                    <div class="text-center ">
                            <button id="show-more-replies" class="btn btn-success">Show More</button>
                    </div>
    
                    <!-- Back Button to Dashboard -->
                    <div class="btn btn-secondary btn-sm">
                            <?php echo $this->Html->link('Back to Dashboard', ['controller' => 'users', 'action' => 'dashboard'], ['class' => 'btn btn-secondary']); ?>
                    </div>

                </div>

                </div>
            </div>
        </div>
    </div>
</div>
