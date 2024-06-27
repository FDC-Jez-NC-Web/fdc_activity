<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0 text-uppercase">Change Email</h5>
                </div>
                <div id="changeEmailMessage" class="mt-3"></div>
                <div class="card-body">
                    <?php echo $this->Form->create('User', ['id' => 'changeEmailForm']); ?>
                        <div class="form-group">
                            <?php
                            echo $this->Form->label('new_email', 'New Email:');
                            echo $this->Form->email('new_email', ['class' => 'form-control', 'required' => true]);
                            ?>
                        </div>
                        <div class="d-flex justify-content-between">
                            <?php
                            echo $this->Form->button('Change Email', ['type' => 'submit', 'class' => 'btn btn-primary mt-2']);
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
