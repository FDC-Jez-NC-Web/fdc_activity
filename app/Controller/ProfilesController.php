<?php
App::uses('AppController', 'Controller');
/**
 * Profiles Controller
 */
class ProfilesController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

	public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'user_profile'; 
    }


	public function welcome() {
	}


	public function profile() {

		debug($this->Auth->user());

		$this->autoRender = false;

		if ($this->request->is('post') && !empty($this->request->data)) {
			$userId = $this->Auth->user('id');
			debug($userId);
			exit;
        
            $token = $this->request->data['User']['token'];

     
            if ($this->User->validateToken($token)) { 
           
                $profileData = array(
                    'Profile' => array(
                        'name' => $this->request->data['Profile']['name'],
                        'birthdate' => $this->request->data['Profile']['birthdate'],
                        'gender' => $this->request->data['Profile']['gender'],
                        'hobby' => $this->request->data['Profile']['hobby'],
                    
                    )
                );
        
                $profileData['Profile']['user_id'] = $this->Auth->user('id'); 
   
                if ($this->Profile->save($profileData)) {
                    if ($this->request->is('ajax')) {
						$response = [
							'success' => true,
							'message' => 'Profile is created successfully.',
						];
						echo json_encode($response);
						return;
					}
                } else {
					$response = [
						'success' => false,
						'message' => 'Failed to create profile. Please, try again.',
					];
					echo json_encode($response);
					
                }

				return;
            } 
			$response = [
                'success' => false,
                'message' => 'Invalid token. Please, try again.',
            ];
			
        }

		$this->render("profile");

	}

	

}
