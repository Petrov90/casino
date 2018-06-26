<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\View\View;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 */
class MessagesController extends AppController
{

	
	public $components = ['Paginator'];
	
   function getMessage($type='inbox'){
		$userId		=	$this->Auth->user('id');		
		$query 		= 	$this->{$this->modelClass}->find()->notMatching('MessageDeletes', function($q) use ($userId) { return $q->where(["MessageDeletes.user_id" => $userId]); });
		if($type == 'inbox'){
			$sender	=	'Senders';
		}else{
			$sender	=	'Receivers';
		}
		$this->paginate = [
			'sortWhitelist' => ['id','full_name','message','created'],
			'contain' => [
				'MessageReads' => ['conditions' => ['MessageReads.user_id' => $userId]],
				$sender	=>	['fields' => ['full_name','city','profile_image','facebook_id','slug','email']]
			],
			'limit' => 6,
			'order' => ['id' =>  'desc']
		];
		if($type == 'sent'){
			$query->where(['sender_id' => $userId]);			
		}else{
			$query->where(['receiver_id' => $userId]);
		}
	    $allMessage	 = $this->paginate($query);
				
		$count	=	$this->{$this->modelClass}->find('all')
					->where(['receiver_id' => $userId])
					->notMatching('MessageReads', function($q) use ($userId) { return $q->where(["MessageReads.user_id" => $userId]); })
					->notMatching('MessageDeletes', function($q) use ($userId) { return $q->where(["MessageDeletes.user_id" => $userId]); })
					->count();
		
		$data['success']	=	true;		
		$view 				= 	new View();
		$view->viewPath		=	'Element';
		$view->layout		=	false;
		$Defaultlanguage	=	$this->request->session()->read('Config.language');
		
		$view->set (compact('Defaultlanguage','allMessage','type','count')); 
		$html				=	$view->render('message_list');			
		$data['data']		=	$html;
		$data['count']		=	$count;
		
		echo json_encode($data);
		exit;
    
	}
	
	function messageView($id,$type = 'inbox'){
		$userId		=	$this->Auth->user('id');
		
		if($type == 'sent'){
			$messageDetails	 = $this->{$this->modelClass}->find('all')
					->contain(['Senders' => ['fields' => ['full_name','city','profile_image','facebook_id','slug','email']]])
					->where(['Messages.id' => $id,'Messages.sender_id' => $userId])
					->first();
		}else{
			$messageDetails	 = $this->{$this->modelClass}->find('all')
					->contain(['Senders' => ['fields' => ['full_name','city','profile_image','facebook_id','slug','email']]])
					->where(['Messages.id' => $id,'Messages.receiver_id' => $userId])
					->first();
			
			$this->loadModel('MessageReads');
			$messageReads	=	$this->MessageReads->find('all')->where(['user_id' => $userId,'message_id' => $id])->first();
			
			if (empty($messageReads)){
				 $message = $this->MessageReads->newEntity();
				 $message->user_id	=	$userId;
				 $message->message_id	=	$id;
				 $this->MessageReads->save($message);
			}			
			$count	=	$this->{$this->modelClass}->find('all')->where(['receiver_id' => $userId])->notMatching('MessageReads', function($q) use ($userId) { return $q->where(["MessageReads.user_id" => $userId]); })->count();
			
			$data['count']	=	$count-1;		
		}
		
		$data['success']	=	true;		
		$view 				= 	new View();
		$view->viewPath		=	'Element';
		$view->layout		=	false;
		$Defaultlanguage	=	$this->request->session()->read('Config.language');
		
		$view->set (compact('Defaultlanguage','messageDetails')); 
		$html				=	$view->render('message_view');			
		$data['data']		=	$html;
		
		echo json_encode($data);
		exit;
    
	}
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
			if($message->errors()){
				$data['errors']		=	$this->json_error($message->errors());
				$data['success']	=	false;
				$data['message']	=	__('Message could not be saved. Please try again',true);
				echo json_encode($data);
				exit;
			}
			$message->sender_id		=	$this->Auth->user('id');
            if ($this->Messages->save($message)) {
               
				$data['message']	=	 __('Message has been sent',true);
				$data['success']	=	true;
				echo json_encode($data);
				exit;
            }
        }
		exit;
    }
	
	/**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function messageSent()
    {
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
            $message = $this->Messages->patchEntity($message, $this->request->data);
			if($message->errors()){
				$data['errors']		=	$this->json_error($message->errors());
				$data['success']	=	false;
				$data['message']	=	__('Message could not be saved. Please try again',true);
				echo json_encode($data);
				exit;
			}
			$message->sender_id		=	$this->Auth->user('id');
            if ($this->Messages->save($message)) {               
				$data['message']	=	 __('Message has been sent',true);
				$data['success']	=	true;
				echo json_encode($data);
				exit;
            }
        }
		exit;
    }


    /**
     * Delete method
     *
     * @param string|null $id Message id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($type)
    {
        $this->request->allowMethod(['post']);
		$data		=	$this->request->data['delete'];
		if(!empty($data)){
			$userId		=	$this->Auth->user('id');
			if($type == 'unread'){
				$this->loadModel('MessageReads');			
				foreach($data as $id){
					$messageReads	=	$this->MessageReads->find('all')->where(['user_id' => $userId,'message_id' => $id])->first();
					$this->MessageReads->delete($messageReads);

				}
			}else{
				$this->loadModel('MessageDeletes');			
				foreach($data as $id){
					$messageDeletes	=	$this->MessageDeletes->find('all')->where(['user_id' => $userId,'message_id' => $id])->first();
					if(empty($messageDeletes)){
						$message = $this->MessageDeletes->newEntity();
						$message->user_id		=	$userId;
						$message->message_id	=	$id;
						$this->MessageDeletes->save($message);
					}
				}
			}
		}
		exit;
    }
}
