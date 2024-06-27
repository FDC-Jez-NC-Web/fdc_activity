<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0 text-uppercase">Change Password</h5>
                </div>
                <div class="card-body">
                   <div id="changePasswordMessage" class="mt-3 mb-3"></div>
                    <?php echo $this->Form->create('User', ['id' => 'changePasswordForm']); ?>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label('current_password', 'Current Password:');
                            echo $this->Form->password('current_password', ['class' => 'form-control', 'required' => true]);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label('new_password', 'New Password:');
                            echo $this->Form->password('new_password', ['class' => 'form-control', 'required' => true]);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label('confirm_password', 'Confirm New Password:');
                            echo $this->Form->password('confirm_password', ['class' => 'form-control', 'required' => true]);
                            ?>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <?php
                            echo $this->Form->button('Change Password', ['type' => 'submit', 'class' => 'btn btn-success ']);
                            echo $this->Form->end();
                            ?>
                             <div class="mt-3 text-center">
                                <?php echo $this->Html->link('Back to Dashboard', ['controller' => 'users', 'action' => 'dashboard'], ['class' => 'btn btn-secondary']); ?>
                            </div>
                        </div>
               
                </div>
            </div>
           
        </div>
    </div>
</div>
