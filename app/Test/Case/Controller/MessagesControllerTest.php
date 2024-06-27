<?php
App::uses('MessagesController', 'Controller');

/**
 * MessagesController Test Case
 */
class MessagesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.message',
		'app.message_owner',
		'app.message_receiver'
	);

}
