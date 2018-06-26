<?php
namespace App\Controller\Admin;

use Cake\Utility\Inflector;
use App\Controller\Admin\AppController;
// use Cake\Event\Event;

use Cake\Core\Configure;
/**
 * Casinos Controller
 *
 * @property \App\Model\Table\CasinosTable $Casinos
 */
class CasinosController extends AppController
{

	
	public $components = ['Paginator'];
	
	
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->clearCache();
        $query = $this->Casinos->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where([$name.' LIKE' => '%'.$value.'%']);			
		
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = [
				'sortWhitelist' => ['address', 'title','phone','country_name','state_name','id'],
				'limit' => Configure::read('Reading.record_per_page'),
				'sort' => 'id',
				'direction' => 'desc'
			];
		
		$query->where(['type' => 'normal']);
		
		// $query->order(['Casinos.id' => 'desc']);
        $casinos = $this->paginate($query);
        $this->set(compact('casinos'));
        $this->set('_serialize', ['casinos']);
		$this->set('model',$this->modelClass);
	}
	
 /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function casino()
    {
	   $this->clearCache();
       $query = $this->Casinos->find();
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
					continue;
				$query->where([$name.' LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		$this->paginate = ['sortWhitelist' => ['address', 'title','email','country_name','state_name'],'limit' => Configure::read('Reading.record_per_page'),
			'order' => [
				'Casinos.id' => 'desc'
			]];
		$query->where(['type' => 'online']);
		$query->order(['Casinos.id' => 'desc']);
		$casinos = $this->paginate($query);
		
        $this->set(compact('casinos'));
        $this->set('_serialize', ['casinos']);
		$this->set('model',$this->modelClass);
	}


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$casino = $this->Casinos->newEntity();		
        if ($this->request->is('post')) {
			$this->Casinos->type ='normal';
			$casino 	= 	$this->Casinos->patchEntity($casino, $this->request->data);
			if(!$casino->errors()){
				
				$this->loadModel('CasinoImages');
				$object_id	=	$casino->object_id;
				$image		=	$this->CasinoImages->find('all')->where(array('object_id' => $object_id))->order(['display_order' => 'ASC'])->first();
				if(!empty($image->file)){
					$casino->image	=	$image->file;					
				}
				$casino->type	=	'normal';
				
				$address		=	$casino->address.' '.$casino->city_name.' '.$casino->country_name;
				
				$zip				=	$this->getLnt($address);				
				$casino->latitude	=	(isset($zip['lat']) ? $zip['lat'] : '');
				$casino->longitude	=	(isset($zip['lng']) ? $zip['lng'] : '');
				
				if(!empty($this->request->data['country_id'])){
					$this->loadModel('CityManager.Country');
					$continentId	=	$this->Country->find('all')->where(['id' => $this->request->data['country_id']])->first();
					$casino->continent_id	=	$continentId->continent_id;
				}
				// $casino->avg_rating		=	$casino->our_rating;
				
				$casino->contact_schedule	=	json_encode($this->request->data['contact_schedule']);
				$casino->poker_schedule	=	json_encode($this->request->data['poker_schedule']);
				$casino->bo_schedule	=	json_encode($this->request->data['bo_schedule']);
				$casino->gs_schedule	=	json_encode($this->request->data['gs_schedule']);
				$casino->cf_schedule	=	json_encode($this->request->data['cf_schedule']);
				
				$this->Casinos->save($casino);
				$casino_id	=	$casino->id;		
				/* 
				if(!empty($casino->review)){				
					$this->loadModel('Reviews');
					$review	 = 	$this->Reviews->newEntity();
					$review->user_id		=	$userId	=	$this->Auth->user('id');				
					$review->language		=	DEFAULT_LANG;
					$review->type			=	'casino';
					$review->foreign_key	=	$casino_id;
					$review->rating			=	$casino->our_rating;
					$review->comment		=	$casino->review;
					
					$this->Reviews->save($review);
				} */
				
				$casinoActivities	=	$casino->casinoActivities;
			
				if(!empty($casinoActivities)){
					foreach($casinoActivities as $pkey => $val){
						if(is_array($val)){
							foreach($val as $key => $val){
								if($val){							
									$casinoAmenities 	= 	$this->Casinos->CasinoActivityDatas->newEntity();
									$casinoAmenities->casino_id	=	$casino_id;
									$casinoAmenities->casino_activity_id	=	$key;
									$casinoAmenities->parent_id	=	$pkey;
									$this->Casinos->CasinoActivityDatas->save($casinoAmenities);
								}
							}
						}
					}
				}
				
				$gambling_options	=	$casino->gambling_options;
				if(!empty($gambling_options)){
					foreach($gambling_options as $key => $val){
						if($val && $key > 0){
							$CasinoGamblingOptions 				= 	$this->Casinos->CasinoGamblingOptions->newEntity();
							$CasinoGamblingOptions->casino_id	=	$casino_id;
							$CasinoGamblingOptions->master_id	=	$key;
							$this->Casinos->CasinoGamblingOptions->save($CasinoGamblingOptions);
						}
					}
				}
				
				/* $casinoActivities	=	$casino->casinoActivities;
				if(!empty($casinoActivities)){
					foreach($casinoActivities as $key => $val){
						if($val && $key > 0){
							$CasinoGamblingOptions 				= 	$this->Casinos->CasinoActivityDatas->newEntity();
							$CasinoGamblingOptions->casino_id	=	$casino_id;
							$CasinoGamblingOptions->casino_activity_id	=	$key;
							$this->Casinos->CasinoActivityDatas->save($CasinoGamblingOptions);
						}
					}
				} */
				
				$this->Flash->success(__('The casino has been saved.'));
				return $this->redirect(['action' => 'index']);
				
			}else{
				
				$this->Flash->error(__('The casino could not be saved. Please, try again.'));
			}
        }
		
		$gambling_options	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'gambling_options','is_deleted' => 0]]);
		
		$country			 =	 $this->Casinos->Country->find('list')->order(['name' => 'asc']);
		$this->loadModel('CasinoActivities.CasinoActivities');
		
		// $casinoActivities			 =	 $this->CasinoActivities->find('list')->where(['is_deleted' => 0])->order(['title' => 'asc']);
		// pr($casinoActivities);
		
		
		$casinoActivities			 =	 $this->CasinoActivities->find('all', ['contain' => ['ChildMasters'],'conditions' => ['parent_id' => 0,'is_deleted' => 0]]);
		
		
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file
		
		$this->set(compact('casino','amenities','gambling_options','country','casinoActivities'));
        $this->set('_serialize', ['casino']);
		$this->set('model',$this->modelClass);
    }
	
	
 /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function casino_add()
    {
		$this->loadModel('Languages');
		$allLang	=	$this->Languages->find('all');		
		foreach($allLang as $lang){
			@unlink(CACHE.'cake_element__online_casino_search_side_bar_'.$lang->code.'_cache_callbacks');		
			@unlink(CACHE.'cake_element__promotion_search_side_bar_'.$lang->code.'_cache_callbacks');		
		}
		
		$casino = $this->Casinos->newEntity();
		$masterCasino	=	$this->request->data;
        if ($this->request->is('post')) {
            $casino 	= 	$this->Casinos->patchEntity($casino, $this->request->data);
			if(!$casino->errors()){
				$casino->type	=	'online';
				
				$thisData		=	$this->request->data;
				
				if(!empty($thisData['logo']['name'])){
					$file_name         						=     $thisData['logo']['name'];
					$tmp_name          						=     $thisData['logo']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);
					
					if($this->moveUploadedFile($tmp_name, CASINO_THUMB_IMG_ROOT_PATH.$return_file_name)){
						$this->copyUploadedFile(CASINO_THUMB_IMG_ROOT_PATH.$return_file_name, CASINO_FULL_IMG_ROOT_PATH.$return_file_name);
						$casino->image						=		$return_file_name;
					}
				}
				
				if(!empty($thisData['pros'])){
					$casino->pros	=	json_encode($thisData['pros']);
				}
				if(!empty($thisData['cons'])){
					$casino->cons	=	json_encode($thisData['cons']);
				}
				
				$min1	 	 =	$thisData['min_time'];
				$min2	 	 =	$thisData['type1'];
				$min3	 	 =	$thisData['max_time'];
				$min4	 	 =	$thisData['type2'];				
				if($min2 == 'hour'){
					$casino->p_min = $min1*3600;
				}else{
					$casino->p_min = $min1*3600*24;
				}
				
				if($min4 == 'hour'){
					$casino->p_max = $min3*3600;
				}else{
					$casino->p_max = $min3*3600*24;
				}
				
				$casino->avg_rating		=	$casino->our_rating;		
				$this->Casinos->save($casino);
				$casino_id	=	$casino->id;
				
			/* 	if(!empty($casino->review)){				
					$this->loadModel('Reviews');
					$review	 = 	$this->Reviews->newEntity();
					$review->user_id		=	$userId	=	$this->Auth->user('id');				
					$review->language		=	DEFAULT_LANG;
					$review->type			=	'casino';
					$review->foreign_key	=	$casino_id;
					$review->rating			=	$casino->our_rating;
					$review->comment		=	$casino->review;
					
					$this->Reviews->save($review);
				}
				 */
				if(!empty($masterCasino['country_id1'])){
					$country_id	=	$masterCasino['country_id1'];
					foreach($country_id as $key => $val){
						if($val > 0){
							$RestricatedCountries 				= 	$this->Casinos->RestricatedCountries->newEntity();
							$RestricatedCountries->casino_id	=	$casino_id;
							$RestricatedCountries->country_id	=	$key;
							$this->Casinos->RestricatedCountries->save($RestricatedCountries);
						}
					}
				}
				if(!empty($masterCasino['gambling_options'])){
					$gambling_options	=	$masterCasino['gambling_options'];
					foreach($gambling_options as $key => $val){
						if($val && $key > 0){
							$CasinoGamblingOptions 				= 	$this->Casinos->CasinoGamblingOptions->newEntity();
							$CasinoGamblingOptions->casino_id	=	$casino_id;
							$CasinoGamblingOptions->master_id	=	$key;
							$this->Casinos->CasinoGamblingOptions->save($CasinoGamblingOptions);
						}
					}
				}	
				
				if(!empty($masterCasino['devices'])){
					$devices	=	$masterCasino['devices'];
					foreach($devices as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 				= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;
							$CasinoSoftware->type		=	'devices';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				if(!empty($masterCasino['currencies'])){
					$currencies	=	$masterCasino['currencies'];
					foreach($currencies as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 				= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;
							$CasinoSoftware->type		=	'currencies';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				if(!empty($masterCasino['language'])){
					$language	=	$masterCasino['language'];
					foreach($language as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 				= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;
							
							$CasinoSoftware->type		=	'language';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				if(!empty($masterCasino['software'])){
					$software	=	$masterCasino['software'];
					foreach($software as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 				= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;
							$CasinoSoftware->type		=	'software';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				if(!empty($masterCasino['deposit_methods'])){
					$deposit_methods	=	$masterCasino['deposit_methods'];
					foreach($deposit_methods as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 				= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;
							$CasinoSoftware->type		=	'deposit_methods';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				
				if(!empty($masterCasino['withdrawal_methods'])){
					$withdrawal_methods	=	$masterCasino['withdrawal_methods'];
					foreach($withdrawal_methods as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 			= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;							
							$CasinoSoftware->type		=	'withdrawal_methods';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				if(!empty($masterCasino['licences'])){
					$licences	=	$masterCasino['licences'];
					foreach($licences as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 			= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;							
							$CasinoSoftware->type		=	'licences';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				if(!empty($masterCasino['withdrawal_limit'])){
					$withdrawal_limit	=	$masterCasino['withdrawal_limit'];
					foreach($withdrawal_limit as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 			= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;
							$CasinoSoftware->type		=	'withdrawal_limit';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				$this->Flash->success(__('The casino has been saved.'));
				return $this->redirect(['action' => 'casino']);
			}else{
				
				$this->Flash->error(__('The casino could not be saved. Please, try again.'));
			}
        }
		$gambling_options	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'gambling_options','is_deleted' => 0]]);
		
		$devices			 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'devices','is_deleted' => 0]]);
		$software			 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'software','is_deleted' => 0]]);
		$deposit_methods	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'deposit_methods','is_deleted' => 0]]);
		$currencies			 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'currencies','is_deleted' => 0]]);
		$language			 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'language','is_deleted' => 0]]);
		$withdrawal_methods	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'withdrawal_methods','is_deleted' => 0]]);
		$withdrawal_limit	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'withdrawal_limit','is_deleted' => 0]]);
		$owner				 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'owner','is_deleted' => 0]]);
		$manual_flushing	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'manual_flushing','is_deleted' => 0]]);
		$live_chat			 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'live_chat','is_deleted' => 0]]);
		$licences			 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'licences','is_deleted' => 0]]);
		
		$country			 =	 $this->Casinos->Country->find('list')->order(['name' => 'asc']);
		
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file

		$this->set(compact('casino','amenities','gambling_options','country','software','deposit_methods','currencies','language','withdrawal_methods','withdrawal_limit','owner','manual_flushing','live_chat','licences','devices'));
		
		$this->set('model',$this->modelClass);
    }

	/**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function casino_edit($id)
    {
		$this->loadModel('Languages');
		$allLang	=	$this->Languages->find('all');		
		foreach($allLang as $lang){
			@unlink(CACHE.'cake_element__online_casino_search_side_bar_'.$lang->code.'_cache_callbacks');		
			@unlink(CACHE.'cake_element__promotion_search_side_bar_'.$lang->code.'_cache_callbacks');		
		}
		 $casino =	$res	= $this->Casinos->get($id, [
            'contain' => [
				/* 'Reviews' => ['conditions' => ['user_id' => $this->Auth->User('id')]], */
				'RestricatedCountries',
				'CasinoGamblingOptions' => function($q) {
						 return $q->select(['master_id','casino_id']);
					},
				'CasinoSoftware' => function($q) {
						 return $q->select(['master_id','casino_id','type']);
					},
			]
        ]);
		// pr($casino);
		$logo 	=	$res->image;
		$member_rating 	=	$res->member_rating;
		
		$masterCasino	=	$this->request->data;
        if ($this->request->is(['patch', 'post', 'put'])) { //pr($this->request->data);die;
            $casino 	= 	$this->Casinos->patchEntity($casino, $this->request->data);
			
			if(!$casino->errors()){
				
				$casino->type	=	'online';
				
				$thisData		=	$this->request->data;
				if(!empty($thisData['logo']['name'])){
					$file_name         						=     $thisData['logo']['name'];
					$tmp_name          						=     $thisData['logo']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);
					
					if($this->moveUploadedFile($tmp_name, CASINO_THUMB_IMG_ROOT_PATH.$return_file_name)){
						$this->copyUploadedFile(CASINO_THUMB_IMG_ROOT_PATH.$return_file_name, CASINO_FULL_IMG_ROOT_PATH.$return_file_name);
						$casino->image						=		$return_file_name;
					}
				}else{
					$casino->image							=		$logo;
				}
				
				if(!empty($thisData['pros'])){
					$casino->pros	=	json_encode($thisData['pros']);
				}
				if(!empty($thisData['cons'])){
					$casino->cons	=	json_encode($thisData['cons']);
				}
				$min1	 	 =	$thisData['min_time'];
				$min2	 	 =	$thisData['type1'];
				$min3	 	 =	$thisData['max_time'];
				$min4	 	 =	$thisData['type2'];				
				if($min2 == 'hour'){
					$casino->p_min = $min1*3600;
				}else{
					$casino->p_min = $min1*3600*24;
				}
				
				if($min4 == 'hour'){
					$casino->p_max = $min3*3600;
				}else{
					$casino->p_max = $min3*3600*24;
				}
				
				if(!empty($member_rating)){
					$this->loadModel('Reviews');
					$res	=	$this->Reviews->find('all')->where(['type' => 'casino','foreign_key' => $casino->id]);
					
					$count	=	$res->count();
					$sum	=	$res->sumOf('rating');
					$avg	=	$sum/$count;
					
					$avg_rating				=	($avg + $casino->our_rating)/2;
					$casino->avg_rating		=	$avg_rating;
				}else{
					$casino->avg_rating		=	$casino->our_rating;
				}
					
				// pr($casino);die;
				$this->Casinos->save($casino);
				$casino_id	=	$casino->id;			
				
			/* 	if(!empty($casino->review)){				
					$this->loadModel('Reviews');
					if(!empty($res->reviews)){
						$review	 = 	$this->Reviews->find('all')->where(['foreign_key' => $casino_id,'user_id' => $this->Auth->user('id')])->first();
					}else{
						
						$review	 = 	$this->Reviews->newEntity();
						$review->user_id		=	$userId	=	$this->Auth->user('id');				
						$review->language		=	DEFAULT_LANG;
						$review->type			=	'casino';
						$review->foreign_key	=	$casino_id;
					
					}
					$review->rating			=	$casino->our_rating;
					$review->comment		=	$casino->review;
					$this->Reviews->save($review);
					
				} */
				
				
				$gambling_options	=	$casino->gambling_options;
				$this->Casinos->CasinoGamblingOptions->deleteAll(['casino_id' => $casino_id]);
				if(!empty($gambling_options)){
					foreach($gambling_options as $key => $val){
						if($val && $key > 0){
							$CasinoGamblingOptions 				= 	$this->Casinos->CasinoGamblingOptions->newEntity();
							$CasinoGamblingOptions->casino_id	=	$casino_id;
							$CasinoGamblingOptions->master_id	=	$key;
							$this->Casinos->CasinoGamblingOptions->save($CasinoGamblingOptions);
						}
					}
				}
				
				$this->Casinos->RestricatedCountries->deleteAll(['casino_id' => $casino_id]);				
				if(!empty($masterCasino['country_id1'])){
					$country_id	=	$masterCasino['country_id1'];
					foreach($country_id as $key => $val){
						if($val > 0){
							$RestricatedCountries 				= 	$this->Casinos->RestricatedCountries->newEntity();
							$RestricatedCountries->casino_id	=	$casino_id;
							$RestricatedCountries->country_id	=	$key;
							$this->Casinos->RestricatedCountries->save($RestricatedCountries);
						}
					}
				}
				
				
				
				$this->Casinos->CasinoSoftware->deleteAll(['casino_id' => $casino_id]);
				
				if(!empty($masterCasino['devices'])){
					$devices	=	$masterCasino['devices'];					
					foreach($devices as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 				= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;
							$CasinoSoftware->type		=	'devices';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				if(!empty($masterCasino['currencies'])){
					$currencies	=	$masterCasino['currencies'];
					foreach($currencies as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 				= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;
							$CasinoSoftware->type		=	'currencies';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				if(!empty($masterCasino['language'])){
					$language	=	$masterCasino['language'];
					foreach($language as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 				= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;
							
							$CasinoSoftware->type		=	'language';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				if(!empty($masterCasino['software'])){
					$software	=	$masterCasino['software'];
					
					foreach($software as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 				= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;
							$CasinoSoftware->type		=	'software';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				if(!empty($masterCasino['deposit_methods'])){
					$deposit_methods	=	$masterCasino['deposit_methods'];
					foreach($deposit_methods as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 				= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;
							$CasinoSoftware->type		=	'deposit_methods';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				if(!empty($masterCasino['withdrawal_methods'])){
					$withdrawal_methods	=	$masterCasino['withdrawal_methods'];
					foreach($withdrawal_methods as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 			= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;							
							$CasinoSoftware->type		=	'withdrawal_methods';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				if(!empty($masterCasino['licences'])){
					$licences	=	$masterCasino['licences'];
					foreach($licences as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 			= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;							
							$CasinoSoftware->type		=	'licences';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				if(!empty($masterCasino['withdrawal_limit'])){
					$withdrawal_limit	=	$masterCasino['withdrawal_limit'];
					foreach($withdrawal_limit as $key => $val){
						if($val && $key > 0){
							$CasinoSoftware 			= 	$this->Casinos->CasinoSoftware->newEntity();
							$CasinoSoftware->casino_id	=	$casino_id;
							$CasinoSoftware->master_id	=	$key;
							$CasinoSoftware->type		=	'withdrawal_limit';
							$this->Casinos->CasinoSoftware->save($CasinoSoftware);
						}
					}
				}
				
				$this->Flash->success(__('The casino has been updated.'));
				return $this->redirect(['action' => 'casino']);
			}else{
				
				$this->Flash->error(__('The casino could not be saved. Please, try again.'));
			}
        }
		
		$gambling_options	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'gambling_options','is_deleted' => 0]]);
		$software			 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'software','is_deleted' => 0]]);
		$devices			 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'devices','is_deleted' => 0]]);
		$deposit_methods	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'deposit_methods','is_deleted' => 0]]);
		$currencies			 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'currencies','is_deleted' => 0]]);
		$language			 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'language','is_deleted' => 0]]);
		$withdrawal_methods	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'withdrawal_methods','is_deleted' => 0]]);
		$withdrawal_limit	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'withdrawal_limit','is_deleted' => 0]]);
		
		$owner				 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'owner','is_deleted' => 0]]);
		$manual_flushing	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'manual_flushing','is_deleted' => 0]]);
		$live_chat			 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'live_chat','is_deleted' => 0]]);
		$licences			 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'licences','is_deleted' => 0]]);
		
		
		$country			 =	 $this->Casinos->Country->find('list')->order(['name' => 'asc']);
		
		
		$casino_gambling_options	=	'';
		if(!empty($casino->casino_gambling_options)){
			foreach($casino->casino_gambling_options as $cmaster_id){
				$casino_gambling_options[$cmaster_id->master_id]	=	$cmaster_id->master_id;
			}
		} 	
		
		$restricated_countries	=	'';
		if(!empty($casino->restricated_countries)){
			foreach($casino->restricated_countries as $coun){
				$restricated_countries[$coun->country_id]	=	$coun->country_id;
			}
		}
		
		$casino_software			=	'';
		$casino_withdrawal_limit	=	'';
		$casino_withdrawal_methods	=	'';
		$casino_language			=	'';
		$casino_currencies			=	'';
		$casino_deposit_methods		=	'';
		$casino_devices				=	'';
		$casino_licences			=	'';
		// pr($restricated_countries);
		if(!empty($casino->casino_software)){
			foreach($casino->casino_software as $cmaster_id){
				if($cmaster_id->type == 'devices'){
					$casino_devices[$cmaster_id->master_id]			=	$cmaster_id->master_id;					
				}
				if($cmaster_id->type == 'software'){
					$casino_software[$cmaster_id->master_id]			=	$cmaster_id->master_id;					
				}
				if($cmaster_id->type == 'withdrawal_limit'){
					$casino_withdrawal_limit[$cmaster_id->master_id]	=	$cmaster_id->master_id;
				}
				if($cmaster_id->type == 'withdrawal_methods'){
					$casino_withdrawal_methods[$cmaster_id->master_id]	=	$cmaster_id->master_id;
				}
				if($cmaster_id->type == 'language'){
					$casino_language[$cmaster_id->master_id]			=	$cmaster_id->master_id;
				}
				if($cmaster_id->type == 'currencies'){
					$casino_currencies[$cmaster_id->master_id]			=	$cmaster_id->master_id;
				}
				if($cmaster_id->type == 'deposit_methods'){
					$casino_deposit_methods[$cmaster_id->master_id]			=	$cmaster_id->master_id;
				}
				if($cmaster_id->type == 'licences'){
					$casino_licences[$cmaster_id->master_id]			=	$cmaster_id->master_id;
				}
			}
		} 
		
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file

		$this->set(compact('casino','amenities','gambling_options','country','software','deposit_methods','currencies','language','withdrawal_methods','withdrawal_limit','casino_gambling_options','casino_software','casino_withdrawal_limit','casino_withdrawal_methods','casino_language','casino_currencies','casino_deposit_methods','restricated_countries','owner','manual_flushing','live_chat','licences','devices','casino_devices','casino_licences'));
		
		$this->set('model',$this->modelClass);
    }

    /**
     * Edit method
     *
     * @param string|null $id Casino id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$casino =	$res	= $this->Casinos->get($id, [
            'contain' => [
				 'City.Country',/*'Reviews' => ['conditions' => ['user_id' => $this->Auth->User('id')]], */
				/* 'CasinoAmenities'  => function($q) {
						 return $q->select(['master_id','casino_id']);
					}, */
				'CasinoGamblingOptions' => function($q) {
						 return $q->select(['master_id','casino_id']);
					},
				'CasinoActivityDatas' => function($q) {
						 return $q->select(['casino_activity_id','casino_id']);
					}
			]
        ]);
		
		// $avg_rating 	=	$res->member_rating;
        if ($this->request->is(['patch', 'post', 'put'])) {
			$this->Casinos->type ='normal';
						
            $casino 	= $this->Casinos->patchEntity($casino, $this->request->data);
			
			if(!$casino->errors()){
				$thisData	=	$this->request->data;
				
				$this->loadModel('CasinoImages');
				$object_id	=		$casino->object_id;
				$image		=		$this->CasinoImages->find('all')->where(array('object_id' => $object_id))->order(['display_order' => 'ASC'])->first();
				if(!empty($image->file)){
					$casino->image	=	$image->file;
				}else{
					$casino->image	=	'';
				}
				
				$address		=	$casino->address.' '.$casino->city_name.' '.$casino->country_name;
				
				$zip				=	$this->getLnt($address);				
				$casino->latitude	=	(isset($zip['lat']) ? $zip['lat'] : '');
				$casino->longitude	=	(isset($zip['lng']) ? $zip['lng'] : '');
				
					
				if(!empty($this->request->data['country_id'])){
					$this->loadModel('CityManager.Country');
					$continentId	=	$this->Country->find('all')->where(['id' => $this->request->data['country_id']])->first();
					$casino->continent_id	=	$continentId->continent_id;
				}
				
				if(empty($avg_rating)){
					// $casino->avg_rating	=	$casino->our_rating;
				}
				
				$casino->contact_schedule	=	json_encode($this->request->data['contact_schedule']);
				$casino->poker_schedule	=	json_encode($this->request->data['poker_schedule']);
				$casino->bo_schedule	=	json_encode($this->request->data['bo_schedule']);
				$casino->gs_schedule	=	json_encode($this->request->data['gs_schedule']);
				$casino->cf_schedule	=	json_encode($this->request->data['cf_schedule']);
				// pr($casino->contact_schedule);die;
				$this->Casinos->save($casino);
				$casino_id			=	$id;
				/* if(!empty($casino->review)){				
					$this->loadModel('Reviews');
					if(!empty($res->reviews)){
						$review	 = 	$this->Reviews->find('all')->where(['foreign_key' => $casino_id,'user_id' => $this->Auth->user('id')])->first();
					}else{
						$review	 = 	$this->Reviews->newEntity();
						$review->user_id		=	$userId	=	$this->Auth->user('id');				
						$review->language		=	DEFAULT_LANG;
						$review->type			=	'casino';
						$review->foreign_key	=	$casino_id;
					}
					$review->rating			=	$casino->our_rating;
					$review->comment		=	$casino->review;
					$this->Reviews->save($review);
				} */
				
				$amenities			=	$casino->casinoActivities;
				$this->Casinos->CasinoActivityDatas->deleteAll(['casino_id' => $casino_id]);
				if(!empty($amenities)){				
					foreach($amenities as $pkey => $val){
						if(is_array($val)){
							foreach($val as $key => $val){
								if($val){										
									$casinoAmenities 	= 	$this->Casinos->CasinoActivityDatas->newEntity();
									$casinoAmenities->casino_id	=	$casino_id;
									$casinoAmenities->casino_activity_id	=	$key;
									$casinoAmenities->parent_id	=	$pkey;
									$this->Casinos->CasinoActivityDatas->save($casinoAmenities);
								}
							}
						}
					}
				}
				
				$gambling_options	=	$casino->gambling_options;
				$this->Casinos->CasinoGamblingOptions->deleteAll(['casino_id' => $casino_id]);
				if(!empty($gambling_options)){
					foreach($gambling_options as $key => $val){
						if($val){
							$CasinoGamblingOptions 				= 	$this->Casinos->CasinoGamblingOptions->newEntity();
							$CasinoGamblingOptions->casino_id	=	$casino_id;
							$CasinoGamblingOptions->master_id	=	$key;
							$this->Casinos->CasinoGamblingOptions->save($CasinoGamblingOptions);
						}
					}
				}
				
				/* $gambling_options	=	$casino->casinoActivities;
				$this->Casinos->CasinoActivityDatas->deleteAll(['casino_id' => $casino_id]);
				if(!empty($gambling_options)){
					foreach($gambling_options as $key => $val){
						if($val){
							$CasinoGamblingOptions 				= 	$this->Casinos->CasinoActivityDatas->newEntity();
							$CasinoGamblingOptions->casino_id	=	$casino_id;
							$CasinoGamblingOptions->casino_activity_id	=	$key;
							$this->Casinos->CasinoActivityDatas->save($CasinoGamblingOptions);
						}
					}
				} */
				
				$this->Flash->success(__('The casino has been updated.'));
				return $this->redirect(['action' => 'index']);
				
			}else{
				
				$this->Flash->error(__('The casino could not be saved. Please, try again.'));
			}
        }
		
		$casino_gambling_options	=	'';
		if(!empty($casino->casino_gambling_options)){
			foreach($casino->casino_gambling_options as $cmaster_id){
				$casino_gambling_options[$cmaster_id->master_id]	=	$cmaster_id->master_id;
			}
		}
		
		$casino_activity_datas	=	'';
		if(!empty($casino->casino_activity_datas)){
			foreach($casino->casino_activity_datas as $cmaster_id){
				$casino_activity_datas[$cmaster_id->casino_activity_id]	=	$cmaster_id->casino_activity_id;
			}
		} 
		/* 
		$casino_amenities	=	'';
		if(!empty($casino->casino_amenities)){
			foreach($casino->casino_amenities as $amaster_id){
				$casino_amenities[$amaster_id->master_id]		=	$amaster_id->master_id;
			}
		} */
		
		$this->loadModel('CasinoActivities.CasinoActivities');		
		$casinoActivities			 =	 $this->CasinoActivities->find('all', ['contain' => ['ChildMasters'],'conditions' => ['parent_id' => 0,'is_deleted' => 0]]);
		
		$gambling_options	 =	 $this->Casinos->Masters->find('list', ['conditions' => ['type' => 'gambling_options','is_deleted' => 0]]);
		
		
		$country			 =	 $this->Casinos->Country->find('list')->order(['name' => 'asc']);
		
		require_once('uploader/config.php');   //Config
		require_once('uploader/Uploader.php'); //Main php file
		// pr($casino);
		
		$this->request->data['contact_schedule']	= 	json_decode($casino->contact_schedule,true);
		$this->request->data['gs_schedule']	= 	json_decode($casino->gs_schedule,true);
		$this->request->data['poker_schedule']	= 	json_decode($casino->poker_schedule,true);
		$this->request->data['bo_schedule']	= 	json_decode($casino->bo_schedule,true);
		$this->request->data['cf_schedule']	= 	json_decode($casino->cf_schedule,true);
			
		$this->set(compact('casino','amenities','gambling_options','country','casino_amenities','casino_gambling_options','casino_activity_datas','casinoActivities'));
        $this->set('_serialize', ['casino']);
		
		$this->set('model',$this->modelClass);
    }
	
	function slugable($slug, $controller = 'Casinos', $type = 'add'){		
		$slug		=	Inflector::slug($slug);
		$result		=	$this->{$controller}->find('all')->where(array('slug LIKE ' => $slug."%"))->order(['id' => 'DESC'])->count();
		
		if($result > 0){
			return $slug.'-'.($result);
		}
		return $slug;
	}
	
    /**
     * Delete method
     *
     * @param string|null $id Casino id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $casino = $this->Casinos->get($id);
        if ($this->Casinos->delete($casino)) {
			
			$this->Casinos->Promotions->deleteAll(['casino_id' => $id]);
			$this->Casinos->PopularCasinos->deleteAll(['casino_id' => $id]);
			$this->Casinos->Reviews->deleteAll(['foreign_key' => $id,'type' => 'casino']);

            $this->Flash->success(__('The casino has been deleted.'));
        } else {
            $this->Flash->error(__('The casino could not be deleted. Please, try again.'));
        }
		$this->loadModel('Languages');
		$allLang	=	$this->Languages->find('all');		
		foreach($allLang as $lang){
			@unlink(CACHE.'cake_element__online_casino_search_side_bar_'.$lang->code.'_cache_callbacks');		
			@unlink(CACHE.'cake_element__promotion_search_side_bar_'.$lang->code.'_cache_callbacks');		
		}
		
		$this->clearCache();
		if($casino->type == 'online'){
			return $this->redirect(['action' => 'casino']);						
		}else{
			return $this->redirect(['action' => 'index']);			
		}
    }
	
	public function city_autocomplete(){
		$this->loadModel('Cities');
	
		$query 		= 	$this->request->query['q'];
		$query		=	explode('&',$query);
		$city		=	$query[0];
		$country_id	=	$query[1];
		
		$results = $this->Cities->find('all',array('conditions' => array('name COLLATE UTF8_GENERAL_CI LIKE "'.$city.'%"','country_id' => $country_id),'fields' => array('id','name'),'limit' => 7));
		
		
		echo json_encode($results);
		exit;
	}	
	
	public function recommend($id){
		
	}	
	
	/**
     * Delete method
     *
     * @param string|null $id Casino id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function feat($id = null,$status)
    {
        $casino =	$res	= $this->Casinos->get($id);
		 
		$casino->is_feature	=	$status;		
		$this->Casinos->save($casino);		
		
		 $this->Flash->success(__('Status changes successfully.'));
        return $this->redirect(['action' => 'index']);
    }
}
