<?php
App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');


class UsersController extends AppController {
  
    public $layout = 'new_layout';
    public function first()
    {
        $this->render('dashboard');
    }
    public function logout() {
        $this->Session->destroy();
        return $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }
    public function login() {

        if ($this->request->is('post')) {
           
            $email = $this->request->data['User']['email'];
            $password = $this->request->data['User']['password'];

            $user = $this->User->find('first', array(
                'conditions' => array('User.email' => $email)
            ));
        
            if ($user && $this->Auth->password($password) === $user['User']['password']) {
                debug($user['User']);
                $this->Auth->login($user['User']);
                $this->Session->setFlash(__('Login successful.'));
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                // Invalid credentials
                $this->Session->setFlash(__('Invalid username or password, please try again.'));
            }
           
        }
    }
    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                return $this->redirect(array('action' => 'thankyou'));
            } else {
                $this->set('errors', $this->User->validationErrors);
            }
        }
        $this->set('title_for_layout', __('User Registration'));
    }
    public function view_profile() {
        $userId = $this->Auth->user('id');
        pr($userId);
        // Fetch user data from the User table based on the user's ID
        $userData = $this->User->findById($userId);
        // Check if user data was found
        if (!$userData) {
            throw new NotFoundException(__('Invalid user'));
        }
        // Pass user data to the view
        $this->set('user', $userData);
    }
    public function thankyou() {
        $this->render('thankyou');
    }
    public function edit() {
        $userId = $this->Auth->user('id');
        pr($userId);
        if (!$userId) {
            pr('ERROR');
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            pr('ERROR');
            $this->request->data['User']['id'] = $userId;
            // Attempt to save the user data
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Your profile has been updated.'));
                return $this->redirect(array('action' => 'view_profile'));
            } else {
                pr($this->User->validationErrors);
                $this->Flash->error(__('Unable to update your profile.'));
            }
        } else {
            // Fetch user data to populate the form
            $this->request->data = $this->User->findById($userId);
            if (!$this->request->data) {
                throw new NotFoundException(__('Invalid user'));
            }
        }
    }
/**
 * Scaffold
 *
 * @var mixed
 */
    public $scaffold;
}