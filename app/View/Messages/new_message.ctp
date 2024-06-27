<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Message</div>
                <div class="card-body">
                    <?php echo $this->Form->create(null, ['id' => 'sendMessageForm', 'url' => ['controller' => 'messages', 'action' => 'sendMessage']]); ?>
                    <div class="form-group mb-2">
                        <?php
                        echo $this->Form->label('recipientId', 'Recipient:');
                        echo $this->Form->select('recipientId', $users, ['class' => 'form-control js-example-templating', 'id' => 'recipientId']);
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo $this->Form->label('messageContent', 'Message:');
                        echo $this->Form->textarea('messageContent', ['class' => 'form-control', 'rows' => '5']);
                        ?>
                    </div>
                    <div class="d-flex justify-content-between">
                        <?php
                        echo $this->Form->button('Send Message', ['type' => 'submit', 'class' => 'btn btn-primary mt-2']);
                        echo $this->Form->end();
                        ?>
                        <div class="mt-3">
                            <?php echo $this->Html->link('Back to Dashboard', ['controller' => 'users', 'action' => 'dashboard'], ['class' => 'btn btn-secondary']); ?>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>
