<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\View\View;
use App\Controller\Component\Sanitize;
use Cake\Core\Configure;

use Cake\Event\Event;
/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 */
class QuestionsController extends AppController
{

	
	public function beforeFilter(Event $event)
    {
		
        parent::beforeFilter($event);
        $this->Auth->allow(array('index'));
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		
       if(!empty($this->request->data)){
		   
			$type				=	isset($this->request->data['type']) ? $this->request->data['type'] : '';
			$name				=	$this->request->data['name'];
			$foreign_key		=	isset($this->request->data['foreign_key']) ? $this->request->data['foreign_key'] : '';
			$count				=	$this->request->data['count'];
			$avg_rating			=	isset($this->request->data['avg_rating']) ? $this->request->data['avg_rating'] : '';
			$key	=	'Questions.like_count';
			$val	=	'DESC';
			$sort_by	=	'';
			if(isset($this->request->data['sort_by'])){
				$sort_by		=	 $this->request->data['sort_by'];
				if($sort_by == SORT_MOST_RELEVANT){
					$key	=	'Questions.like_count';
					$val	=	'DESC';
				}else if ($sort_by == SORT_EVALUTION){
					$key	=	'Questions.rating';
					$val	=	'DESC';
				}else if ($sort_by == SORT_DATE){
					$key	=	'Questions.created';
					$val	=	'DESC';
				}else if ($sort_by == SORT_LANGUAGE){
					$key	=	'Questions.language';
					$val	=	'DESC';
				}			
			}
			
			
			$this->loadModel('Questions');
			$userId	=	$this->Auth->user('id');
			$maintype	=	($type != 'news') ? 'question' : $type;
			// pr($type);
			$reviewList	=	$this->Questions->find('all')->contain([
					'Users' => ['fields' => ['id','full_name','city','profile_image','facebook_id','slug','sex']],
					'QuestionLikes' => ['conditions' => ['QuestionLikes.user_id' => $userId,'QuestionLikes.maintype' => $maintype]],
					'QuestionComments',
					'QuestionComments.QuestionCommentLikes'  => ['conditions' => ['QuestionCommentLikes.user_id' => $userId,'QuestionCommentLikes.maintype' => $maintype]],
					'QuestionComments.Users' => ['fields' => ['full_name','city','profile_image','facebook_id','slug','sex']] 
				])
				  ->where(['type' => $type,'foreign_key' => $foreign_key])
				  ->order([$key => $val]);
					
			$data['success']	=	true;		
			$view 				= 	new View();
			$view->viewPath		=	'Questions';
			$view->layout		=	false;
			$Defaultlanguage	=	$this->request->session()->read('Config.language');
			
			$this->loadModel('Masters');
			$reportAsSpam = $this->Masters->find('list')
				->where([
					'Masters.type' => 'report_as_spam','is_deleted' => 0
				])->all()->toArray();
		
					
			
			$view->set (compact('Defaultlanguage','type','name','count','avg_rating','reviewList','sort_by','foreign_key','reportAsSpam')); 
			$html				=	$view->render('index');			
			$data['data']		=	$html;
			
			echo json_encode($data);
		}	
		exit;
	}

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => ['Users', 'QuestionComments']
        ]);

        $this->set('question', $question);
        $this->set('_serialize', ['question']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $question = $this->Questions->newEntity();
        if ($this->request->is('post')) {
			$this->request->data 	=	$this->sanitizeData($this->request->data);

            $question = $this->Questions->patchEntity(
											$question, 
											$this->request->data, 
											[ 'validate' => 'addReviewForm']
										);
			if($question->errors()){
				$data['errors']		=	$this->json_error($question->errors());
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			$question->user_id	=	$userId	=	$this->Auth->user('id');
			$type				=	$this->request->data['type'];
			
				
			$Defaultlanguage		=	$this->request->session()->read('Config.language');			
			
			$question->language	=	$Defaultlanguage;
			$this->Questions->save($question);
			
            $data['message']	=	__('Thanks for your valuable review.',true);
			$data['success']	=	true;
			echo json_encode($data);
			if($type == 'news'){
				$this->Flash->success(__('Thanks for your comment.'));				
			}else{
				$this->Flash->success(__('Thanks for your question.'));				
			}
			exit;
        }
    }
	
	
	function listAllAnswer(){
		$userId			=	$this->Auth->user('id');
		if ($this->request->is('post')) {
			$id		=	$questionId		=	$this->request->data['question_id'];
			$this->loadModel('QuestionComments');
			$allComments	=	$this->QuestionComments->find('all')->contain([
				'Users' => ['fields' => ['full_name','city','profile_image','facebook_id','slug','sex']],
				'QuestionCommentLikes'  => ['conditions' => ['QuestionCommentLikes.user_id' => $userId]]
				])->where(['question_id' => $id]);
			
			$data['success']	=	true;			
			$view 				= 	new View();
			$view->viewPath		=	'Questions';
			$view->layout		=	false;
			
			$Defaultlanguage	=	$this->request->session()->read('Config.language');

			$view->set (compact('Defaultlanguage','allComments','questionId')); 
			$html				=	$view->render('list_all_answer');			
			$data['id']			=	$id;
			$data['data']		=	$html;
			
			echo json_encode($data);
		}
		exit;
	}
	
	function addAnswerComment(){		
        $question = $this->Questions->newEntity();
        if ($this->request->is('post')) {
			$this->request->data 	=	$this->sanitizeData($this->request->data);

            $question = $this->Questions->patchEntity(
											$question, 
											$this->request->data, 
											[ 'validate' => 'addCommentForm']
										);
										
			if($question->errors()){
				$data['errors']		=	$this->json_error($question->errors());
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			$Defaultlanguage	=	$this->request->session()->read('Config.language');

			$userId			=	$this->Auth->user('id');
			$id				=	$this->request->data['question_id'];
			$comment		=	$this->request->data['answer_comment'];
			$this->loadModel('QuestionComments');			
			$review	 			= 	$this->QuestionComments->newEntity();				
			$review->user_id	=	$userId;
			$review->question_id=	$id;
			$review->comment	=	$comment;			
			$review->language	=	$Defaultlanguage;		
			$this->QuestionComments->save($review);
			$id			= $questionId		=	$review->id;
			
			$comments			=	$this->QuestionComments->find('all')->contain([
					'QuestionCommentLikes'  => ['conditions' => ['QuestionCommentLikes.user_id' => $userId]],
					'Users' => ['fields' => ['full_name','city','profile_image','facebook_id','slug','sex']]
					])->where(['QuestionComments.id' => $id])->first();
			
			$data['success']	=	true;
			if($this->request->data['type'] == 'news'){
				$data['message']	=	'Thanks for your valuable comment.';				
			}else{
				$data['message']	=	'Thanks for your valuable answer.';								
			}
			
			$view 				= 	new View();
			$view->viewPath		=	'Questions';
			$view->layout		=	false;
			
			$view->set (compact('Defaultlanguage','comments','questionId')); 
			$html				=	$view->render('ansewer_comment');			
			$data['id']			=	$id;
			$data['data']		=	$html;
			
			echo json_encode($data);
        }
            exit;
	}

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Questions->patchEntity($question, $this->request->data);
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The question could not be saved. Please, try again.'));
            }
        }
        $users = $this->Questions->Users->find('list', ['limit' => 200]);
        $this->set(compact('question', 'users'));
        $this->set('_serialize', ['question']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $this->request->allowMethod(['post', 'delete']);
		if(empty($this->request->data['id']) || empty($this->request->data['type'])){
			$data['errors']		=	'Something going wrong';
			$data['success']	=	false;
			echo json_encode($data);
			exit;
		}
		
		$id		 = $this->request->data['id'];
		$type 	 = $this->request->data['type'];
		if($type == 'question'){			
			$question = $this->Questions->find('all')->where(['id' => $id,'user_id' => $this->Auth->user('id')])->first();
			
			if(empty($question->id)){
				$data['errors']		=	'Something going wrong';
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			$this->Questions->delete($question);
			
		}else{
			$this->loadModel('QuestionComments');			
			$question = $this->QuestionComments->find('all')->where(['id' => $id,'user_id' => $this->Auth->user('id')])->first();
			$questionId = $question->question_id;
			if(empty($question->id)){
				$data['errors']		=	'Something going wrong';
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}			
			$this->QuestionComments->delete($question);


		}
		$data['message']	=	($type == 'questions') ? 'Question deleted successfully' : 'Answer deleted successfully';
		$data['success']	=	true;
		echo json_encode($data);
		exit;
    }
	
	 /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function update()
    {
        $this->request->allowMethod(['post']);
		if(empty($this->request->data['id']) || empty($this->request->data['type']) || empty($this->request->data['value'])){
			$data['errors']		=	'Something going wrong';
			$data['success']	=	false;
			echo json_encode($data);
			exit;
		}
		
		$id		 = $this->request->data['id'];
		$type 	 = $this->request->data['type'];
		$value 	 = $this->request->data['value'];
		if($type == 'questions'){			
			$question = $this->Questions->find('all')->where(['id' => $id,'user_id' => $this->Auth->user('id')])->first();
			
			if(empty($question->id)){
				$data['errors']		=	'Something going wrong';
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			$question->comment	=	$value;
			$this->Questions->save($question);
		}else{
			$this->loadModel('QuestionComments');			
			$question = $this->QuestionComments->find('all')->where(['id' => $id,'user_id' => $this->Auth->user('id')])->first();
			$questionId = $question->question_id;
			if(empty($question->id)){
				$data['errors']		=	'Something going wrong';
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			
			$question->comment	=	$value;
			$this->QuestionComments->save($question);
		}
		$data['message']	=	($type == 'questions') ? 'Information updated successfully' : 'Information updated successfully';
		$data['success']	=	true;
		$data['value']		=	nl2br($value);
		echo json_encode($data);
		exit;
    }
	
	 public function questionlikes()
    {
		if ($this->request->is('post')) {
			$value				=	$this->request->data['value'];
			$id					=	$this->request->data['id'];
			$type				=	$this->request->data['type'];
			$maintype			=	($this->request->data['maintype'] != 'news')  ? 'question' : $this->request->data['maintype'];
			$userId				=	$this->Auth->user('id');
			if($type == 'question'){
				$this->loadModel('QuestionLikes');
				$QuestionLikes = $this->QuestionLikes->find('all')->where(['question_id' => $id,'user_id' => $userId])->first();
				if(!empty($QuestionLikes->id)){
					$this->QuestionLikes->delete($QuestionLikes);
				}
				$review	 			= 	$this->QuestionLikes->newEntity();					
				$review->user_id	=	$userId;
				$review->question_id=	$id;
				$review->value		=	$value;
				$review->maintype		=	$maintype;
				$this->QuestionLikes->save($review);			
			
				$reviewCount		=	$this->Questions->get($id);
				
				$data['like_count']			=	$reviewCount->like_count;
				$data['dislike_count']		=	$reviewCount->dislike_count;
			}else{
					
				$this->loadModel('QuestionCommentLikes');
				$this->loadModel('QuestionComments');
				$QuestionCommentLikes = $this->QuestionCommentLikes->find('all')->where(['question_comment_id' => $id,'user_id' => $userId])->first();
				if(!empty($QuestionCommentLikes->id)){
					$this->QuestionCommentLikes->delete($QuestionCommentLikes);
				}
				$review	 			= 	$this->QuestionCommentLikes->newEntity();					
				$review->user_id	=	$userId;
				$review->question_comment_id	=	$id;
				$review->value		=	$value;
				$review->maintype		=	$maintype;
				$this->QuestionCommentLikes->save($review);			
			
				$reviewCount		=	$this->QuestionComments->get($id);
				
				$data['like_count']			=	$reviewCount->like_count;
				$data['dislike_count']		=	$reviewCount->dislike_count;
			}
			$data['success']			=	true;
			echo json_encode($data);				
		}
		exit;	
	}
	
	
	function reportAsSpam(){
		$this->loadModel('QuestionSpams');
		$user = $this->QuestionSpams->newEntity();
		if ($this->request->is('post')) {
			$this->request->data 	=	$this->sanitizeData($this->request->data);

			$user = $this->QuestionSpams->patchEntity(
											$user, 
											$this->request->data, 
											[ 'validate' => 'reportAsSpam']
										);
			if($user->errors()){
				$data['errors']		=	$this->json_error($user->errors());
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			
			$user_id			=	$this->Auth->user('id');
			$foreign_key		=	$this->request->data['foreign_key'];
			$type				=	$this->request->data['type'];
			
			$res 				=	$this->QuestionSpams->find('all')->where(['user_id' => $user_id,'foreign_key' => $foreign_key,'type' => $type])->first();
			if(!empty($res->id)){
				$user->id		=	$res->id;				
			}
			
			$user->user_id		=	$user_id;
			$user->foreign_key	=	$foreign_key;
			
			$this->QuestionSpams->save($user);
			
			$data['message']	=	__('We have received your request for this review.We will check this review soon.',true);
			$data['success']	=	true;
			echo json_encode($data);
            
			exit;
        }
		exit;
	}
}
