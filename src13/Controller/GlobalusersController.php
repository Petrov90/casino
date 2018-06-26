<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Cache\Cache;
use Cake\View\View;
use Cake\Network\Exception\NotFoundException;
use Cake\Event\Event;


class GlobalusersController extends AppController
{
	public function beforeFilter(Event $event)
    {
		
        parent::beforeFilter($event);
        $this->Auth->allow(array('cntributions'));
    }

	public function index(){
		require_once(ROOT .'/vendor/browser/BrowserDetection.php');		
		$browser = new \BrowserDetection();
		// $browser	=	'Safari';
		$this->set('browser',$browser->getName());
	
		$userId			=	$this->Auth->user('id');
		
		
		
		
		$this->loadModel('Users');
		$loginData 	=	$this->Users->get($userId);
		
		$this->loadModel('CityManager.Country');
		$countryList 	=	$this->Country->find('list')->order(['name' => 'asc'])->toList();
		
		$this->loadModel('UserPreference');
		$emailPref 		=	$this->UserPreference->find('all')->where(['user_id' => $userId]);
		$emailPrefArray		=	array();
		$accountPrefArray	=	array();
		foreach($emailPref as $emails){
			if($emails->type == 'email'){
				$emailPrefArray[$emails->key_name]	=	$emails->key_name;				
			}else{
				$accountPrefArray[$emails->key_name]	=	$emails->key_name;								
			}
		}
		
		$pageTitle			=	__('title.dashboard');
		
		$this->set(compact('allCasinos','casinoIvisites','countryList','loginData','reviewList','casinoILikes','allLikesCasinos','accountPref','emailPrefArray','accountPrefArray','emailPref','pageTitle'));
		
		
	}
	function updateprofile(){		
		
		$userId			=	$this->Auth->user('id');
		$this->loadModel('Users');		
		$loginData 	=	$this->Users->get($userId);
		if ($this->request->is(['patch', 'post', 'put'])) { 
			$this->request->data 	=	$this->sanitizeData($this->request->data);

			$loginData = $this->Users->patchEntity(
											$loginData, 
											$this->request->data, 
											[ 'validate' => 'updateProfile']
										); 
			if($loginData->errors()){
				$data['errors']		=	$this->json_error($loginData->errors());
				$data['success']	=	false;
				$data['message']	=	__('Profile could not be update. Please try again',true);
				echo json_encode($data);
				exit;
			}
			
			$loginData->username	=	$this->request->data['email'];
			$this->Users->save($loginData);
			
			Cache::delete('reviewList','longlong');
			$this->request->session()->write('Auth.User', $loginData);
				
			$data['success']	=	true;
			$data['message']	=	__('Profile updated successfully',true);
			echo json_encode($data);
			exit;
		}	
		exit;
	}	
	
