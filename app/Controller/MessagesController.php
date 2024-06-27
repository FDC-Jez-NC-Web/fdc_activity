<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 */
class MessagesController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;
    public $uses = array('Message', 'User');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'users_layout'; 
    }

	public function new_message() {
	
	
		$userId = $this->Auth->user('id'); 
		$user = $this->User->findById($userId);
	
		$query = "
            SELECT *
            FROM users
            WHERE users.id != 107 AND users.id NOT IN (
                SELECT usr.id
                FROM users AS usr
                LEFT JOIN messages AS msg ON usr.id = msg.message_receiver_id
                WHERE msg.message_owner_id = 107
            )
            ORDER BY users.username DESC;
        ";

        $usersData = $this->User->query($query);
        $users = array();

   
        foreach ($usersData as $user) {
            $users[$user['users']['id']] = $user['users']['username'];
        }

 
		$this->set(compact('user', 'users'));
		$this->set('title_for_layout', __('Add New Message'));
		$this->render("new_message");
	}


    public function sendMessage() {
        $this->autoRender = false; // Disable rendering of view for AJAX response

        if ($this->request->is('ajax')) {
            // Extract data from AJAX request
            $data = $this->request->data;
            
            // Assuming your form fields are named 'recipientId' and 'messageContent'
            $recipientId = $data['Message']['recipientId'];
            $messageContent = $data['Message']['messageContent'];

            // Prepare data to save
            $message = array(
                'Message' => array(
                    'message_owner_id' => $this->Auth->user('id'), // Assuming you're storing the current user ID as the message owner
                    'message_receiver_id' => $recipientId,
                    'message' => $messageContent,
                )
            );

            // Attempt to save the message
            if ($this->Message->save($message)) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Message sent successfully'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Error sending message',
                    'errors' => $this->Message->validationErrors // Include validation errors if save fails
                );
            }

            // Return JSON response
            echo json_encode($response);
        }
    }

    public function message_details() {

       $receiver_id = $this->request->query('receiver_id');
       $sender_id = $this->request->query('sender_id');
       $sender_owner_id = $this->request->query('sender_owner_id');

       

        $this->set('receiver_id', $receiver_id);
        $this->set('sender_id', $sender_id);
        $this->set('sender_owner_id', $sender_owner_id);
   
    
        $this->set('title_for_layout', __('Message Details'));
        $this->render("message_details");
	}

    public function replyMessage() {
        $this->autoRender = false;
   
        if ($this->request->is('post')) {

            $data = $this->request->data;

            $message_owner = $data['Message']['message_sender_id'];
     
            $message = $data['message'];
            $recipientId = $data['Message']['message_receiver_id'];
        
            if(empty($message_owner)){
           
                $message = array(
                    'Message' => array(
                        'message_owner_id' => $this->Auth->user('id'),
                        'message_receiver_id' => $recipientId,
                        'message' => $message,
                        'score' => 0,
                    )
                );

            }else{
                 
                   $message = array(
                    'Message' => array(
                        'message_owner_id' => $message_owner, 
                        'message_receiver_id' => $recipientId,
                        'message' => $message,
                        'score' => 1,
                      
                    )
                );
            }
        
            if ($this->Message->save($message)) {
                $response = array(
                    'success' => true,
                    'message' => 'Reply sent successfully'
                );
                 return json_encode($response);
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Error sending message',
                );
                return json_encode($response);
              
            }
           
       
        }
   
        
    }

    public function delete_message() {

        $this->autoRender = false; // Disable rendering of view
    
        // Check if it's an AJAX request and the request contains data
        if ($this->request->is('ajax') && $this->request->is('post') && $this->request->data('id')) {
            $messageId = $this->request->data('id');
       

            if ($this->Message->delete($messageId, true)) {
                $response = array(
                    'success' => true,
                    'message' => 'Message deleted successfully.'
                );
            } else {
                $response = array(
                    'success' => false,
                    'message' => 'Failed to delete message.'
                );
            }
    
            // Return JSON response
            echo json_encode($response);
        } else {
            // Handle non-AJAX requests or missing data
            $response = array(
                'success' => false,
                'message' => 'Invalid request.'
            );
    
            // Return JSON response
            echo json_encode($response);
        }

	}

    public function delete_all_message($receiver_id = null) {

        $this->autoRender = false; 

        $sender_owner_id = $this->request->query('owner_id');
        $sender_id = $this->Auth->user('id');
    
        if($sender_owner_id){
            $sender_id = $sender_owner_id;
        }

    
        $sender_id = $this->Auth->user('id');
        $this->Message->deleteAll(array('Message.message_receiver_id' => $receiver_id, 'Message.message_owner_id' => $sender_id), false);

	}

    public function getAll_reply_message($receiver_id = null) {
        $this->autoRender = false; 

        $sender_id = $this->request->query('sender_id');
        $limit = $this->request->query("limit");
        $offset = $this->request->query("offset");

      

        $conditions = array('Receiver.id' => $receiver_id);

        // Add sender_id condition if provided
        if ($sender_id) {
            $conditions['Sender.id'] = $sender_id;
        }


        if($this->request->is('ajax') && $this->request->is('get')) {

            $messages = $this->Message->find('all', array(
                'conditions' => $conditions,
                'order' => array('Message.created_at' => 'DESC'), // Order by creation date in descending order
                'limit' => $limit,
                'offset' => $offset,
                'fields' => array(
                    'Sender.id as sender_id',
                    'Sender.name as sender_name',
                    'Sender.email as sender_email',
                    'Sender.image as sender_image',
                    'Receiver.id as receiver_id',
                    'Receiver.name as receiver_name',
                    'Receiver.email as receiver_email',
                    'Receiver.image as receiver_image',
                    'Message.message as message_details',
                    'Message.created_at',
                    'Message.score',
                    'Message.id'
                ),
                'joins' => array(
                    array(
                        'table' => 'users',
                        'alias' => 'Sender',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Message.message_owner_id = Sender.id'
                        )
                    ),
                    array(
                        'table' => 'users',
                        'alias' => 'Receiver',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Message.message_receiver_id = Receiver.id'
                        )
                    )
                )
            ));
    
            $response = array(
                'success' => true,
                'messages' =>  $messages,
                'user_id' => $this->Auth->user('id')
            );
    
            return json_encode($response);

        }
      
    }
    



}
