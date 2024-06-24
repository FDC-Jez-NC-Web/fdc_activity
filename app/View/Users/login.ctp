<div class="container centered-form mt-5 p-3">

      <?php echo $this->Session->flash(); ?>

    <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'))); ?>
        <h2 class="">Login</h2>
        <p class="opacity-5">Please input all the required fields</p>
        <div class="mb-3">
            <?php echo $this->Form->input('email', array('class' => 'form-control', 'required' => true)); ?>
        </div>
        <div class="mb-3">
            <?php echo $this->Form->input('password', array('class' => 'form-control', 'required' => true)); ?>
        </div>
        <?php echo $this->Form->button('Login', array('type' => 'submit', 'class' => 'btn btn-primary btn-block')); ?>
    <?php echo $this->Form->end(); ?>
</div>