	function updatepreference(){		
		$userId			=	$this->Auth->user('id');
		$type			=	$this->request->data['type'];
		$this->loadModel('UserPreference');
		$error			=	1;		
		if(!empty($this->request->data)){
			$this->UserPreference->deleteAll(['user_id' => $userId,'type' => $type]);
			foreach($this->request->data as $key => $val){
				if($val && $key !='type'){
					$userPreference 			= 	$this->UserPreference->newEntity();
					$userPreference->type		=	$type;
					$userPreference->user_id	=	$userId;
					$userPreference->key_name	=	$key;
					$this->UserPreference->save($userPreference);
					$error						=	0;
				}
			}
			
			$emailPref 		=	$this->UserPreference->find('all')->where(['user_id' => $userId,'OR' => [['key_name' => 'who_can_contact_me_all_users'],['key_name' => 'who_can_contact_me_followers']]])->count();
			
			if($emailPref == 0){
				$no_contact	=	1;
			}else{
				$no_contact	=	0;
			}
			
			$emailPref 		=	$this->UserPreference->find('all')->where(['user_id' => $userId,'key_name' => 'who_can_contact_me_followers'])->count();
			
			if($emailPref == 0){
				$myfriend	=	'no';
			}else{
				$myfriend	=	'yes';
			}
			
			$this->loadModel('Users');
			$loginData 	=	$this->Users->get($this->Auth->user('id'));
			$loginData->myfriend	=	$myfriend;
			$loginData->no_contact	=	$no_contact;
			$this->Users->save($loginData);
			
		}
		/* if($error){
			$data['errors']		=	array('error' => __('Please select atleast option',true));
			$data['success']	=	false;
			$data['message']	=	__('Please select atleast one option',true);
			echo json_encode($data);
			exit;
		}else{ */
			$data['success']	=	true;
			$data['message']	=	__('Preference updated successfully',true);
			echo json_encode($data);
			exit;
		/* } */
		exit;
	}	
	function updateprofilepic(){
		if(!empty($this->request->data['data'])){
			require_once(ROOT .'/vendor/browser/BrowserDetection.php');		
			$browser = new \BrowserDetection();
			$browser	=	$browser->getName();
			if($browser == 'Safari'){
				$data			  =		$this->request->data['data'];
				
				$allowed =  array('gif','png' ,'jpg');
				$filename = $data['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!in_array($ext,$allowed) ) {
					$data				=	array();
					$data['title']		=	'Error';			
					$data['type']		=	'error';
					$data['success']	=	false;
					$data['message']	=	__('Please upload valid extension image.Valid extension are gif,png,jpg.',true);
					echo json_encode($data);
					exit;
				}
				
				if(!empty($data)){
					$file_name         						=     $data['name'];
					$tmp_name          						=     $data['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);
					
					if($this->moveUploadedFile($tmp_name, PROFILE_ROOT_PATH.$return_file_name)){
						$fileName							=		$return_file_name;
						
			
						$this->loadModel('Users');
						
						$loginData 	=	$this->Users->get($this->Auth->user('id'));
						$loginData->profile_image	=	$fileName;
						$this->Users->save($loginData);
						
						$this->request->session()->write('Auth.User', $loginData);
						
						$data				=	array();
						$data['title']		=	'Success';
						$data['type']		=	'success';
						$data['success']	=	true;
						$data['src']		=	PROFILE_IMG_URL.$fileName;
						$data['message']	=	__('Image updated successfully',true);
						echo json_encode($data);
						exit;
					}
				}
			}else{
				$data			  =		$this->request->data['data'];
				
				list($type, $data) = 	explode(';', $data);			
				$type			   = 	explode('/', $type);			
				list(, $data)      = 	explode(',', $data);			
				$data 			   =	base64_decode($data);			
				$userName		   =	$this->Auth->user('slug').'_'.time();		
				
				$fileName		   =	$userName.'.'.$type[1];
				$file2			   =	fopen(PROFILE_ROOT_PATH.$fileName,'w');
				
				fwrite($file2,$data);
				fclose($file2);
				
			
				$this->loadModel('Users');
				
				$loginData 	=	$this->Users->get($this->Auth->user('id'));
				$loginData->profile_image	=	$fileName;
				$this->Users->save($loginData);
				
				$this->request->session()->write('Auth.User', $loginData);
				
				$data				=	array();
				$data['title']		=	'Success';
				$data['type']		=	'success';
				$data['success']	=	true;
				$data['src']		=	PROFILE_IMG_URL.$fileName;
				$data['message']	=	__('Image updated successfully',true);
				echo json_encode($data);
				exit;
			}
		}else{
			$data				=	array();
			$data['title']		=	'Error';			
			$data['type']		=	'error';
			$data['success']	=	false;
			$data['message']	=	__('Something going wrong',true);
			echo json_encode($data);
			exit;
		}
		exit;
	}
	
	function cntributions(){
		 $this->request->allowMethod(['post']);
		
		
			$userId				=	isset($this->request->params['pass'][0]) ? $this->request->params['pass'][0]  : $this->Auth->User('id');
			$reviewList			=	$this->reviewList($userId);
			
			$questionList		=	$this->questionList($userId);
			
			$photoList			=	$this->photoList($userId);
			
			$Defaultlanguage	=	$this->request->session()->read('Config.language');			

			$data['success']	=	true;
			$data['message']	=	'Thanks for your valuable comment.';
			
			$view 				= 	new View();
			$view->viewPath		=	'Globalusers';
			$view->layout		=	false;
			
			$view->set (compact('reviewList','questionList','Defaultlanguage','photoList')); 
			$html				=	$view->render('cntributions');
			
			$data['data']		=	$html;
			$data['tot_count']	=	count($questionList)+count($photoList)+count($reviewList);
			
			echo json_encode($data);
		
		exit;
	}
	
	
	function casinolove(){
		
		$this->loadModel('Reviews');
		$this->loadModel('Casinos');
		$this->loadModel('CasinoVisits');
		$this->loadModel('CasinoLikes');
		
		$userId				=	$this->Auth->User('id');
		
		$allCasinos		=	$this->Casinos->find('all')->where(['type' => 'normal'])->notMatching('CasinoVisits', 
							function($q) use ($userId) {
								return $q->where(["CasinoVisits.user_id" => $userId]);
							 })->order(['title' => 'asc'])->limit(20);
		$allCasinosResult			=	array();
		foreach($allCasinos as $key => $casino){
			if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
				$allCasinosResult[$key]['image']	=	WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->image;
			}else{
				$allCasinosResult[$key]['image']	=	WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_CASINO_IMG;					
			}
			$allCasinosResult[$key]['id']	=	$casino->id;
			$allCasinosResult[$key]['title']	=	$casino->title;
			$allCasinosResult[$key]['slug']	=	$casino->slug;
		}
		
		$casinoIvisites	=	$this->CasinoVisits->find('all')->contain([
								'Casinos' =>['fields' => ['id','title','image','review_count','avg_rating','address','slug']],
								'Casinos.City' => ['fields' => ['name','slug']],
								'Casinos.City.Country' => ['fields' => ['slug']]
								])
								->where(['user_id' => $userId]);
								
		$allLikesCasinos	=	$this->Casinos->find('all')->where(['type' => 'online'])->notMatching('CasinoLikes', 
							function($q) use ($userId) {
								return $q->where(["CasinoLikes.user_id" => $userId]);
							})->contain(['MainPromotion' => ['conditions' => ['is_main_promotion' => 1], 'fields' => ['slug']]])
							->order(['Casinos.title' => 'asc'])->limit(20);
		
		$allLikesCasinosResult	=	array();
		foreach($allLikesCasinos as $key => $casino){
			if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){ 
				$allLikesCasinosResult[$key]['image']	=	 WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->image;
			}else{
				$allLikesCasinosResult[$key]['image']	=	 WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_CASINO_IMG;
			}
			$allLikesCasinosResult[$key]['id']		=	$casino->id;
			$allLikesCasinosResult[$key]['title']	=	$casino->title;
			$allLikesCasinosResult[$key]['slug']	=	$casino->slug;
		}
				
