<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Name cannot be empty',
				'required' => true,
			),
		),
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Username cannot be empty',
				'required' => true,
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please provide a valid email address',
				'required' => true,
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'This email is already in use',
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Password cannot be empty',
				'required' => true,
			),
			'minLength' => array(
				'rule' => array('minLength', '6'),
				'message' => 'Password must be at least 6 characters long',
			),
		),
		'confirm_password' => array(
			'compare' => array(
				'rule' => array('comparePasswords', 'password'),
				'message' => 'Passwords do not match',
			),
		),
		'image' => array(
			'extension' => array(
				'rule' => array('extension', array('jpg', 'jpeg', 'gif', 'png')),
				'message' => 'Please upload valid image file (jpg, jpeg, gif, png)',
			
			),
		),
		'gender' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Gender cannot be empty',
				'required' => false,
			),
		),
		'birthdate' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Birthdate cannot be empty',
				'required' => false,
			),
			'date' => array(
				'rule' => array('date'),
				'message' => 'Please enter a valid date',
			),
		),
		'hobby' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Hobby cannot be empty',
				'required' => false,
			),
		)
	);




	public function beforeSave($options = array()) {
        if (!empty($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password(
                $this->data[$this->alias]['password']
            );
        }
        if (isset($this->data[$this->alias]['confirm_password'])) {
            $this->data[$this->alias]['confirm_password'] = AuthComponent::password(
                $this->data[$this->alias]['confirm_password']
            );
        }
        // Set date_created and date_updated
        if (empty($this->data[$this->alias]['date_created'])) {
            $this->data[$this->alias]['date_created'] = date('Y-m-d H:i:s');
        }
        $this->data[$this->alias]['date_updated'] = date('Y-m-d H:i:s');
		
        return true;
    }

	public function comparePasswords($checkPassword, $passwordFieldName) {
        if (is_array($checkPassword)) {
            $confirmPassword = current($checkPassword);
        } else {
            $confirmPassword = $checkPassword;
        }
        $enteredPassword = $this->data[$this->alias][$passwordFieldName];
        return $confirmPassword === $enteredPassword;
    }

}
