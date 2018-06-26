<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Session\DatabaseSession;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\View\View;
use Cake\Core\Configure;
use Cake\Cache\Cache;
use Cake\Network\Exception\NotFoundException;

class UsersController extends AppController
{
	
	// public $components = ['Cache.Cache'];
	
	public function initialize()
    {//sleep(100);
      parent::initialize();
      $this->loadComponent('Captcha');
      $this->loadComponent('Cookie');
	  
	 /*   $this->loadComponent('Cache.Cache', [
        'actions' => ['index', 'view' => DAY, 'index' => HOUR]
		]); */
    }
	
	function captcha()	{
        $this->autoRender = false;
		 $this->viewBuilder()->layout('ajax');
        $this->Captcha->create();
	}
	
	public function beforeFilter(Event $event)
    {
		parent::beforeFilter($event);
        $this->Auth->allow(array('locations','index','contactUs','promotion','addReview','changeLang','cms','cityView','cmsSlug','cronFunction','login','signup','cityAutocomplete','casinoSearch','test11','fbsignup','Facebook','countryView','facebook2','userSlug','follow','forgotPassword','resetPassword','getReviews','topUsers','newReviews','captcha','guide','article','guideView','continenent','africa','asia','europe','northAmericaAndCaribbean','southAmerica','australia','casinoName','listfollow'));
    }

    public function index(){
		/* if (($sliders = Cache::read('sliders','longlong')) === false) { */
			$this->loadModel('Slider.Sliders');
			$sliders = $this->Sliders->find('translations')->all()->toList();
			Cache::write('sliders', $sliders,'longlong');
		/* } */
		/* $this->set('shareImage',SLIDER_IMG_URL.$sliders[0]->image); */
		
		/* if (($allBlocks = Cache::read('allBlocks','longlong')) === false) { */
			$this->loadModel('Block.Blocks');
			$allBlock = $this->Blocks->find('translations')->where(['Blocks.id IN (3,4,5,6,7,8,25)'])->toList();
			foreach($allBlock as $a){
				$allBlocks[$a->id]	=	$a;
			}			
			Cache::write('allBlocks', $allBlocks,'longlong');
		/* } */
		/* if (($promotions = Cache::read('promotions','longlong')) === false) { */
			$this->loadModel('Promotion.Promotions');
			$promotions 			= 	$this->Promotions->find('all')
				->where(['isfeat' => 1])
				->contain([
					'Casino' => ['fields' => ['slug','id','image','title','payout_percentage','avg_rating']]
				])->limit(5)->order('rand()')->toList();
			// Cache::write('promotions', $promotions,'longlong');
		/* } */
		
		 /* if (($reviewList = Cache::read('reviewList','longlong')) === false) { */
			$reviewList	=	$this->reviewList('limit');
			Cache::write('reviewList', $reviewList,'longlong');
		/* } */
		
		/* if (($popularCasinos = Cache::read('popularCasinos','longlong')) === false) { */
			$this->loadModel('Promotion.PopularCasinos');
			$popularCasinos = $this->PopularCasinos->find('all')->contain(['Casinos' => ['fields' => ['slug','type']],'Casinos.City' => ['fields' => ['name']] ])->where(['isfeat' => 1])->limit(8)->order('rand()')->toList();
			/* Cache::write('popularCasinos', $popularCasinos,'longlong'); */
		/* } */
		
		$worldPopularCasino			=	$this->casinoByContinent();
		
		$pageTitle			=	__('title.homepage');
		$metaDescription	=	__('metadescription.homepage');
		$this->set(compact('sliders','promotions','reviewList','popularCasinos','allBlocks','pageTitle','metaDescription','continents','worldPopularCasino'));
    }
	
	function casinoByContinent(){
		$this->loadModel('CityManager.Continents');
		$worldPopularCasino			=	$this->Continents->find('all')->contain(['Casinos' => ['conditions' => ['is_feature' => 1],'fields' => ['title','continent_id','slug']]])->all();
		return $worldPopularCasino;
	}
	
	public function locations(){
		/* ini_set('memory_limit','-1');  */
		$this->loadModel('Category.Categories');	
		$headBlock	 =	 $this->Categories->find('translations')->where(['Categories.id' => 74])->first();
		
		$this->loadModel('CityManager.LanPageCity');	
		$cities		=	$this->LanPageCity->find('all')->contain(['Cities' => ['fields' => ['slug','review_count','title']]])->order(['LanPageCity.id' => 'asc'])->toArray();
		
		$this->loadModel('CityManager.Continents');	
		$Continents		=	$this->Continents->find('translations')->order(['Continents.order_by' => 'asc'])->toList();
		
		$worldPopularCasino			=	$this->casinoByContinent();

		
		$pageTitle			=	$headBlock->page_title;
		$metaDescription	=	$headBlock->meta_description;
		$this->set(compact('pageTitle','metaDescription','headBlock','cities','Continents','worldPopularCasino'));
    }
	
