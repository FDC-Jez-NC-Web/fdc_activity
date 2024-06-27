<div class="container mt-4">
    <h2 class="mb-4 text-center"><?php echo __('Register'); ?></h2>
    <div id="validation-messages"></div>
    <?php echo $this->Form->create('User', array('id' => 'registerForm', 'class' => 'needs-validation', 'novalidate' => true)); ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => 'Name (5-20 characters)', 'required' => true)); ?>
            </div>
            <div class="form-group mb-3">
                <?php echo $this->Form->input('username', array('type' => 'text', 'class' => 'form-control', 'label' => 'Username', 'required' => true)); ?>
            </div>
            <div class="form-group mb-3">
                <?php echo $this->Form->input('email', array('type' => 'email', 'class' => 'form-control', 'label' => 'Email address', 'required' => true)); ?>
            </div>
            <div class="form-group mb-3">
                <?php echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control', 'label' => 'Password', 'required' => true)); ?>
            </div>
            <div class="form-group mb-3">
                <?php echo $this->Form->input('confirm_password', array('type' => 'password', 'class' => 'form-control', 'label' => 'Confirm Password', 'required' => true)); ?>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary"><?php echo __('Register'); ?></button>
                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login')); ?>" class="btn btn-secondary"><?php echo __('Login'); ?></a>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
