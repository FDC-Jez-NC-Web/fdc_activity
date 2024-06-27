<!-- navbar.ctp -->

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/users/dashboard">CAKE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <?php if ($this->Session->check('Auth.User.id')): ?>
                    <li class="nav-item d-flex align-items-center">
                        <span class="nav-link">Welcome, <?php echo h($this->Session->read('Auth.User.username')); ?></span>
                    </li>
                  
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Settings
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nav-item">
                                <?php echo $this->Html->link('Profile', array('controller' => 'users', 'action' => 'details'), array('class' => 'dropdown-item')); ?>
                            </li>
                            <li class="nav-item">
                                <?php echo $this->Html->link('Change password', array('controller' => 'users', 'action' => 'change_password'), array('class' => 'dropdown-item')); ?>
                            </li>
                            <li class="nav-item">
                                <?php echo $this->Html->link('Change email', array('controller' => 'users', 'action' => 'change_email'), array('class' => 'dropdown-item')); ?>
                            </li>
                        </ul>
                        </li>
                    <li class="nav-item">
                        <?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'), array('class' => 'nav-link')); ?>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'), array('class' => 'nav-link')); ?>
                    </li>
                    <li class="nav-item">
                        <?php echo $this->Html->link('Register', array('controller' => 'users', 'action' => 'register'), array('class' => 'nav-link')); ?>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