		$casinoILikes	=	$this->CasinoLikes->find('all')->contain([
								'Casinos' =>['fields' => ['id','title','image','review_count','avg_rating','url','slug']],
								'Casinos.MainPromotion' => ['conditions' => ['is_main_promotion' => 1], 'fields' => ['slug']]
								])
								->where(['user_id' => $userId]);
		$Defaultlanguage	=	$this->request->session()->read('Config.language');			

		$data['success']	=	true;
		$data['message']	=	'Thanks for your valuable comment.';
		
		$view 				= 	new View();
		$view->viewPath		=	'Globalusers';
		$view->layout		=	false;
		
		$view->set (compact('allCasinos','Defaultlanguage','casinoIvisites','allLikesCasinos','casinoILikes')); 
		$html				=	$view->render('casinolove');
		
		$data['data']		=	$html;
		$data['casinoIvisites']				=	$casinoIvisites->count();
		$data['casinoILikes']				=	$casinoILikes->count();
		$data['casinoIvisitesAllCasino']	=	$allCasinos->count();
		$data['casinoILikesAllCasino']		=	$allLikesCasinos->count();
		$data['allCasinos']					=	$allCasinosResult;
		$data['allCasinosCount']			=	count($allCasinosResult);
		
		$data['allLikesCasinos']					=	$allLikesCasinosResult;
		$data['allLikesCasinosCount']			=	count($allLikesCasinosResult);
		