	function login(){
		if($this->Auth->user()){
			$data['success']	=	true;
			echo json_encode($data);
				exit;
		}
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				$data['success']	=	true;
				if($this->request->data['remember_me']){
					$this->Cookie->configKey('login', 'expires', '+3 months');
					$this->Cookie->write('login',json_encode($this->request->data));
				}
			}else{
				$data['errors']		=	array('error' => __('Your username or password is incorrect.',true));
				$data['success']	=	false;
			}
		}else{
			return $this->redirect(array('action' => 'index'));
		}
		$this->set('data', $data);
	}
	
	function logout(){
		if($this->Cookie->check('login')){
			$this->Cookie->delete('login');			
		}
		return $this->redirect($this->Auth->logout());
	}
	
	function signup(){
		if($this->Auth->user()){
			$data['success']	=	true;
			echo json_encode($data);
				exit;
		}
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$this->request->data 	=	$this->sanitizeData($this->request->data);

			$user = $this->{$this->modelClass}->patchEntity(
											$user, 
											$this->request->data, 
											[ 'validate' => 'signUpForm']
										);
			if($user->errors()){
				$data['errors']		=	$this->json_error($user->errors());
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			$this->loadModel('Users');
			$user->username	=	$this->request->data['email'];
			$user->role		=	FRONT_USER;
			$this->Users->save($user);
			
			$user = $this->Auth->identify();
			$this->Auth->setUser($user);
			
			$userId			=	$this->Auth->user('id');
			$this->loadModel('UserPreference');
			$preference		=	Configure::read('preference');
			foreach($preference as $key1){
				foreach($key1 as $key => $val){
					$userPreference 			= 	$this->UserPreference->newEntity();
					$userPreference->type		=	'account';
					$userPreference->user_id	=	$userId;
					$userPreference->key_name	=	$key;
					$this->UserPreference->save($userPreference);
				}
			}
			
			$email_preference		=	Configure::read('email_preference');
			foreach($email_preference as $key1){
				foreach($key1 as $key => $val){
					$userPreference 			= 	$this->UserPreference->newEntity();
					$userPreference->type		=	'email';
					$userPreference->user_id	=	$userId;
					$userPreference->key_name	=	$key;
					$this->UserPreference->save($userPreference);
				}
			}
			
			$data['message']	=	__('Thanks for contact with us',true);
			$data['success']	=	true;
			echo json_encode($data);
            
			exit;
        }
		$data['errors']		=	__('Your username or password is incorrect.',true);
		$data['success']	=	false;
		echo json_encode($data);
		exit;
	}
	public function contactUs(){
		$user = $this->{$this->modelClass}->newEntity();
		if ($this->request->is('post')) {
			$this->request->data 	=	$this->sanitizeData($this->request->data);

			$this->{$this->modelClass}->setCaptcha('securitycode', $this->Captcha->getCode('securitycode'));
			
			$user = $this->{$this->modelClass}->patchEntity(
											$user, 
											$this->request->data, 
											[ 'validate' => 'contactUsForm']
										);
			if($user->errors()){
				$data['errors']		=	$this->json_error($user->errors());
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			$this->loadModel('Contact.Contacts');
			$this->Contacts->save($user);
			$data['message']	=	__('Thanks for contact with us',true);
			$data['success']	=	true;
			echo json_encode($data);
            
			exit;
        }
		$this->loadModel('Block.Blocks');
		$contactBlock = $this->Blocks->find('translations')
			->where([
				'Blocks.id' => 9
			])->first();
		
		$this->loadModel('Master.Masters');
		$departmentList = $this->Masters->find('list')
			->where([
				'Masters.type' => 'department','is_deleted' => 0
			])->all()->toArray();
		
		
		$pageTitle			=	__('title.contact');
		$metaDescription	=	__('metadescription.contact');
		
		$this->set(compact('contactBlock','departmentList','pageTitle','metaDescription'));
    }
	
	
	public function addReview(){
		$this->loadModel('Reviews');
		$review	 = 	$this->Reviews->newEntity();
		if ($this->request->is('post')) {
			if(!$this->Auth->user()){				
				$data['errors']		=	array('error' => __('Something is going wrong.',true));
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			$this->request->data 	=	$this->sanitizeData($this->request->data);
			$Defaultlanguage		=	$this->request->session()->read('Config.language');			
			$review = $this->Reviews->patchEntity(
											$review, 
											$this->request->data, 
											[ 'validate' => 'addReviewForm']
										);
			if($review->errors()){
				$data['errors']		=	$this->json_error($review->errors());
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			$review->user_id	=	$userId	=	$this->Auth->user('id');
			$type				=	$this->request->data['type'];
			
			$result				=	$this->Reviews->find('all')->where(['type' => $type,'user_id' => $userId,'foreign_key' => $review->foreign_key])->first();
			
			$reviewCount		=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key])->all();
			$reviewCount		=	$reviewCount->count();
			
			
			$previousPoints		=	(!empty($result->user_points)) ? $result->user_points : 0;
			$isFirstPoints		=	(!empty($result->is_first_points)) ? $result->is_first_points : 0;
			
			if(!empty($result->id)){
				$review->id			=	$result->id;	
			}
			$review->language	=	$Defaultlanguage;
			$len				=	strlen($review->comment);		
			$userPoints			=	Configure::read('UserPoints.ReviewLess200');
			
			if($len > 200){
				$userPoints		=	Configure::read('UserPoints.ReviewGreater200');			
			}
			if($reviewCount == 0){
				$userPoints				 =	Configure::read('UserPoints.AddingFirstReview')+$userPoints;
				$review->is_first_points =	Configure::read('UserPoints.AddingFirstReview');
			}
			
			$review->user_points =	$userPoints;
			$this->Reviews->save($review);
			
			Cache::delete('reviewList','longlong');
			Cache::delete('promotions','longlong');
			
			
			$userDetails				=	$this->{$this->modelClass}->find('all')->where(['id' => $userId])->first();
			$totalPoints				=	isset($userDetails->user_points) ? $userDetails->user_points-$previousPoints+$isFirstPoints : 0;
			
			$userDetails->user_points	=	$totalPoints + $userPoints;		
			$this->{$this->modelClass}->save($userDetails);
			
			if($review->type == 'casino'){
				$this->loadModel('Casinos');
				$res	=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key]);
				
				$count	=	$res->count();
				$sum	=	$res->sumOf('rating');
				$avg	=	$sum/$count;
				
				$UpdateData	 = $this->Casinos->find('all')
				->where([
					'Casinos.id' => $review->foreign_key
				])->first();
				if($UpdateData->type == 'online'){
					$avg_rating					=	($avg + $UpdateData->our_rating)/2;
					$UpdateData->review_count	=	$count;
					$UpdateData->member_rating	=	$avg;
					$UpdateData->avg_rating		=	$avg_rating;
					$this->Casinos->save($UpdateData);					
				}else{					
					$avg_rating					=	($avg + $UpdateData->our_rating)/2;
					$UpdateData->review_count	=	$count;
					$UpdateData->member_rating	=	$avg;
					$UpdateData->avg_rating		=	$avg;
					$this->Casinos->save($UpdateData);
				}
				
			}else if($review->type == 'city'){
				$this->loadModel('CityManager.City');
				$res	=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key]);
				
				$count	=	$res->count();
				$sum	=	$res->sumOf('rating');
				$avg	=	$sum/$count;
				
				$UpdateData	 = $this->City->find('all')
				->where([
					'City.id' => $review->foreign_key
				])->first();
				$UpdateData->review_count	=	$count;
				$UpdateData->avg_rating		=	$avg;
				$this->City->save($UpdateData);
				
			}else if($review->type == 'news'){
				$this->loadModel('News');
				$res	=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key]);
				$count	=	$res->count();
				$sum	=	$res->sumOf('rating');
				$avg	=	0;
				if($count > 0){
					$avg	=	$sum/$count;
				}
				
				$UpdateData	 = $this->News->find('all')
				->where([
					'News.id' => $review->foreign_key
				])->first();
				$UpdateData->review_count	=	$count;
				$UpdateData->avg_rating		=	$avg;
				$this->News->save($UpdateData);
				
			}else{
				$this->loadModel('CityManager.Country');
				$res	=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key]);
				$count	=	$res->count();
				$sum	=	$res->sumOf('rating');
				$avg	=	0;
				if($count > 0){
					$avg	=	$sum/$count;
				}
				
				$UpdateData	 = $this->Country->find('all')
				->where([
					'Country.id' => $review->foreign_key
				])->first();
				$UpdateData->review_count	=	$count;
				$UpdateData->avg_rating		=	$avg;
				$this->Country->save($UpdateData);
				
			}
			
			$data['message']	=	__('Thanks for your valuable review.',true);
			$data['success']	=	true;
			echo json_encode($data);
            $this->Flash->success(__('Thanks for your valuable review.'));
			exit;
		}
			
		$pageTitle			=	__('title.write-a-review');
		$metaDescription	=	__('metadescription.write-a-review');
		$this->set(compact('pageTitle','metaDescription','review'));
    }
	
	/* public function promotion(){
		
		$pageTitle			=	__('title.near_by_destinations');
		$metaDescription	=	__('metadescription.near_by_destinations');
		$this->set(compact('pageTitle','metaDescription'));
    }
	 */
	public function changeLang()
    {
		$langId	=	(!empty($this->request->data['val'])) ? $this->request->data['val'] : 'en';
		$this->request->session()->write('Config.language', $langId);
		exit;
    }
	
	public function cmsSlug($slug = null)
    {
		
		$this->loadModel('Cms.CmsPages');
		$result = $this->CmsPages->find('translations')
			->where([
				'CmsPages.slug' => $slug
			])->first();
			
		$slugName	=	'cms_slug';
		if(empty($result)){
			$this->redirect(array('action' => 'index'),301);
		}
		$pageTitle			=	__('title.'.$slug);
		$metaDescription	=	__('metadescription.'.$slug);
		
		$this->set(compact('pageTitle','metaDescription','slugPass','result','slug','slugName'));
    }
	
	public function cityView($countrySlug=null,$slug = '')
    {	 
		$Defaultlanguage		=	$this->request->session()->read('Config.language');
		if($countrySlug == null || $slug == ''){
			$this->redirect('/'.$Defaultlanguage,301);
		}
	   $this->loadModel('CityManager.City');	   
	   $userId	   =	$this->Auth->user('id');
       $cityDetail = $this->City->find('all')->contain([
				'Country'	=> ['fields' => ['name']],
				/* 'Casino'	=> ['fields' => ['title','image','review_count','city_id','slug','avg_rating']] */
			]) 
			->where([
				'City.slug' => $slug
			])->first();
			
		
		if(empty($cityDetail->id)){			
			$Defaultlanguage		=	$this->request->session()->read('Config.language');
			if(!empty($Defaultlanguage) && $Defaultlanguage == 'en'){
				$Defaultlanguage	=	'';
			}
			$this->redirect('/'.$Defaultlanguage,301);
		}
		
		if(!empty($cityDetail->object_id)){
			$this->loadModel('CasinoImages');
			$images = $this->CasinoImages->find('all')->where(['CasinoImages.object_id' => $cityDetail->object_id])->order(['display_order' => 'asc']);
		}
		// pr($images);
		$slugName			=	'city_view';		
		$this->loadModel('Casinos');
		$query = $this->Casinos->find();
		$this->paginate = [
				'sortWhitelist' => ['title','phone','country_name','state_name','id'],
				'limit' => 10,
				 'sort' => 'title',
				 'direction' => 'asc',
				/* 'contain' => ['City'] */
			];
			
		if(isset($this->request->query['search'])){
			$query->where(['Casinos.title LIKE "%'.$this->request->query['search'].'%"']);
		}

		$query->where(['Casinos.city_id' => $cityDetail->id]);
		$casinosData = $this->paginate($query);
		// pr($casinosData->count());
		
		$pageTitle			=	__('title.city_title',$cityDetail->name,Date('Y'));
		$count				=		isset($cityDetail->casino_count) ? $cityDetail->casino_count : 0;
		$metaDescription	=	__('metadescription.city',$cityDetail->name,Date('Y'),$count);
		
		
		$this->loadModel('Casinos');		
		$recommedCasinos = $this->Casinos->find('all')->contain(['MainPromotion' => ['conditions' => ['is_main_promotion' => 1]]])->order(['Casinos.avg_rating' => 'desc'])->limit(5);
		
		
		$this->set(compact('cityDetail','slug','slugName','images','pageTitle','metaDescription','recommedCasinos','casinosData','countrySlug'));
		$this->set('_serialize', ['cityDetail','images']);
	}
	
	public function cityAutocomplete(){
		
		$this->loadModel('CityManager.City');
		$this->loadModel('CityManager.Country');
		
		$this->loadModel('Casinos');
		
		if(empty($this->request->query['q'])){
			exit;
		}
		$query 		= 	$this->request->query['q'];	
		if(strpos($query,'__')){
			$res		=	explode('__',$query);
			$query		=	$res[0];
			$type		=	$res[1];
			if($type == 'country'){
				$results['Country'] 	= $this->Country->find('translations')
					->where([
					'Country.name COLLATE UTF8_GENERAL_CI LIKE' => $query.'%'
				])->limit(3);
			
			
			}else if($type == 'city'){
				$results['City'] 	= $this->City->find('translations')
					->contain(['Country'])
					->where([
					'City.name COLLATE UTF8_GENERAL_CI LIKE' => '%'.$query.'%'
				])->limit(3);
			
			} else if($type == 'casino'){
				$results['Casinos'] = $this->Casinos->find('all')
					->where([
					'OR' => [
						'Casinos.title LIKE' => '%'.$query.'%',
						'Casinos.description LIKE' => '%'.$query.'%',
						'Casinos.address LIKE' => '%'.$query.'%'
						],'type' => 'normal'
				])->limit(3);	
			}else if($type == 'onlinecasino'){
				$results['Casinos'] = $this->Casinos->find('all')
					->contain(['MainPromotion' => ['conditions' => ['is_main_promotion' => 1]]])
					->where([
					'OR' => [
						'Casinos.title LIKE' => '%'.$query.'%',
						'Casinos.description LIKE' => '%'.$query.'%',
						'Casinos.address LIKE' => '%'.$query.'%'
						],'type' => 'normal'
				])->limit(3);	
			}
		}else{
			$results['Country'] 	= $this->Country->find('translations')
					->where([
					'Country.name COLLATE UTF8_GENERAL_CI LIKE' => $query.'%'
				])->limit(2);
			
			
			$results['City'] 	= $this->City->find('translations')
					->contain(['Country'])
					->orWhere(['City.name COLLATE UTF8_GENERAL_CI LIKE' => '%'.$query.'%'])
					->orWhere(['Country.name COLLATE UTF8_GENERAL_CI LIKE' => '%'.$query.'%'])
					->limit(2);
				
			$results['online'] = $this->Casinos->find('all')
					->orWhere(['Casinos.title LIKE' => '%'.$query.'%'])
					->orWhere(['Casinos.address COLLATE UTF8_GENERAL_CI LIKE' => '%'.$query.'%'])
					->where(['Casinos.type' => 'online'])
					->contain(['MainPromotion' => ['conditions' => ['is_main_promotion' => 1]]])
					->limit(2);	
			
			$results['normal'] = $this->Casinos->find('all')					
					->contain(['City','Country'])
					->orWhere(['Casinos.title LIKE' => '%'.$query.'%'])
					->orWhere(['Casinos.address COLLATE UTF8_GENERAL_CI LIKE' => '%'.$query.'%'])
					->orWhere(['City.name COLLATE UTF8_GENERAL_CI LIKE' => '%'.$query.'%'])
					->orWhere(['Country.name COLLATE UTF8_GENERAL_CI LIKE' => '%'.$query.'%'])
					->where(['Casinos.type' => 'normal'])
					->limit(2);	
		}
		
		$newArray	=	'';
		foreach($results as $key => $val1){
			if($key == 'Country'){
				foreach($val1 as $val){
					$newArray[]		=	array('id' => $val->id,'name' => $val->name,'slug' => $val->slug,'type' => 'country');
				}
			}elseif($key == 'City'){
				foreach($val1 as $val){
					$newArray[]		=	array('id' => $val->id,'name' => $val->name,'slug' => $val->slug,'type' => 'city','country' => $val->country->name,'country_slug' => $val->country->slug);
				}
			}elseif($key == 'normal'){
				foreach($val1 as $val){
					$newArray[]		=	array('id' => $val->id,'name' => $val->title,'slug' => $val->slug,'type' => $val->type);
				}
			}else{
				foreach($val1 as $val){
					$newArray[]		=	array('id' => $val->id,'name' => $val->title,'slug' => $val->slug,'type' => $val->type);
				}
			}
		}		
		echo json_encode($newArray);		
		exit;		
	}
	
	public function usersAutocomplate(){
		if(empty($this->request->query['q'])){
			exit;
		}
		$query 		= 	$this->request->query['q'];			
		$userId		=	$this->Auth->user('id');
		$results	= 	$this->Users->find('all');
		
		$results->where([
			'OR' => [
				'Users.full_name LIKE' => '%'.$query.'%'
			],
			'role !=' => 'admin',
			'Users.no_contact' => 0,
			'id !=' => $this->Auth->user('id')
		])->limit(6);
		
		
		$newArray	=	'';
		foreach($results as $key => $val1){			
			$newArray[]		=	array('id' => $val1->id,'name' => $val1->full_name,'email' => $val1->email);		
		}
		
		echo json_encode($newArray);
		exit;		
	}
	
	/* function fbsignup(){
		$id		=	$this->request->data('id');
		$name	=	$this->request->data('name');
		$email	=	$this->request->data('email');
		$users	=	$this->Users->find('all')->where(['facebook_id' => $id])->first();
		if(empty($users)){
			$user = $this->Users->newEntity();

			$user->username		=	$email;
			$user->email		=	$email;
			$user->full_name	=	$name;
			$user->facebook_id	=	$id;
			$user->role			=	FRONT_USER;
			$this->Users->save($user);
			
			$users	=	$this->Users->find('all')->where(['facebook_id' => $id])->first();
				
			$this->request->session()->write('Auth.User', $users->toArray());
		}else{
			$this->request->session()->write('Auth.User', $users->toArray());

		}
		echo 'success';
		exit;
	} */
	
	function countryView($slug = null){
		// pr($slug);
		$slugName	=	'country_view';
		$userId	    =	$this->Auth->user('id');
		
		$limit		=	12;
		$created		=	isset($this->request->query['created']) ? $this->request->query['created'] : 'asc';
		$recommend		=	isset($this->request->query['recommend']) ? $this->request->query['recommend'] : 'asc';
		$rating		=	isset($this->request->query['rating']) ? $this->request->query['rating'] : 'asc';
		$name		=	isset($this->request->query['name']) ? $this->request->query['name'] : 'asc';
		$this->set(compact('created','recommend','rating','name'));
		
		
		
		
		$this->loadModel('CityManager.Country');	   
		$countryDetail = $this->Country->find('all')
			->contain(
				[
				'City'	 =>	['fields' => ['name','country_id','slug','review_count','image']],

				/* 'CasinoSum'	=>	function($q) {
						$q->select([
							'total_casino' => $q->func()->sum('CasinoSum.casino_count')
						])
						->group(['CasinoSum.country_id']);
						return $q;
					} */
				])
			->where([
				'Country.slug' => $slug
			])->first();
			
		if(empty($countryDetail->name)){
			throw new NotFoundException(__('Page not found'));
		}
		
		if(!empty($countryDetail->object_id)){
			$this->loadModel('CasinoImages');
			$images = $this->CasinoImages->find('all')
				->where([
					'CasinoImages.object_id' => $countryDetail->object_id
				])->order(['display_order' => 'asc']);
		}
		$this->loadModel('Casinos');
		$query = $this->Casinos->find();
		$this->paginate = [
				'sortWhitelist' => ['title','phone','country_name','state_name','id'],
				'limit' => 10,
				 /* 'sort' => 'id', */
				 /* 'direction' => 'desc', */
				'contain' => ['City']
			];
			
		if(isset($this->request->query['search'])){
			$query->where(['Casinos.title LIKE "%'.$this->request->query['search'].'%"']);
		}

		$query->where(['Casinos.country_id' => $countryDetail->id]);
		$casinosData = $this->paginate($query);
		
		$pageTitle			=	__('title.country',$countryDetail->name);
		$metaDescription	=	__('metadescription.country',$countryDetail->name,$countryDetail->total_casino);
		
		$recommnedCasino = $this->Casinos->find('all')->contain(['MainPromotion' => ['conditions' => ['is_main_promotion' => 1]]])->order(['Casinos.avg_rating' => 'desc'])->limit(5);
		
		$this->set(compact('countryDetail','slug','slugName','pageTitle','metaDescription','casinosData','recommnedCasino','images'));
		// pr($images);
		$this->set('_serialize', ['countryDetail']);
	}
	
	
	
	function like(){
		if ($this->request->is('post')) {
			$rel				=	$this->request->data['rel'];
			$userId				=	$this->Auth->user('id');
			$review_id			=	$this->request->data['id'];
			$type				=	$this->request->data['type'];
			$this->loadModel('ReviewLikes');
			if($rel == 'yes'){
				$review	 			= 	$this->ReviewLikes->newEntity();
				
				$review->user_id	=	$userId;
				$review->review_id	=	$review_id;
				$review->type		=	$type;
				
				$this->ReviewLikes->save($review);			
			}else{
				$ReviewLikes = $this->ReviewLikes->find('all')->where(['review_id' => $review_id, 'type' => $type, 'user_id' => $userId])->first();
				$this->ReviewLikes->delete($ReviewLikes);
			}
			$this->loadModel('Reviews');
			$reviewCount		=	$this->Reviews->get($review_id);
			
			/* $reviewCount		=	$this->ReviewLikes->find('all')->where(['review_id' => $review_id,'type' => $type])->count();
			$this->loadModel('Reviews');
			$result		=	$review		=	$this->Reviews->find('all')->where(['id' => $review_id])->first();
			$review->id			=	$result->id;
			$review->like_count	=	$reviewCount;
			$this->Reviews->save($result); */
			
			
			$data['success']	=	true;
			$data['count']		=	$reviewCount->like_count;
			echo json_encode($data);
			exit;		
		}
	}
	
	
	function follow(){
		if ($this->request->is('post')) {
			$followerId		=	$this->Auth->user('id');
			$userId			=	$this->request->data['id'];
			$type			=	$this->request->data['rel'];
			$this->loadModel('UserFollowers');
			
			$UserFollowers = $this->UserFollowers->find('all')->where(['follower_id' => $followerId,'user_id' => $userId])->first();
				
			if($type == 'yes' && empty($UserFollowers)){
				$review	 			= 	$this->UserFollowers->newEntity();
				
				$review->user_id	=	$userId;
				$review->follower_id=	$followerId;
				
				$this->UserFollowers->save($review);			
			}else{
				$UserFollowers = $this->UserFollowers->find('all')->where(['follower_id' => $followerId,'user_id' => $userId])->first();
				$this->UserFollowers->delete($UserFollowers);
			}
			$reviewCount		=	$this->Users->get($userId);
			
			$data['success']	=	true;
			$data['count']		=	$reviewCount->follower_count;
			echo json_encode($data);
			exit;		
		}
	}
	
	function reviewDelete(){
		if ($this->request->is('post')) {
			$rel	=	$this->request->data['id'];
			
			$this->loadModel('Reviews');
			$review		= $review1 =	$this->Reviews->find('all')->where(['id' => $rel,'user_id' => $this->Auth->user('id')])->first();	
			
			$userPoints	=	$review1->user_points;
			if(empty($review)){
				$data['success']	=	false;
				$data['message']	=	'Something going wrong';
				echo json_encode($data);
				exit; 
			}
			$type	=	$review->type;
			$this->Reviews->delete($review);			
			
			Cache::delete('reviewList','longlong');
			$data['message']	=	'Review deleted successfully';
			
		
			$userDetails				=	$this->{$this->modelClass}->find('all')->where(['id' => $this->Auth->user('id')])->first();
			$totalPoints				=	isset($userDetails->user_points) ? $userDetails->user_points-$userPoints : 0;
			
			$userDetails->user_points	=	$totalPoints;		
			$this->{$this->modelClass}->save($userDetails);
			
			
			if($type == 'casino'){
				$this->loadModel('Casinos');
				$res	=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key]);
				
				$count	=	$res->count();
				$sum	=	$res->sumOf('rating');
				$avg	=	0;
				if($count > 0)
					$avg	=	$sum/$count;
				
				$UpdateData	 = $this->Casinos->find('all')
				->where([
					'Casinos.id' => $review->foreign_key
				])->first();
				/* $UpdateData->review_count	=	$count;
				$UpdateData->avg_rating		=	$avg;
				$this->Casinos->save($UpdateData); */
				
				if($UpdateData->type == 'online'){
					if($avg > 0){
						$avg_rating					=	($avg + $UpdateData->our_rating)/2;
					}else{
						$avg_rating					=	$UpdateData->our_rating;						
					}
					$UpdateData->review_count	=	$count;
					$UpdateData->member_rating	=	$avg;
					$UpdateData->avg_rating		=	$avg_rating;
					$this->Casinos->save($UpdateData);					
				}else{					
					$UpdateData->review_count	=	$count;
					$UpdateData->member_rating	=	$avg;
					$UpdateData->avg_rating		=	$avg;
					$this->Casinos->save($UpdateData);
				}
				
				Cache::delete('promotions','longlong');
			}else if($type == 'city'){
				$this->loadModel('CityManager.City');
				$res	=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key]);
				
				$count	=	$res->count();
				$sum	=	$res->sumOf('rating');
				$avg	=	0;
				if($count > 0){
					$avg	=	$sum/$count;					
				}
				
				$UpdateData	 = $this->City->find('all')
				->where([
					'City.id' => $review->foreign_key
				])->first();
				$UpdateData->review_count	=	$count;
				$UpdateData->avg_rating		=	$avg;
				$this->City->save($UpdateData);
			
			}else if($type == 'news'){
				$this->loadModel('News');
				$res	=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key]);
				
				$count	=	$res->count();
				$sum	=	$res->sumOf('rating');
				$avg	=	0;
				if($count > 0){
					$avg	=	$sum/$count;					
				}
				
				$UpdateData	 = $this->News->find('all')
				->where([
					'News.id' => $review->foreign_key
				])->first();
				$UpdateData->review_count	=	$count;
				$UpdateData->avg_rating		=	$avg;
				$this->News->save($UpdateData);
				
			}else{
				$this->loadModel('CityManager.Country');
				$res	=	$this->Reviews->find('all')->where(['type' => $type,'foreign_key' => $review->foreign_key]);
				$count	=	$res->count();
				$sum	=	$res->sumOf('rating');
				$avg	=	0;
				if($count > 0){
					$avg	=	$sum/$count;					
				}
				
				$UpdateData	 = $this->Country->find('all')
				->where([
					'Country.id' => $review->foreign_key
				])->first();
				$UpdateData->review_count	=	$count;
				$UpdateData->avg_rating		=	$avg;
				$this->Country->save($UpdateData);
				
			}
			
			$data['count']		=	$count;
			$data['success']	=	true;
			echo json_encode($data);
			exit; 
		}
	}
	
	function deleteReviewComment(){
		if ($this->request->is('post')) { 
			$this->loadModel('ReviewComments');
			
			$id			=	$this->request->data['id'];
			$userId		=	$this->Auth->user('id');

			$comments	=	$this->ReviewComments->find('all')->where(['id' => $id,'user_id' => $userId])->first();
			
			if(empty($comments)){
				$data['success']	=	false;
				$data['message']	=	'Something going wrong';
				echo json_encode($data);
				exit;
			}
			// pr($comments);
			$this->ReviewComments->delete($comments);
			$data['success']	=	true;
			echo json_encode($data);
			exit;
		}
		exit;
	}
			
	function addReviewComment(){
		if ($this->request->is('post')) {
			
			$Defaultlanguage		=	$this->request->session()->read('Config.language');
			$this->request->data 	=	$this->sanitizeData($this->request->data);

			$id			=	$this->request->data['id'];
			$comment	=	$this->request->data['comment'];
			$userId		=	$this->Auth->user('id');
			$this->loadModel('ReviewComments');			
			$review	 			= 	$this->ReviewComments->newEntity();				
			$review->user_id	=	$userId;
			$review->review_id	=	$id;
			$review->comment	=	$comment;			
			$review->language	=	$Defaultlanguage;		
			$this->ReviewComments->save($review);
			$id					=	$review->id;
			
			$comments			=	$this->ReviewComments->get($id,['contain' => ['Users' => ['fields' => ['full_name','city','profile_image','facebook_id','sex']]]]);
			
			$data['success']	=	true;
			$data['message']	=	'Thanks for your valuable comment.';
			
			$view 				= 	new View();
			$view->viewPath		=	'Element';
			$view->layout		=	false;
			
			$view->set (compact('Defaultlanguage','comments')); 
			$html				=	$view->render('review_comment');			
			$data['id']			=	$id;
			$data['data']		=	$html;
			
			echo json_encode($data);
			exit; 
		}
	}

	
	function facebook(){
		require_once  ROOT. '/vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
		$fb = new \Facebook\Facebook([
			  'app_id' => '1069561843098094',
			  'app_secret' => 'b308613114a12568fe7ce91bfea98180',
			  'default_graph_version' => 'v2.6',
			  //'default_access_token' => '{access-token}', // optional
			]);
		$helper = $fb->getRedirectLoginHelper();

		try {
		  $accessToken = $helper->getAccessToken();
		  
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}


		$permissions = ['email']; // Optional permissions
		$loginUrl = $helper->getLoginUrl('http://www.casinolineup.com/users/facebook2', $permissions);


		// echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
		header('Location:'.$loginUrl);
		exit;
	}
	
	function facebook2(){
		
		require_once  ROOT. '/vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
		$fb = new \Facebook\Facebook([
			  'app_id' => '1069561843098094',
			  'app_secret' => 'b308613114a12568fe7ce91bfea98180',
			  'default_graph_version' => 'v2.6',
			  //'default_access_token' => '{access-token}', // optional
			]);
		$helper = $fb->getRedirectLoginHelper();


			try {
			  $accessToken = $helper->getAccessToken();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  // When validation fails or other local issues
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}

			if (! isset($accessToken)) {
			  if ($helper->getError()) {
				header('HTTP/1.0 401 Unauthorized');
				echo "Error: " . $helper->getError() . "\n";
				echo "Error Code: " . $helper->getErrorCode() . "\n";
				echo "Error Reason: " . $helper->getErrorReason() . "\n";
				echo "Error Description: " . $helper->getErrorDescription() . "\n";
			  } else {
				header('HTTP/1.0 400 Bad Request');
				echo 'Bad request';
			  }
			  exit;
			}

			// The OAuth 2.0 client handler helps us manage access tokens
			$oAuth2Client = $fb->getOAuth2Client();

			// Get the access token metadata from /debug_token
			$tokenMetadata = $oAuth2Client->debugToken($accessToken);
			
			// Validation (these will throw FacebookSDKException's when they fail)
			$tokenMetadata->validateAppId('1069561843098094'); // Replace {app-id} with your app id
			// If you know the user ID this access token belongs to, you can validate it here
			//$tokenMetadata->validateUserId('123');
			$tokenMetadata->validateExpiration();

			if (! $accessToken->isLongLived()) {
			  // Exchanges a short-lived access token for a long-lived one
			  try {
				$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			  } catch (Facebook\Exceptions\FacebookSDKException $e) {
				echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
				exit;
			  }
			}
			
			$fb_access_token = (string) $accessToken;


		$fb->setDefaultAccessToken($fb_access_token);
		$response = $fb->get('/me?locale=en_US&fields=name,email');
		$userNode = $response->getGraphUser();
		
		$name	=	$userNode->getField('name');
		$email	=	$userNode->getField('email');
		$id		=	$userNode->getField('id');
		
		$users	=	$this->Users->find('all')->where(['facebook_id' => $id,'is_deleted' => 0])->first();
		
		if(empty($users->id) && !empty($email))
			$users	=	$this->Users->find('all')->where(['email' => $email,'is_deleted' => 0])->first();
		
		if(empty($users)){
			$user = $this->Users->newEntity();

			$user->username		=	$email;
			$user->email		=	$email;
			$user->full_name	=	$name;
			$user->facebook_id	=	$id;
			$user->role			=	FRONT_USER;
			$this->Users->save($user);
			
			$users	=	$this->Users->find('all')->where(['facebook_id' => $id,'is_deleted' => 0])->first();
			$userId	=	$users->id;
			$this->loadModel('UserPreference');
			$preference		=	Configure::read('preference');
			foreach($preference as $key1){
				foreach($key1 as $key => $val){
					$userPreference 			= 	$this->UserPreference->newEntity();
					$userPreference->type		=	'account';
					$userPreference->user_id	=	$userId;
					$userPreference->key_name	=	$key;
					$this->UserPreference->save($userPreference);
				}
			}
			
			$email_preference		=	Configure::read('email_preference');
			foreach($email_preference as $key1){
				foreach($key1 as $key => $val){
					$userPreference 			= 	$this->UserPreference->newEntity();
					$userPreference->type		=	'email';
					$userPreference->user_id	=	$userId;
					$userPreference->key_name	=	$key;
					$this->UserPreference->save($userPreference);
				}
			}
			
			$this->request->session()->write('Auth.User', $users->toArray());
			
		}else{
			$this->request->session()->write('Auth.User', $users->toArray());
		} 
		
		$this->redirect(array('controller' => 'globalusers','action' => 'index'));
	}
	
	public function userSlug($slug = null)
    {
		if($slug == ''){
			$this->redirect(array('index'),301);
		}
		$userDetails	=	$this->Users->find('all')
					->select(['id','full_name','profile_image','facebook_id','created','follower_count','city','user_points','sex','cover_image'])
					->where(['slug' => $slug])
					->contain([
						'UserPreference' => function($q) {
							return $q
							->select(['key_name','user_id'])
							->where(['type' => 'account']);
						},
						'UserFollowers' => function($q) {
							return $q
							->select(['id','user_id'])
							->where(['UserFollowers.follower_id' => $this->Auth->user('id')]);
						},
						'HeFollowME' => function($q) {
							return $q
							->select(['id','user_id','follower_id'])
							->where([
								'HeFollowME.user_id' => $this->Auth->user('id')/* ,
								'HeFollowME.follower_id' => 'Users.id' */]);
						}
					])->first();
			
		if(empty($userDetails->id)){
			$this->redirect(array('index'));
		}
		// pr($userDetails);
		$userId			=	$userDetails->id;
		$preference		=	array();
		foreach($userDetails->user_preference as $user_preference){
			$preference[$user_preference->key_name]	=	$user_preference->key_name;
		}
		
		if($this->Auth->user('id')){
			$authUserId		=	$this->Auth->user('id');
		}
		// pr($preference);
		$this->loadModel('CasinoLikes');
		$this->loadModel('CasinoVisits');
		
		$casinoILikes	=	$this->CasinoLikes->find('all')->contain([
									'Casinos' =>['fields' => ['id','title','image','review_count','avg_rating','url','slug']],
									'Casinos.MainPromotion' => ['conditions' => ['is_main_promotion' => 1]]
								])
								->where(['user_id' => $userId]);
								
		
		$casinoIvisites	=	$this->CasinoVisits->find('all')->contain([
								'Casinos' =>['fields' => ['id','title','image','review_count','avg_rating','slug','address']]
								])
								->where(['user_id' => $userId]);
								
		
		$slugName	=	'user_slug';
		// pr($preference);
		// $reviewList	=	$this->reviewList($userId);
		$this->set(compact('casinoIvisites','slug','slugName','userDetails','casinoILikes','reviewList','preference'));
		$this->set('_serialize', ['casinoIvisites','userDetails']);
		
    }
	
	public function forgotPassword()
    {
		$user = $this->Users->newEntity();

		if ($this->request->is('post')) {
			$user = $this->{$this->modelClass}->patchEntity(
											$user, 
											$this->request->data, 
											[ 'validate' => 'forgotPasswordForm']
									);
			if($user->errors()){
				$data['errors']		=	$this->json_error($user->errors());
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			$email	 =	$this->request->data['email'];
			$res	 = $this->{$this->modelClass}->find('all')->where(['email' => $email])->first();
			if(empty($res)){
				$data['errors']		=	array('error' => __('This email does not exists',true));
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			
			$res 							= 	$this->{$this->modelClass}->patchEntity($res, $this->request->data);
			$res->forgot_password_string	=	$forgot_password_string	=	md5($res->email.$res->id);	
			
			$this->{$this->modelClass}->save($res);
			
			$url					=	WEBSITE_URL.'users/reset_password/'.$forgot_password_string;			
			$forgot_password_string	=	'<a href="'.$url.'">Click here</a>';
			$full_name				=	$res->full_name;			
			
			$action  	   = 'forgot_password';
			$settingsEmail = Configure::read('Site.email');
			$settingstitle = Configure::read('Site.title');
			
			$this->loadModel('Actions');
			$cons 	= 	$this->Actions->find('all')->where(array('action' => $action))->first()->toArray();
			
			$this->loadModel('EmailTemplates');
			$emailTemplate 	= 	$this->EmailTemplates->find('all')->where(array('action_id' => $cons['id']))->first()->toArray();
			
			
			$cons	   =	explode(",",$cons['constant']);
			$constants =	 array();
			foreach($cons as $key=>$val){
				$constants[] = '{'.$val.'}';
			}
			
			$from_email          = $settingsEmail;
			$from_name           = $settingstitle;
			
			$from                = $from_name . "<" . $from_email . ">";
			$replyTo             = "";
			
			$subject             = $emailTemplate['subject'];
			$rep_Array           = array($full_name,$forgot_password_string,$url); 
			$message             = str_replace($constants, $rep_Array, $emailTemplate['body']);
			
			$to	=	$res->email;
			
			$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
			
			
			$this->Flash->success(__('forgot_password.success_message.',true));
			$data['success']	=	true;
			echo json_encode($data);			
		}
		exit; 
    }
	
	public function resetPassword($forgot_password_string = '') {
		if($forgot_password_string == ''){
			$this->Flash->error(__('This url has been used'));
			return $this->redirect(array('action' => 'index'));
			exit;
		}
		
		$reset	=	$this->{$this->modelClass}->find('all')->where(array('forgot_password_string' => $forgot_password_string))->first();
		if($reset == NULL){
			$this->Flash->error(__('This url has been used'));
			return $this->redirect(array('action' => 'index'));
			exit;
		}
		$full_name	 =	$reset->full_name;
		$to			 =	$reset->email;			
		if ($this->request->is(['patch', 'post', 'put'])) {			
			$reset		 =  $this->{$this->modelClass}->patchEntity(
											$reset, 
											$this->request->data, 
											[ 'validate' => 'signUpForm']
										);
			if($reset->errors()){
				$data['errors']		=	$this->json_error($reset->errors());
				$data['success']	=	false;
				echo json_encode($data);
				exit;
			}
			
			$reset->forgot_password_string	=		'';			
			$this->{$this->modelClass}->save($reset);
			
			$action  	   = 'reset_password';
			$settingsEmail = Configure::read('Site.email');
			$settingstitle = Configure::read('Site.title');
			
			$this->loadModel('Actions');
			$cons 	= 	$this->Actions->find('all')->where(array('action' => $action))->first()->toArray();
			
			$this->loadModel('EmailTemplates');
			$emailTemplate 	= 	$this->EmailTemplates->find('all')->where(array('action_id' => $cons['id']))->first()->toArray();
			
			
			$cons	   =	explode(",",$cons['constant']);
			$constants =	 array();
			foreach($cons as $key=>$val){
				$constants[] = '{'.$val.'}';
			}
			
			$from_email          = $settingsEmail;
			$from_name           = $settingstitle;
			
			$from                = $from_name . "<" . $from_email . ">";
			$replyTo             = "";
			
			$subject             = $emailTemplate['subject'];
			
			$rep_Array           = array($full_name); 
			$message             = str_replace($constants, $rep_Array, $emailTemplate['body']);
			
			$this->_sendMail($to, $from, $replyTo, $subject, 'sendmail', array('message' => $message), "", 'html', $bcc = array());
			
			$this->Flash->success(__('reset_password.success_message.',true));
		
			$data['success']	=	true;
			echo json_encode($data);
			exit;
			
		}
		$this->set(compact('reset','forgot_password_string'));
	}
	
	public function getReviews()
    { 
		if(!empty($this->request->data)){
			$type				=	isset($this->request->data['type']) ? $this->request->data['type'] : '';
			$name				=	$this->request->data['name'];
			$foreign_key		=	isset($this->request->data['foreign_key']) ? $this->request->data['foreign_key'] : '';
			$count				=	$this->request->data['count'];
			$avg_rating			=	isset($this->request->data['avg_rating']) ? $this->request->data['avg_rating'] : '';
			$key	=	'Reviews.like_count';
			$val	=	'DESC';
			$sort_by	=	'';
			if(isset($this->request->data['sort_by'])){
				$sort_by		=	 $this->request->data['sort_by'];
				if($sort_by == SORT_MOST_RELEVANT){
					$key	=	'Reviews.like_count';
					$val	=	'DESC';
				}else if ($sort_by == SORT_EVALUTION){
					$key	=	'Reviews.rating';
					$val	=	'DESC';
				}else if ($sort_by == SORT_DATE){
					$key	=	'Reviews.created';
					$val	=	'DESC';
				}else if ($sort_by == SORT_LANGUAGE){
					$key	=	'Reviews.language';
					$val	=	'DESC';
				}			
			}
			
			
			$this->loadModel('Reviews');
			$userId	=	$this->Auth->user('id');
			
			$reviewList	=	$this->Reviews->find('all')->contain([
					'Users' => ['fields' => ['full_name','city','profile_image','facebook_id','slug','sex']],
					'ReviewLikes' => ['conditions' => ['ReviewLikes.user_id' => $userId]],
					'ReviewComments',
					'ReviewComments.Users' => ['fields' => ['full_name','city','profile_image','facebook_id','slug','sex']] 
				])
				  ->where(['type' => $type,'foreign_key' => $foreign_key])
				  ->order([$key => $val]);
			
			$this->loadModel('Master.Masters');
			$reportAsSpam = $this->Masters->find('list')
				->where([
					'Masters.type' => 'report_as_spam','is_deleted' => 0
				])->all()->toArray();
		
					
			$data['success']	=	true;		
			$view 				= 	new View();
			$view->viewPath		=	'Element';
			$view->layout		=	false;
			$Defaultlanguage	=	$this->request->session()->read('Config.language');
			
			$view->set (compact('Defaultlanguage','type','name','count','avg_rating','reviewList','sort_by','foreign_key','reportAsSpam')); 
			$html				=	$view->render('normal_casino_review');			
			$data['data']		=	$html;
			
			echo json_encode($data);
		}	
		exit;
			
    }
	
	public function getAllReviews()
    { 
		if(!empty($this->request->data)){
			$id				=	$this->request->data['id'];
			
			$this->loadModel('ReviewComments');
			$userId	=	$this->Auth->user('id');
			
			$reviewList	=	$this->ReviewComments->find('all')->contain([
					'Users' => ['fields' => ['full_name','city','profile_image','facebook_id','slug','sex']] 
				])
				  ->where(['ReviewComments.review_id' => $id]);
					
			$data['success']	=	true;		
			$view 				= 	new View();
			$view->viewPath		=	'Element';
			$view->layout		=	false;
			$Defaultlanguage	=	$this->request->session()->read('Config.language');
			
			$view->set (compact('Defaultlanguage','reviewList')); 
			$html				=	$view->render('all_review_comments');			
			$data['data']		=	$html;
			
			echo json_encode($data);
		}	
		exit;
			
    }
	
	function topUsers(){
		$allUser	=	$this->{$this->modelClass}->find('all')
				->select(['full_name','profile_image','slug','facebook_id','user_points','sex'])
				->where(['role !=' => 'admin'])
				->order(['user_points' => 'desc'])
				->limit(15);
				
		$allUserArray		=	$allUser->toArray();
		
		$pageTitle			=	__('title.leaderboard');
		$metaDescription	=	__('metadescription.leaderboard');
		$this->set(compact('allUserArray','pageTitle','metaDescription','allUser'));
		
		
	}
	function newReviews(){
		// $this->loadModel('Reviews');
		/* $reviewList	=	$this->Reviews->find('all')->contain([
				'Casinos',
				'City',
				'Country',
				'City.Country',
				'Users' => ['fields' => ['full_name','city','profile_image','facebook_id','slug','sex']],
				])
				->limit(100)
				->order(['Reviews.id' => 'desc']); */
		$reviewList			=	  $this->reviewList('100');
		$pageTitle			=	__('title.new-casino-reviews');
		$metaDescription	=	__('metadescription.new-casino-reviews');
		$this->set(compact('reviewList','pageTitle','metaDescription'));
	}
	
	function uploadImage(){
		$this->loadModel('UploadImages');
		$user = $this->UploadImages->newEntity();
		if ($this->request->is('post')) {
			if(isset($this->request->data['type'])){
				$user = $this->{$this->modelClass}->patchEntity(
												$user, 
												$this->request->data, 
												[ 'validate' => 'uploadImageForm']
											);
				
				if($user->errors()){
					$data['errors']		=	$this->json_error($user->errors());
					$data['success']	=	false;
					echo json_encode($data);
					exit;
				}
				$user->user_id		=	$this->Auth->user('id');
				$this->UploadImages->save($user);
				$data['message']	=	__('Thanks for uploading the image, We will publish soon',true);
				$data['success']	=	true;
				echo json_encode($data);
				exit;
			}else{ 
				$user = $this->{$this->modelClass}->patchEntity(
												$user, 
												$this->request->data, 
												[ 'validate' => 'uploadImageForm']
											);
				
				if($user->errors()){
					$data['errors']		=	$this->json_error($user->errors());
					$data['success']	=	false;
					echo json_encode($data);
					exit;
				}
				
				$thisData	=	$this->request->data;
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, CASINO_THUMB_IMG_ROOT_PATH.$return_file_name)){
						$this->copyUploadedFile(CASINO_THUMB_IMG_ROOT_PATH.$return_file_name, CASINO_FULL_IMG_ROOT_PATH.$return_file_name);												
					
						$data['success']	=	true;
						$data['name']		=	 $return_file_name;
						$data['src']		=	 WEBSITE_URL.'image.php?width=400px&height=210px&cropratio=2:1&image='.CASINO_FULL_IMG_URL.$return_file_name;
						echo json_encode($data);
						exit;
					}
				}
			}
		}
	}
	
	
	function guide(){
		$this->loadModel('GuideContent.GuideContents');
		$this->loadModel('Block.Blocks');
		
		$guideContent = $this->GuideContents->find('translations')->where(['is_deleted' => 0]);
		
		$block = $this->Blocks->find('translations')->where(['Blocks.id' => 23])->first();
		
		$pageTitle	=	__('title.guide');
		$metaDescription	=	__('metadescription.guide');
		$this->set(compact('guideContent','footerBlock','block','pageTitle','metaDescription'));
	}

