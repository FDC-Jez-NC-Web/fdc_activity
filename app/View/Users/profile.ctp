<div class="container mt-2 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Profile Form</div>
                <div class="card-body">
                    <div id="validation-messages">
                        <?php
                            if (isset($validationErrors)) {
                                foreach ($validationErrors as $field => $errors) {
                                    foreach ($errors as $error) {
                                        echo '<div class="alert alert-danger">' . $error . '</div>';
                                    }
                                }
                            }
                        ?>
                    </div>

                    <!-- Display Existing Image -->
                    <?php if (!empty($user['User']['image'])): ?>
                        <div id="existingImageSection" class="text-center mb-3">
                            <img id="existingImage" src="/img/uploads/<?php echo $user['User']['image']; ?>" style=" max-width: 200px; height: auto; border-radius:10px;" alt="User Image">
                        </div>
                    <?php endif; ?>

               
                    <!-- Image Preview (Hidden by Default) -->
                    <div class="form-group">
                        <img id="image-preview" src="#" alt="Image Preview" style="display: none; max-width: 100%; height: auto;"/>
                    </div>

                    <!-- User Profile Form -->
                    <?php
                        echo $this->Form->create('User', array('id' => 'profileForm', 'type' => 'file'));
                        echo $this->Form->input('name', array(
                            'label' => 'Name',
                            'default' => $user['User']['name'],
                            'required' => true,
                            'class' => 'form-control mb-2'
                        ));
                        echo $this->Form->input('email', array(
                            'label' => 'Email',
                            'default' => $user['User']['email'],
                            'required' => true,
                            'class' => 'form-control mb-2'
                        ));
                        echo $this->Form->input('birthdate', array(
                            'label' => 'Birthdate',
                            'type' => 'text',
                            'default' => $user['User']['birthdate'],
                            'required' => true,
                            'class' => 'form-control mb-2',
                            'id' => 'birthdate'
                        ));
                    ?>

                    <!-- Gender Selection -->
                    <div class="form-group mb-2">
                        <label>Gender</label>
                        <div class="form-check">
                            <?php
                                echo $this->Form->radio('gender', ['male' => 'Male'], [
                                    'default' => $user['User']['gender'],
                                    'class' => 'form-check-input',
                                    'legend' => false
                                ]);
                            ?>
                        </div>
                        <div class="form-check">
                            <?php
                                echo $this->Form->radio('gender', ['female' => 'Female'], [
                                    'default' => $user['User']['gender'],
                                    'class' => 'form-check-input',
                                    'legend' => false
                                ]);
                            ?>
                        </div>
                    </div>

                
                    <!-- Hobby Input -->
                    <?php
                        echo $this->Form->input('hobby', array(
                            'label' => 'Hobby',
                            'type' => 'textarea',
                            'default' => $user['User']['hobby'],
                            'rows' => 3,
                            'class' => 'form-control mb-2'
                        ));
                    ?>
                        
                    <?php
                        echo $this->Form->input('image', array(
                            'id' => 'image',
                            'label' => 'Upload Image (Max Size: 2MB)',
                            'type' => 'file',
                            'class' => 'form-control-file',
                            'accept' => 'image/*'
                        ));
                    ?>

                    <div class="d-flex justify-content-between">
                        <?php
                            echo $this->Form->submit('Edit Profile', array('class' => 'btn btn-primary mt-3'));
                            echo $this->Form->end();
                        ?>

                
                        <?php
                            echo $this->Html->link('Back to Dashboard', array('controller' => 'users', 'action' => 'dashboard'), array('class' => 'btn btn-secondary mt-3'));
                        ?>
                    </div>
               
                </div>
            </div>
        </div>
    </div>
</div>