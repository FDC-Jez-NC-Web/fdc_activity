<?php
App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');


class UsersController extends AppController {

    public $uses = array('Message', 'User');
    public $layout = 'users_layout';
    public function dashboard()
    {
       
        $this->set('title_for_layout', __('Dashboard'));
        $this->render('dashboard');

    }


    public function getAllMessages() {
        $this->autoRender = false;

        $limit = $this->request->query("limit");
        $offset = $this->request->query("offset");

        if($this->request->is('ajax') && $this->request->is('get')) {
      
            $messages = $this->Message->query("
            WITH MessageDetails AS (
                SELECT
                    sender.id AS sender_id,
                    sender.name AS sender_name,
                    sender.email AS sender_email,
                    sender.image AS sender_image,
                    receiver.id AS receiver_id,
                    receiver.name AS receiver_name,
                    receiver.email AS receiver_email,
                    receiver.image AS receiver_image,
                    m.message AS message_details,
                    m.id AS message_id,
                    m.created_at
                FROM
                    messages m
                LEFT JOIN
                    users sender ON m.message_owner_id = sender.id
                LEFT JOIN
                    users receiver ON m.message_receiver_id = receiver.id
            )
            SELECT
                *
            FROM (
                SELECT
                    *
                FROM
                    MessageDetails md
                WHERE
                    md.receiver_id = '{$this->Auth->user('id')}'
                GROUP BY
                    md.receiver_id

                UNION ALL

                SELECT
                    *
                FROM
                    MessageDetails md
                WHERE
                    md.sender_id = '{$this->Auth->user('id')}'
                GROUP BY
                    md.receiver_id
                ORDER BY created_at DESC
                 LIMIT $limit OFFSET $offset
            ) AS data
        ");


       

    
        $response = array(
            'success' => true,
            'messages' =>  $messages,
            'user_id' => $this->Auth->user('id')
        );

        return json_encode($response);
        }

    }

    public function logout() {
        $this->Session->destroy();
        return $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }
    public function login() {
        $this->autoRender = false;
        if ($this->request->is('post')) { 
            $response = array();
            if ($this->Auth->login()) { 
                $response['success'] = true;
                $response['message'] = 'Account login successfully!';
            } else {
                $response['success'] = false;
                $response['message'] = 'Invalid username or password, try again';
                $response['errors'] = $this->User->validationErrors; 
            }
    
            $this->response->type('json'); 
            echo json_encode($response); 
            return;
        }

        $this->set('title_for_layout', __('Login Form'));
        $this->render("login"); 
    }


    public function profile() {
   
        $userId = $this->Auth->user('id'); 
        $this->User->id = $userId; 
        
        if ($this->request->is('post') || $this->request->is('put')) {
            $fieldsToValidate = ['name', 'email', 'birthdate', 'gender', 'hobby', 'image'];
            $this->User->set($this->request->data); 
         
            if (!empty($this->request->data['User']['image']['tmp_name'])) {
                $file = $this->request->data['User']['image'];
                $uploadPath = WWW_ROOT . 'img' . DS . 'uploads' . DS;
                $filename = $this->_uploadFile($file, $uploadPath);

                if ($filename) {
                    $this->request->data['User']['image'] = $filename;
                } else {
                    $response = array(
                        'success' => false,
                        'message' => 'Failed to upload image.',
                    );
                    echo json_encode($response);
                    return;
                }
            } else {
                unset($this->request->data['User']['image']);
            }
        
            if ($this->User->save($this->request->data, true, $fieldsToValidate)) {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    $response = array('success' => true, 'message' => 'Profile updated successfully.');
                    echo json_encode($response);
                    return;
                } 
            } else {
                if ($this->request->is('ajax')) {
                    $this->autoRender = false;
                    $response = array('success' => true, 'message' => 'Failed to update profile.', 'errors' => $this->User->validationErrors);
                    echo json_encode($response);
                    return;
                } 
            }

            

        }
        
        $user = $this->User->findById($userId);
        $this->set(compact('user'));
        $this->set('title_for_layout', __('Profile'));
        $this->render("profile");
    }
    
    

    private function _uploadFile($file, $uploadPath) {
        App::uses('Folder', 'Utility');
        App::uses('File', 'Utility');
    
        $uploadFolder = new Folder($uploadPath, true, 0777);
        $filename = uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $uploadFile = new File($file['tmp_name']);
        if ($uploadFile->copy($uploadPath . $filename)) {
            return $filename;
        }
        return false;
    }


    
    public function register() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $response = array(
                    'success' => true,
                    'message' => 'Account created successfully!',
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => $this->User->validationErrors
                );
            }

            $this->set(compact('response'));
            $this->set('_serialize', 'response');
            $this->response->type('json');
            echo json_encode($response);
            return;
        }
        

        $this->set('title_for_layout', __('User Registration'));
        $this->render("register");
    }


    public function details() {
        $userId = $this->Auth->user('id'); 
        $user = $this->User->findById($userId);
        $this->set(compact('user'));
        $this->set('title_for_layout', __('details'));
        $this->render("details");
	}

  
    public function thankyou() {
        $this->render('thankyou');
    }

    public function change_email() {
        
        $this->autoRender = false;
        if($this->request->is('post') && $this->request->is('ajax')) {
            $userId = $this->Auth->user('id'); 
            $this->User->id = $userId; 

            if ($this->User->saveField('email', $this->request->data['User']['new_email'])) {
                $response = array(
                   'success' => true,
                   'message' => 'Email changed successfully!',
                );
            } else {
                $response = array(
                   'success' => false,
                   'message' => 'Failed to change email.',
                );
            }

            $this->set(compact('response'));
            $this->set('_serialize', 'response');
            $this->response->type('json');
            echo json_encode($response);
            return;
        }

        $this->render("change_email");
	}

    public function change_password() {

        $this->autoRender = false;

        if ($this->request->is('post') && $this->request->is('ajax')) {
     
            $currentPassword = $this->request->data['User']['current_password'];
            $newPassword = $this->request->data['User']['new_password'];
            $confirmPassword = $this->request->data['User']['confirm_password'];
    
            // Check if new passwords match
            if ($newPassword !== $confirmPassword) {
                $response = array(
                    'success' => false,
                    'message' => 'New passwords do not match.',
                );
                return json_encode($response);
            }
    
            // Load user data
            $userId = $this->Auth->user('id');
            $user = $this->User->findById($userId);
            
            if ($this->Auth->password($currentPassword) === $user['User']['password']) {
                    
                    $user['User']['password'] = $newPassword;
           
                    if ($this->User->save($user, true, ['password'])) {
                        $response = array(
                            'success' => true,
                            'message' => 'Password changed successfully.',
                        );
                        return json_encode($response);
                    } else {
                        $response = array(
                            'success' => false,
                            'errors' => $this->User->validationErrors,
                            'message' => 'Unable to change password. Please try again.',
                        );
                        return json_encode($response);
                    }
                
            } else {
                // Current password is incorrect
                $response = array(
                    'success' => false,
                    'message' => 'Current password is incorrect.',
                );
                return json_encode($response);
            }
        }
        

        $this->render("change_password");

	}

  
/**
 * Scaffold
 *
 * @var mixed
 */
    public $scaffold;
}