/* 	function article(){
		$this->loadModel('GuideContent.GuideContents');
		
		$this->loadModel('Block.Blocks');
		
		$guideContent = $this->GuideContents->find('translations');		
		$headBlock = $this->Blocks->find('translations')->where(['Blocks.id' => 24])->first();

		$this->set(compact('guideContent','headBlock','footerBlock'));
	} */
	function guideView($slug = null)
    {
		
		$this->loadModel('GuideContent.GuideContents');
		$headBlock = $this->GuideContents->find('translations')
			->where([
				'GuideContents.slug' => $slug
			])->first();
			
		$slugName	=	'guide_view';
		
		
		$this->loadModel('Block.Blocks');
		
		$guideContent = $this->GuideContents->find('translations')->where(['isfeat' => 1,'is_deleted' => 0]);

		// $headBlock = $this->Blocks->find('translations')->where(['Blocks.id' => 24])->first();
		
		
		$this->set(compact('slugPass','result','slug','slugName','guideContent','headBlock'));
	}
	
	 public function continenent($slug = null)
    {
		
		/* ini_set('memory_limit','-1');  */
		/* if (($promotions = Cache::read('promotions','longlong')) === false) { */
			$this->loadModel('Promotion.Promotions');
			$promotions 			= 	$this->Promotions->find('all')
				->where(['isfeat' => 1])
				->contain([
					'Casino' => ['fields' => ['slug','id','image','title','payout_percentage','avg_rating']]
				])->limit(5)->order('rand()')->toList();
			/* Cache::write('promotions', $promotions,'longlong'); */
		/* } */
		
		 if (($reviewList = Cache::read('reviewList','longlong')) === false) {
			$this->loadModel('Reviews');
			$reviewList	=	$this->Reviews->find('all')->contain([
					'Casinos',
					'Casinos.City',
					'Casinos.Country',
					'City',
					'City.Country',
					'Country',
					'Users' => ['fields' => ['full_name','city','profile_image','facebook_id','slug']],
					])
					->limit(3)
					->order(['Reviews.id' => 'desc'])->toList();
			// Cache::write('reviewList', $reviewList,'longlong');
		}
		
		 /* if (($result = Cache::read('result_'.$slug,'longlong')) === false) { */
			$this->loadModel('CityManager.Continents');
			$result = $this->Continents->find('translations')
				->contain(['Countries'/* ,
				'Casinos' => ['fields' => ['title','avg_rating','image','continent_id','slug']],
				'Casinos.City'=>['fields' => ['name']],
				'Casinos.Country' =>['fields' => ['name']] */
				])
				->where([
					'Continents.slug' => $slug
				])->first();
			// Cache::write('result_'.$slug, $result,'longlong');
		 /* } */
		 
		$this->loadModel('Casinos');
		$query = $this->Casinos->find();
		$this->paginate = [
				'sortWhitelist' => ['address', 'title','phone','country_name','state_name','id'],
				'limit' => 10,
				/* 'sort' => 'id', */
				/* 'direction' => 'desc', */
				'contain' => ['City','Country']
			];
			
		$query->where(['Casinos.continent_id' => $result->id]);

		$casinosData = $this->paginate($query);
		
		 // pr($result);
		$slugName	=	'continenent';
		
		$pageTitle	=	$result->page_title;
		$metaDescription	=	$result->meta_description;
		$this->set(compact('result','slug','slugName','reviewList','promotions','pageTitle','metaDescription','casinosData'));		
		$this->render('continenent');
    }
		
	function africa(){
		$this->continenent('africa');
	}
	function asia(){
		$this->continenent('asia');
	}
	function europe(){
		$this->continenent('europe');
	}
	public function northAmericaAndCaribbean()
    {
		$this->continenent('north-america-and-caribbean');
    }  
	public function southAmerica()
    {
		$this->continenent('south-america');
    }	
	public function australia()
    {
		$this->continenent('australia');

    }
	 public function casinoName($promotionSlug = null)
    {
		if($promotionSlug == null){
			$this->redirect('/');
		}

		$this->loadModel('Promotion.Promotions');
		$casino	=	$this->Promotions->find('all')->select(['url'])->where(['slug' => $promotionSlug])->first();
		
		$url	=	(isset($casino->url)) ? $casino->url  : WEBSITE_URL ;
		if (false === strpos($url, '://')) {
			$url = (isset($casino->url) ? 'http://' . $casino->url : '#');
		}
		$this->redirect($url,301);
    }
	
	function listfollow(){
		// $this->request->allowMethod(['post']);

		if(!empty($this->request->userslug)){
			$userId		=	$this->request->userslug;
			$this->loadModel('UserFollowers');
			
			$UserFollowers = $this->UserFollowers->find('all')->contain([
				'Followers' => ['fields' => ['full_name','profile_image','facebook_id','sex','id','slug']],
				'Followers.UserFollower' => function($q) {
						return $q
						->select(['id','user_id','follower_id'])
						->where(['UserFollower.follower_id' => $this->Auth->user('id')]);
					}
				 ])->where(['UserFollowers.user_id' => $userId])->toList();
			
			
			
			$data['success']	=	true;
			
			$view 				= 	new View();
			$view->viewPath		=	'Element';
			$view->layout		=	false;
			
			$view->set (compact('UserFollowers')); 
			$html				=	$view->render('follower_list');
			
			$data['data']		=	$html;
			
			echo json_encode($data);
			
			exit; 
		}
	}
	
	function reportAsSpam(){
		$this->loadModel('ReviewSpams');
		$user = $this->ReviewSpams->newEntity();
		if ($this->request->is('post')) {
			$this->request->data 	=	$this->sanitizeData($this->request->data);

			$user = $this->ReviewSpams->patchEntity(
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
			$review_id			=	$this->request->data['foreign_key'];
			$type				=	$this->request->data['type'];
			
			$res 				=	$this->ReviewSpams->find('all')->where(['user_id' => $user_id,'review_id' => $review_id,'type' => $type])->first();
			if(!empty($res->id)){
				$user->id		=	$res->id;				
			}
			
			$user->user_id		=	$user_id;
			$user->review_id	=	$this->request->data['foreign_key'];
			$user->type	=	$this->request->data['type'];
			// pr($res);
			$this->ReviewSpams->save($user);
			
			$data['message']	=	__('We have received your request for this review.We will check this review soon.',true);
			$data['success']	=	true;
			echo json_encode($data);
            
			exit;
        }
		exit;
	}
}