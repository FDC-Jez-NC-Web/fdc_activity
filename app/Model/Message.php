<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 * @property MessageOwner $MessageOwner
 * @property MessageReceiver $MessageReceiver
 */
class Message extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
		public $validate = array(
			'message' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Message content is required.',
					'required' => true,
					'allowEmpty' => false,
					// 'last' => true, // Stop validation after this rule
					// 'on' => ['create', 'update'], // Limit validation to 'create' or 'update' operations
				),
			),
			'message_owner_id' => array(
				'numeric' => array(
					'rule' => 'numeric',
					'message' => 'Message owner ID must be numeric.',
					'required' => true,
					'allowEmpty' => false,
					// 'last' => true, // Stop validation after this rule
					// 'on' => ['create'], // Limit validation to 'create' operation
				),
			),
			'message_receiver_id' => array(
				'numeric' => array(
					'rule' => 'numeric',
					'message' => 'Message receiver ID must be numeric.',
					'required' => true,
					'allowEmpty' => false,
					// 'last' => true, // Stop validation after this rule
					// 'on' => ['create'], // Limit validation to 'create' operation
				),
			),
			'score' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Score must be numeric'
            )
        )
			
			
		);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'MessageOwner' => array(
			'className' => 'User',
			'foreignKey' => 'message_owner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MessageReceiver' => array(
			'className' => 'User',
			'foreignKey' => 'message_receiver_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
