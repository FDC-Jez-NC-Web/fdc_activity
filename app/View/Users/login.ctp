<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">
                <div id="validation-messages"></div>
                <?php echo $this->Form->create('User', array(
                    'id' => 'loginForm',
                    'url' => array('controller' => 'users', 'action' => 'login'),
                    'class' => 'needs-validation',
                    'novalidate' => true
                )); ?>
                    <h2 class="text-center text-uppercase mb-4">Login</h2>
                    <p class="text-center opacity-75 text-sm mb-4">Please input all the required fields</p>
                    <div class="form-group mb-3">
                        <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email', 'required' => true, 'label' => false)); ?>
                    </div>
                    <div class="form-group mb-3">
                        <?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password', 'required' => true, 'label' => false)); ?>
                    </div>
                    <div class="d-grid">
                        <?php echo $this->Form->button('Login', array('type' => 'submit', 'class' => 'btn btn-primary btn-block')); ?>
                    </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