		echo json_encode($data);
		exit;
	}
	
	
	function uploadImage(){
		$this->loadModel('Users');
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity(
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
				if($this->moveUploadedFile($tmp_name,PROFILE_ROOT_PATH.$return_file_name)){
					$data['message']	=	__('File Uploaded successfully.',true);
					$data['success']	=	true;
					$data['name']		=	 $return_file_name;
					$data['src']		=	 WEBSITE_URL.'image.php?width=200px&height=200px&cropratio=1:1&image='.PROFILE_IMG_URL.$return_file_name;
					
					
					$loginData 	=	$this->Users->get($this->Auth->user('id'));
					$loginData->profile_image	=	$return_file_name;
					$this->Users->save($loginData);
					
					$this->request->session()->write('Auth.User', $loginData);
					
					
					echo json_encode($data);
					exit;
				}
			}
			
		}
	}
	function uploadImageCover(){
		$this->loadModel('Users');
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$user = $this->Users->patchEntity(
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
				if($this->moveUploadedFile($tmp_name,PROFILE_ROOT_PATH.$return_file_name)){
					$data['message']	=	__('File Uploaded successfully.',true);
					$data['success']	=	true;
					$data['name']		=	 $return_file_name;
					$data['src']		=	 WEBSITE_URL.'image.php?width=1263px&height=468px&cropratio=3:1&image='.PROFILE_IMG_URL.$return_file_name;
					
					
					$loginData 	=	$this->Users->get($this->Auth->user('id'));
					$loginData->cover_image	=	$return_file_name;
					$this->Users->save($loginData);
					
					$this->request->session()->write('Auth.User', $loginData);
					
					
					echo json_encode($data);
					exit;
				}
			}
			
		}
	}	
	
	function loadmorevisits($offset){
		$this->loadModel('Casinos');
		
		$userId				=	$this->Auth->User('id');
		
		$allCasinos		=	$this->Casinos->find('all')->where(['type' => 'normal'])->notMatching('CasinoVisits', 
								function($q) use ($userId) {
									return $q->where(["CasinoVisits.user_id" => $userId]);
								 })->order(['title' => 'asc'])->limit(20)->offset($offset)->toList();
		$result			=	array();
		 
		foreach($allCasinos as $key => $casino){
			if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
				$result[$key]['image']	=	WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->image;
			}else{
				$result[$key]['image']	=	WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_CASINO_IMG;					
			}
			$result[$key]['id']	=	$casino->id;
			$result[$key]['title']	=	$casino->title;
			$result[$key]['slug']	=	$casino->slug;
		}		 
		echo json_encode(array('data' => $result,'count' => count($result)));
		exit;
	}
	
	function casinoSearch($search = null){
		$this->loadModel('Casinos');
		
		$userId				=	$this->Auth->User('id');
		if(!empty($search)){
			$con		=	['type' => 'normal','title LIKE' => "%".$search."%" ];
		}else{
			$con		=	['type' => 'normal'];
		}
		
		$allCasinos		=	$this->Casinos->find('all')->where($con)->notMatching('CasinoVisits', 
								function($q) use ($userId) {
									return $q->where(["CasinoVisits.user_id" => $userId]);
								 })->order(['title' => 'asc'])->limit(20)->toList();
		$result			=	array();
		 
		foreach($allCasinos as $key => $casino){
			if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
				$result[$key]['image']	=	WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->image;
			}else{
				$result[$key]['image']	=	WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_CASINO_IMG;					
			}
			$result[$key]['id']	=	$casino->id;
			$result[$key]['title']	=	$casino->title;
			$result[$key]['slug']	=	$casino->slug;
		}		 
		echo json_encode(array('data' => $result,'count' => count($result)));
		exit;
	}
	
	function loadmorelikess($offset){
		$this->loadModel('Casinos');
		
		$userId				=	$this->Auth->User('id');
		
		$allLikesCasinos	=	$this->Casinos->find('all')->where(['type' => 'online'])->notMatching('CasinoLikes', 
							function($q) use ($userId) {
								return $q->where(["CasinoLikes.user_id" => $userId]);
							})->contain(['MainPromotion' => ['conditions' => ['is_main_promotion' => 1], 'fields' => ['slug']]])
							->order(['Casinos.title' => 'asc'])->offset($offset)->limit(15);
							
							
		$result			=	array();
		 
		foreach($allLikesCasinos as $key => $casino){
			if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){
				$result[$key]['image']	=	WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->image;
			}else{
				$result[$key]['image']	=	WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_CASINO_IMG;					
			}
			$result[$key]['id']	=	$casino->id;
			$result[$key]['title']	=	$casino->title;
			$result[$key]['slug']	=	$casino->slug;
		}		 
		echo json_encode(array('data' => $result,'count' => count($result)));
		exit;
	}	
	
	function casinoLikeSearch($search=null){
		$this->loadModel('Casinos');
		
		$userId				=	$this->Auth->User('id');
		
		if(!empty($search)){
			$con		=	['type' => 'online','Casinos.title LIKE' => "%".$search."%" ];
		}else{
			$con		=	['type' => 'online'];
		}
		
		$allLikesCasinos	=	$this->Casinos->find('all')->where($con)->notMatching('CasinoLikes', 
							function($q) use ($userId) {
								return $q->where(["CasinoLikes.user_id" => $userId]);
							})->contain(['MainPromotion' => ['conditions' => ['is_main_promotion' => 1], 'fields' => ['slug']]])
							->order(['Casinos.title' => 'asc'])->limit(20);
		
		$allLikesCasinosResult	=	array();
		foreach($allLikesCasinos as $key => $casino){
			if(!empty($casino->image) && file_exists(CASINO_FULL_IMG_ROOT_PATH.$casino->image)){ 
				$allLikesCasinosResult[$key]['image']	=	 WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.CASINO_FULL_IMG_URL.$casino->image;
			}else{
				$allLikesCasinosResult[$key]['image']	=	 WEBSITE_URL.'image.php?width=100px&height=100px&cropratio=1:1&image='.NO_CASINO_IMG;
			}
			$allLikesCasinosResult[$key]['id']		=	$casino->id;
			$allLikesCasinosResult[$key]['title']	=	$casino->title;
			$allLikesCasinosResult[$key]['slug']	=	$casino->slug;
		}
		
		echo json_encode(array('data' => $allLikesCasinosResult,'count' => count($allLikesCasinosResult)));
		exit;
	}
}