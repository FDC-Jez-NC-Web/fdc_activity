<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white text-uppercase font-weight-bold">User Profile</div>
        <div class="card-body">
            <?php
                // Build avatar URL
                if (!empty($user['User']['image'])) {
                    $avatarUrl = '/img/uploads/' . $user['User']['image']; 
                } else {
                    $avatarUrl = '/img/default_image.png';
                }
            ?>
            <img class="profile-picture mx-auto d-block mb-3" src="<?php echo htmlspecialchars($avatarUrl); ?>" alt="Profile Picture">
            
            <!-- Bootstrap-styled details items -->
            <div class="row details-item justify-content-center">
                <div class="col-sm-3 font-weight-bold text-right details-label">Name:</div>
                <div class="col-sm-9"><?php echo htmlspecialchars($user['User']['name']); ?></div>
            </div>
            <div class="row details-item justify-content-center">
                <div class="col-sm-3 font-weight-bold text-right details-label">Email:</div>
                <div class="col-sm-9"><?php echo htmlspecialchars($user['User']['email']); ?></div>
            </div>
            <div class="row details-item justify-content-center">
                <div class="col-sm-3 font-weight-bold text-right details-label">Birthdate:</div>
                <div class="col-sm-9"><?php echo htmlspecialchars($user['User']['birthdate']); ?></div>
            </div>
            <div class="row details-item justify-content-center">
                <div class="col-sm-3 font-weight-bold text-right details-label">Gender:</div>
                <div class="col-sm-9"><?php echo htmlspecialchars($user['User']['gender']); ?></div>
            </div>
            <div class="row details-item justify-content-center">
                <div class="col-sm-3 font-weight-bold text-right details-label">Hobby:</div>
                <div class="col-sm-9"><?php echo htmlspecialchars($user['User']['hobby']); ?></div>
            </div>

            <div class="d-flex justify-content-between">
                <!-- Edit Profile Button -->
                <div class="d-flex justify-content-end mt-4">
                    <?php
                        echo $this->Html->link('Edit Profile', array('controller' => 'Users', 'action' => 'profile'), array('class' => 'btn btn-success'));
                    ?>
                </div>
    
                <!-- Back to Dashboard Button -->
                <div class="text-center mt-3">
                    <a href="/users/dashboard" class="btn btn-primary ">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
