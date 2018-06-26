<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Http\Client;
use Cake\View\View;
use Cake\Core\Configure;
use Cake\Cache\Cache;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\NotFoundException;
/**
 * Casinos Controller
 *
 * @property \App\Model\Table\CasinosTable $Casinos
 */
class CasinosController extends AppController
{
	 public function beforeFilter(Event $event)
    {
		parent::beforeFilter($event);
		$this->Auth->allow();
	}
	
	public $components = ['Paginator'];

	
	public function casinoSlug($city_name = null){
		$slug			=	$city_name;
		$slugName		=	'casino_slug';
		
			
		$limit		=	12;
		$nearby		=	isset($this->request->query['nearby']) ? $this->request->query['nearby'] : 'asc';
		$rating		=	isset($this->request->query['rating']) ? $this->request->query['rating'] : 'asc';
		$review		=	isset($this->request->query['review']) ? $this->request->query['review'] : 'asc';
		$page		=	isset($this->request->query['page']) ? $this->request->query['page'] : 1;
		$OFFSET		=	isset($this->request->query['page']) ? $this->request->query['page'] : 0;
		if($OFFSET > 1){
			$OFFSET	=	($OFFSET-1)*$limit;
		}
		$casinos	=	array();
		
			$this->request->session()->write('city_name',$city_name);
			
			
			if(isset($this->request->query['rating'])){
				$order	=	'avg_rating';
				$by		=	$this->request->query['rating'];
			}else if(isset($this->request->query['review'])){
				$order	=	'review_count';			
				$by		=	$this->request->query['review'];
			}else{
				$order	=	'distance';			
				$by		=	$nearby;
			}
		if(!empty($city_name)){		
			$location	  =	$this->Cookie->read('location');
			if(empty($location)){
				$http 	  =  new Client();		
				$ip 	  =  $this->request->clientIp();
				// $ip 	  =  '70.248.28.23';
				$url	  =	'http://www.geoplugin.net/php.gp?ip='.$ip;
				$response =  $http->get($url);
				$response =  $response->body();
				$res	  =	 unserialize($response);
				// pr($res);
				$lat		=	isset($res['geoplugin_latitude']) ? $res['geoplugin_latitude']  : LAT;
				$lang		=	isset($res['geoplugin_longitude']) ? $res['geoplugin_longitude']  : LONG;
				
				$this->Cookie->configKey('location', 'expires', '+100 months');
				$this->Cookie->write('location',json_encode(array('lat' => $lat,'lang' => $lang)));
			}else{
				$lat		=	isset($location['lat']) ? $location['lat']  : LAT;
				$lang		=	isset($location['lang']) ? $location['lang'] : LONG;
			}
			
			$distance 	=	'(3959 * acos (cos ( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lang.') ) + sin ( radians('.$lat.') ) * sin( radians( latitude )))) AS distance';
			
			$conn 		=    ConnectionManager::get('default');		
			$query		=	'(
				(SELECT 1 AS type,review_count,id,name,slug,avg_rating,image,1000000 AS distance FROM countries WHERE name collate utf8_general_ci like "%'.$city_name.'%") 
					UNION ALL 				
				(SELECT 2 AS type,review_count,id,name,CONCAT(slug,"!2!",(select slug from countries where id = cities.country_id)),avg_rating,image,'.$distance.' FROM cities WHERE name collate utf8_general_ci like "%'.$city_name.'%")
					UNION ALL 
				(SELECT type,review_count,Casinos.id,Casinos.title,Casinos.slug,avg_rating,Casinos.image,1000000 AS distance FROM casinos AS Casinos INNER JOIN promotions AS MainPromotion ON (Casinos.id = (MainPromotion.casino_id)) WHERE (type = "online" AND (Casinos.title like "%'.$city_name.'%" OR description like "%'.$city_name.'%" OR address like "%'.$city_name.'%")))
					UNION ALL				
				(SELECT type,review_count ,id ,title , slug, avg_rating,image,1000000 AS distance FROM casinos WHERE (type = "normal" AND (title like "%'.$city_name.'%" OR description like "%'.$city_name.'%" OR address like "%'.$city_name.'%")))
			)';
			
			$stmt		= 	$conn->execute('Select * FROM '.$query.' a Order BY '.$order.' '.$by.' LIMIT '.$limit.' OFFSET '.$OFFSET);
			
			$countStmt 	= 	$conn->execute('Select count(*) as count FROM '.$query.' a');
			
			$countStmt 	=  	$countStmt ->fetchAll('assoc');
			$casinos 	=  	$stmt ->fetchAll('assoc');
			
			$pageCount	=	isset($countStmt[0]['count']) ? $countStmt[0]['count'] : 0;
		
		}
		$pageTitle	=	__('title.casino_search',$city_name);
		
		$metaDescription	=	__('meatadescription.casino_search',$city_name);
		
		$this->set(compact('gamblingOptions','amenities','slug','slugName','casinos','city_name','page','pageCount','limit','nearby','review','rating','order','pageTitle','metaDescription'));
		
		// $this->set(compact('cities','casinos','city_name','CasinoImages','cityDetail','gamblingOptions','amenities','slug','slugName'));
	}
	
	public function onlineCasino($type = 'online-casino'){
		$sortBy	=	'created';
		$order	=	'desc';
		if(isset($this->request->params['stype'])){
			$sortBy  	= $this->request->params['stype'];
			$direction  = $this->request->params['direction'];
		}
		
		if (($headBlock = Cache::read('headBlock','longlong')) === false) {
			$this->loadModel('Category.Categories');	
		
			$headBlock 	= 	$this->Categories->find('translations')->where(['Categories.id' => '48'])->order(['created' => 'ASC'])->first();
			Cache::write('headBlock', $headBlock,'longlong');
		}
		
		
		$pageTitle			=	str_replace("{0}",Date('Y'),$headBlock->page_title);
		$metaDescription	=	str_replace("{0}",Date('Y'),$headBlock->meta_description);
		
		$this->request->session()->write('online_casino_type',$type);

		if (($guideContent = Cache::read('featured_guide','longlong')) === false) {
			$this->loadModel('GuideContent.GuideContents');
			$guideContent = $this->GuideContents->find('translations')->where(['isfeat' => 1,'is_deleted' => 0])->limit(6)->toList();
			Cache::write('featured_guide', $guideContent,'longlong');
		} 
		
		$query 		= 	$this->Casinos->find();
		
		if(isset($this->request->params['stype'])){
			$sortBy  	= $this->request->params['stype'];
			$order  = $this->request->params['direction'];
			if($sortBy == 'name'){
				$sortBy	=	'title';
			}
			$query->order(['Casinos.'.$sortBy => $order]);
			if($sortBy == 'title'){
				$sortBy	=	'name';
			}
		}
		
		$this->set('sortBy',$sortBy);
		$this->set('order',$order);
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
				continue;
				$query->where(['Casinos.title  LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		
		$this->paginate = [
			'sortWhitelist' => ['id','created','avg_rating','title','MainPromotion.is_main_promotion'],
			'contain' => (['MainPromotion' => ['conditions' => ['is_main_promotion' => 1], 'fields' => ['slug']]]),
			'limit' => Configure::read('Reading.record_per_page'),
			'group' => 'Casinos.id'
		];
		
		$this->loadModel('Category.Categories');			
		$countryRestrctedId	 =	 $this->Categories->find('all')->select(['country_id','page_title','meta_description'])->where(['slug' => $type])->first();		
		
		
		if(!in_array($type,array('online-casino','pokers','bingos','sport-bettings'))){
			if(!empty($countryRestrctedId->country_id)){
				$cid 	=	$countryRestrctedId->country_id;
				$query->notMatching('RestricatedCountries',function ($q) use ($cid){ return $q->where(["RestricatedCountries.country_id" => $cid]); });
				
				$this->set('selectedId','c'.$countryRestrctedId->country_id);
				
				$pageTitle			=	str_replace("{0}",Date('Y'),$countryRestrctedId->page_title);
				$metaDescription	=	str_replace("{0}",Date('Y'),$countryRestrctedId->meta_description);
			}else{
				if(!isset($sortBy)){
					throw new NotFoundException(__('Page not found'));
				}
			}
		
		}else{
			if (($allCountry = Cache::read('allCountry','longlong')) === false) {				
				$allCountry 	= 	$this->Categories->find('translations')->matching('CountryPages',function ($q) use ($type) {
						return $q->where(['CountryPages.page_id' => $type]);
					})->where(['categorie_type' => 'countries'])->order(['created' => 'ASC'])->toList();
				Cache::write('allCountry', $allCountry,'longlong');
			}
			// pr($allCountry);
			if($type == 'pokers' || $type == 'bingos' || $type == 'sport-bettings'){
				$key1	=	Configure::read('masters.'.$type);
				$query->matching('CasinoGamblingOptions', function ($q) use ($key1) {
					return $q->where(['CasinoGamblingOptions.master_id' => $key1]);
				});
				
				$this->set('selectedId','g'.$key1);
				
				
				$pageTitle			=	str_replace("{0}",Date('Y'),$countryRestrctedId->page_title);
				$metaDescription	=	str_replace("{0}",Date('Y'),$countryRestrctedId->meta_description);
			}
		}
		
		$query->where(['Casinos.type' => 'online']);	
		$result		 		= 	$this->paginate($query);		
		
		
		if (($allCat = Cache::read('allCat','longlong')) === false) {
			$this->loadModel('Category.Categories');	
		
			$allCat 	= 	$this->Categories->find('translations')->where(['type' => 'double_with_image','OR' => array(array('categorie_type' => 'online_casino'),array('categorie_type' => 'countries'))])->order(['created' => 'ASC'])->toList();
			Cache::write('allCat', $allCat,'longlong');
		}
		// pr($allCat);
		if (($headBlock = Cache::read('headBlock','longlong')) === false) {
			$this->loadModel('Category.Categories');	
		
			$headBlock 	= 	$this->Categories->find('translations')->where(['Categories.id' => '48'])->order(['created' => 'ASC'])->first();
			Cache::write('headBlock', $headBlock,'longlong');
		}
		
		$this->set(compact('pageTitle','metaDescription','result','guideContent','type','allCat','headBlock','allCountry'));
		$this->render('online_casino');
	}	
    /**
     * View method
     *
     * @param string|null $id Casino id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function casinoView($slug = null)
    {
		$slug1		=	$slug;
		$userId	    =	$this->Auth->user('id');

		$casino = $this->Casinos->find('all')->contain([
			'Promotions',
			'Promotions.Masters' => function ($query){
				return $query->find('translations');
			},
			'CasinoGamblingOptions.Masters' => function ($query){
				return $query->find('translations');
			},
			'CasinoDevices.Masters' => ['conditions' => ['CasinoDevices.type' => 'devices']],
			'CasinoCurrencies.Masters' => ['conditions' => ['CasinoCurrencies.type' => 'currencies']],
			'CasinoLanguage.Masters' => ['conditions' => ['CasinoLanguage.type' => 'language']],
			'CasinoDepositMethods.Masters' => ['conditions' => ['CasinoDepositMethods.type' => 'deposit_methods']],
			'CasinoSoftware.Masters' => ['conditions' => ['CasinoSoftware.type' => 'software']],
			// 'CasinoDepositMethods.Masters',
			'CasinoWithdrawalMethods.Masters' => ['conditions' => ['CasinoWithdrawalMethods.type' => 'withdrawal_methods']],
			'CasinoLicences.Masters' => ['conditions' => ['CasinoLicences.type' => 'licences']],
			'City' => ['fields' => ['name','slug']],
			'City.Country' => ['fields' => ['name','slug']],
			'RestricatedCountries.Countries' => ['fields' => ['flag','name']],
			'CasinoActivityDatas',
			'CasinoActivityDatas.ParentMasters',
			'CasinoActivityDatas.CasinoActivities',
			'CasinoActivityDatas.CasinoActivities.CasinoImages'
		])->where([
			'Casinos.slug' => $slug
		])->first();
		
		$amenitiesInfo	=	array();
		$this->loadModel('Reviews');
		$rat				=	array();
		$rat['five']  		=	$this->Reviews->find('all')->where(['foreign_key' => $casino->id,'type' => 'casino','rating' => 5])->count();
		$rat['four']  		=	$this->Reviews->find('all')->where(['foreign_key' => $casino->id,'type' => 'casino','rating' => 4])->count();
		$rat['three']  		=	$this->Reviews->find('all')->where(['foreign_key' => $casino->id,'type' => 'casino','rating' => 3])->count();
		$rat['two']  		=	$this->Reviews->find('all')->where(['foreign_key' => $casino->id,'type' => 'casino','rating' => 2])->count();
		$rat['one']  		=	$this->Reviews->find('all')->where(['foreign_key' => $casino->id,'type' => 'casino','rating' => 1])->count();
		$rat['zero']  		=	$this->Reviews->find('all')->where(['foreign_key' => $casino->id,'type' => 'casino','rating' => 0])->count();
		
		$this->loadModel('Master.Masters');
		$amenitiesInfoArray = $this->Masters->find('all')->where(['type' => 'amenities_info','is_deleted' => 0])->toList();
		foreach($amenitiesInfoArray as $ame){
			$amenitiesInfo[$ame->id]	=	$ame;
		}
		
		
		if(empty($casino)){
			$this->redirect(array('controller' => 'users','action' => 'index'),301);
		}
		
		if(!empty($casino->object_id)){
			$this->loadModel('CasinoImages');
			$casinoImage	=	$this->CasinoImages->find('all')->select(['id','file','display_order'])->where(array('object_id' => $casino->object_id))->order(['display_order' => 'asc']);
		}
		
		$slugName		=	'casino_view';
		$promotionsText	=	(isset($casino['promotions']['0']['title'])) ? $casino['promotions']['0']['title'] : '';
		$cityName		=	!empty($casino->city->name) ? $casino->city->name : '';
		$pageTitle		=	 ($casino->type == 'normal') ? __('title.real_casino_view',$casino->title,$cityName,Date('Y')) : __('title.online_casino_view',$casino->title,Date('Y'),$promotionsText);
		
		if($casino->type == 'normal'){
			
			$position 			=	'';
			
			$conn 		=    ConnectionManager::get('default');			
			$query		=	'SELECT (SELECT COUNT(*) FROM casinos As x WHERE x.title <= t.title AND x.city_id = '.$casino->city_id.') AS position FROM casinos t WHERE t.title = "'.$casino->title.'"';
			$stmt		= 	$conn->execute($query);
			$position 	=  	$stmt ->fetchAll('assoc');
			$position 	=	isset($position[0]['position']) ? $position[0]['position'] : 1;
			$this->set("position",$position);
			
			$metaDescription		=	 __('metadescription.real_casino_view',$casino->title,Date('Y'),$position,$cityName);
			
			if(!empty($cityName) && strpos($casino->title,$cityName)){
				$pageTitle		=	__('title.real_casino_view',$casino->title,'',Date('Y'));
			}else{
				$pageTitle		=	__('title.real_casino_view',$casino->title,$cityName,Date('Y'));				
			}
			
			
			$this->loadModel('Promotion.Promotions');
			$mainPromotions 			= 	$this->Promotions->find('all')
				->where(['isfeat' => 1])
				->contain([
					'Casino' => ['fields' => ['slug','id','image','title','payout_percentage','avg_rating']]
				])->order('rand()')->first();
			$this->set('mainPromotions',$mainPromotions);
			// pr($mainPromotions);die;
		}else{
			$pageTitle			=	  __('title.online_casino_view',$casino->title,Date('Y'),$promotionsText);
			$metaDescription	=	 (!empty($casino->meta_description)) ? $casino->meta_description : __('metadescription.online_casino_view',$casino->title,Date('Y'),$promotionsText);
		}
		
		if($casino->type == 'online' && $this->request->params['action'] == 'casinoView'){
			$this->redirect(array('controller' => 'casinos','action' => 'onlineCasino'),301);
		}
        $this->set(compact('casino', 'casinoImage','slugName','slug','metaDescription','pageTitle','amenitiesInfo','rat'));
        $this->set('_serialize', ['casino']);
	}
	
	/**
     * View method
     *
     * @param string|null $id Casino id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function onlineCasinoView($slug = null)
    {
		$this->casinoView($slug);
		$slugName		=	'online_casino_view';
		$this->set(compact('casino', 'casinoImage','slugName','slug'));
		$this->render('casino_view');
	}
	
	function casinoAmenities(){
		$slug	=	$this->request->data['slug'];
		$casino = $this->Casinos->find('all')->contain([
			'CasinoAmenities.ChildMasters' => function ($query) {
				return $query->find('translations');
			},
			'CasinoAmenities.ParentMasters' => function ($query) {
				return $query->find('translations');
			}
		])->where([
				'Casinos.slug' => $slug
			])->first();
		$newArray		=	'';
		
		foreach($casino->casino_amenities as $ame){
			$newArray[$ame->parent_master->name][]	=	$ame->child_master->name;
		}
		echo json_encode($newArray);
		exit;
	}
	
	
	function addCasino(){
		
	}
	
	public function pokers(){
		$this->onlineCasino('pokers');
	}
	
	public function Bingos(){		
		$this->onlineCasino('bingos');
	}
	
	public function sportBettings(){		
		$this->onlineCasino('sport-bettings');		
	}
	
	function onlineCasinoSearch(){
		$type	=	$this->request->session()->read('online_casino_type');

		$query 		= 	$this->Casinos->find();
		if(!empty($this->request->data)){
			$this->request->session()->write('online_casino_search',$this->request->data);
			$thisData	=	$this->request->data;
		}else{
			$thisData	=	$this->request->session()->read('online_casino_search');
		}
		if(!empty($thisData)){
			foreach($thisData as $key => $val){
				## Bonus type conditions ##
				if($key == 'categories'){
					foreach($val as $key => $isCheck){
						if($isCheck){
							$query->matching('Promotions.PromotionBonusTypes', function ($q) use ($key) {
								return $q->orWhere(['PromotionBonusTypes.category_id' => $key]);
							});
						}
					}
				}else if($key == 'manual_flushing' || $key == 'owner' ||  $key == 'live_chat' || $key == 'established' || $key == 'owner'/*  || $key == 'payout_percentage' */){
					$oi	=	array();
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							if($key == 'owner'){
								$key1	=	base64_decode($key1);
							}
							$oi[]['Casinos.'.$key]	=	$key1;
						}
					}
					// pr($oi);
					if(!empty($oi)){
						$query->where(['OR' => $oi]);
					}
				}else if($key == 'restricted_country'){	
					$restricted_country	=	'';
					$count 				= 	0;
					
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$restricted_country	.=	$key1.',';
							$count++;
						}
					}
					$restricted_country	=	rtrim($restricted_country,",");
					
					if(!empty($restricted_country)){
						$conn 		=    ConnectionManager::get('default');		
						$stmt		= 	$conn->execute('SELECT casino_id FROM `restricated_countries` c WHERE c.country_id IN ('.$restricted_country.') GROUP BY c.casino_id having COUNT(*)='.$count);
						
						$de 	=  	$stmt ->fetchAll('assoc');
						$restricted_country	=	'';
						foreach($de as $c){
							$restricted_country	.=	$c['casino_id'].',';
						}
						$restricted_country		     =	rtrim($restricted_country,",");
						$restrictedCountryCondition  =	true;
					}							
				}else if($key == 'allowed_country'){
					foreach($val as $key1 => $isCheck){
						if($isCheck){							
							$query->notMatching('RestricatedCountries', function ($q) use ($key1) {
								return $q->orWhere(['RestricatedCountries.country_id' => $key1]);
							});
						}
					}								
				}else if($key == 'gambling_options'){
					
					$gambling_options	=	'';
					$count 				= 	0;
					
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$gambling_options	.=	$key1.',';
							$count++;
						}
					}
					$gambling_options	=	rtrim($gambling_options,",");
					
					if(!empty($gambling_options)){
						$conn 		=    ConnectionManager::get('default');		
						$stmt		= 	$conn->execute('SELECT casino_id FROM `casino_gambling_options` c WHERE c.master_id IN ('.$gambling_options.') GROUP BY c.casino_id having COUNT(*)='.$count);
						
						$de 	=  	$stmt ->fetchAll('assoc');
						$gambling_options	=	'';
						foreach($de as $c){
							$gambling_options	.=	$c['casino_id'].',';
						}
						$gambling_options		   =	rtrim($gambling_options,",");
						$gamblingOptionsCondition  =	true;
					}
				}else if($key == 'software'){
					$software	=	'';
					$count = 0;
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$software	.=	$key1.',';
							$count++;
						}
					}
					$software	=	rtrim($software,",");
					if(!empty($software)){
						$conn 		=    ConnectionManager::get('default');		
						$stmt		= 	$conn->execute('SELECT casino_id FROM `casino_software` c WHERE type="software" AND c.master_id IN ('.$software.') GROUP BY c.casino_id having COUNT(*)='.$count);
						
						$de 	=  	$stmt ->fetchAll('assoc');
						$software	=	'';
						foreach($de as $c){
							$software	.=	$c['casino_id'].',';
						}
						$software	=	rtrim($software,",");
						$softwareCondition  =	true;
					}
					
				}else if($key == 'deposit_methods'){
					$deposit_methods	=	'';
					$count = 0;
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$deposit_methods	.=	$key1.',';
							$count++;
						}
					}
					$deposit_methods	=	rtrim($deposit_methods,",");
					if(!empty($deposit_methods)){
						$conn 		=    ConnectionManager::get('default');		
						$stmt		= 	$conn->execute('SELECT casino_id FROM `casino_software` c WHERE type="deposit_methods" AND c.master_id IN ('.$deposit_methods.') GROUP BY c.casino_id having COUNT(*)='.$count);
						
						$de 	=  	$stmt ->fetchAll('assoc');
						$deposit_methods	=	'';
						foreach($de as $c){
							$deposit_methods	.=	$c['casino_id'].',';
						}
						$deposit_methods	=	rtrim($deposit_methods,",");
						$depositMethodsCondition  =	true;
					}
						
				}else if($key == 'devices'){
					$devices	=	'';
					$count = 0;
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$devices	.=	$key1.',';
							$count++;
						}
					}
					$devices	=	rtrim($devices,",");
					if(!empty($devices)){
						$conn 		=    ConnectionManager::get('default');		
						$stmt		= 	$conn->execute('SELECT casino_id FROM `casino_software` c WHERE type="devices" AND c.master_id IN ('.$devices.') GROUP BY c.casino_id having COUNT(*)='.$count);
						
						$de 	=  	$stmt ->fetchAll('assoc');
						$devices	=	'';
						foreach($de as $c){
							$devices	.=	$c['casino_id'].',';
						}
						$devices	=	rtrim($devices,",");
						$devicesCondition  =	true;
					}								
				}else if($key == 'currencies'){
					$currencies		=	'';
					$count 			= 	0;
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$currencies	.=	$key1.',';
							$count++;
						}
					}
					
					$currencies	=	rtrim($currencies,",");
					if(!empty($currencies)){
						$conn 		=    ConnectionManager::get('default');		
						$stmt		= 	$conn->execute('SELECT casino_id FROM `casino_software` c WHERE type="currencies" AND c.master_id IN ('.$currencies.') GROUP BY c.casino_id having COUNT(*)='.$count);
						
						$de 	=  	$stmt ->fetchAll('assoc');
						$currencies	=	'';
						foreach($de as $c){
							$currencies	.=	$c['casino_id'].',';
						}
						$currencies	=	rtrim($currencies,",");
						$currenciesCondition  =	true;
					}
					
				}else if($key == 'language'){
					$language		=	'';
					$count 			= 	0;
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$language	.=	$key1.',';
							$count++;
						}
					}
					
					$language	=	rtrim($language,",");
					if(!empty($language)){
						$conn 		=    ConnectionManager::get('default');		
						$stmt		= 	 $conn->execute('SELECT casino_id FROM `casino_software` c WHERE type="language" AND c.master_id IN ('.$language.') GROUP BY c.casino_id having COUNT(*)='.$count);
						
						$de 	=  	$stmt ->fetchAll('assoc');
						
						$language	=	'';
						foreach($de as $c){
							$language	.=	$c['casino_id'].',';
						}
						$language	=	rtrim($language,",");
						$languageCondition  =	true;
					}

					
				}else if($key == 'withdrawal_methods'){
					$withdrawal_methods		=	'';
					$count 			= 	0;
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$withdrawal_methods	.=	$key1.',';
							$count++;
						}
					}
					
					$withdrawal_methods	=	rtrim($withdrawal_methods,",");
					if(!empty($withdrawal_methods)){
						$conn 		=    ConnectionManager::get('default');		
						$stmt		= 	$conn->execute('SELECT casino_id FROM `casino_software` c WHERE type="withdrawal_methods" AND c.master_id IN ('.$withdrawal_methods.') GROUP BY c.casino_id having COUNT(*)='.$count);
						
						$de 	=  	$stmt ->fetchAll('assoc');
						$withdrawal_methods	=	'';
						foreach($de as $c){
							$withdrawal_methods	.=	$c['casino_id'].',';
						}
						$withdrawal_methods					 =	rtrim($withdrawal_methods,",");
						$withdrawalMethodsCondition  =	true;
					}	
					
				}else if($key == 'licences'){
					$licences		=	'';
					$count 			= 	0;
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$licences	.=	$key1.',';
							$count++;
						}
					}
					
					$licences	=	rtrim($licences,",");
					if(!empty($licences)){
						$conn 		=    ConnectionManager::get('default');		
						$stmt		= 	$conn->execute('SELECT casino_id FROM `casino_software` c WHERE type="licences" AND c.master_id IN ('.$licences.') GROUP BY c.casino_id having COUNT(*)='.$count);
						
						$de 	=  	$stmt ->fetchAll('assoc');
						$licences	=	'';
						foreach($de as $c){
							$licences	.=	$c['casino_id'].',';
						}
						$licences					 =	rtrim($licences,",");
						$licencesMethodsCondition  =	true;
					}								
				}else if($key == 'p_min'){
					if($thisData['p_min'] > 0){
						$p_min		=	$thisData['p_min']*3600;
						$query->where(['Casinos.p_min >= ' => $p_min]);
					}
				}else if($key == 'p_max'){
					if($thisData['p_max'] < 300){
						$p_max		=	$thisData['p_max']*3600;
						$query->where(['Casinos.p_max <= ' => $p_max]);
					}
				}else if($key == 'payout_percentage'){
					if($thisData['payout_percentage'] > 0){
						$payout_percentage		=	$thisData['payout_percentage'];
						$query->where(['Casinos.payout_percentage >=' => $payout_percentage]);
					}
				}else if($key == 'payout_percentage_max'){
					
					if($thisData['payout_percentage_max'] < 100){
						$payout_percentage_max		=	$thisData['payout_percentage_max'];
						$query->where(['Casinos.payout_percentage <= ' => $payout_percentage_max]);
					}
				}
			}
			
			if($type == 'pokers' || $type == 'bingos' || $type == 'sport-bettings'){
				$key1	=	Configure::read('masters.'.$type);
				$query->matching('CasinoGamblingOptions', function ($q) use ($key1) {
					return $q->where(['CasinoGamblingOptions.master_id' => $key1]);
				});
			}
			
			$this->paginate = [
				'sortWhitelist' => ['id','created','avg_rating','title','MainPromotion.is_main_promotion'],
				'contain' => ([
					'Promotions.PromotionBonusTypes',
					'MainPromotion'
				]),
				'limit' => Configure::read('Reading.record_per_page'),
				'group' => 'Casinos.id'
			];
			
			$query->where(['Casinos.type' => 'online']);
			if(isset($softwareCondition)){
				$software	=	!empty($software) ? $software : 0;
				$query->where(['Casinos.id IN('.$software.')']);
			} 
			
			if(isset($gamblingOptionsCondition)){
				$gambling_options	=	!empty($gambling_options) ? $gambling_options : 0;
				$query->where(['Casinos.id IN('.$gambling_options.')']);
			} 
			if(isset($depositMethodsCondition)){
				$deposit_methods	=	!empty($deposit_methods) ? $deposit_methods : 0;
				$query->where(['Casinos.id IN('.$deposit_methods.')']);
			} 
			
			if(isset($currenciesCondition)){
				$currencies	=	!empty($currencies) ? $currencies : 0;
				$query->where(['Casinos.id IN('.$currencies.')']);
			} 
			if(isset($devicesCondition)){
				$devices	=	!empty($devices) ? $devices : 0;
				$query->where(['Casinos.id IN('.$devices.')']);
			} 
			
			if(isset($withdrawalMethodsCondition)){
				$withdrawal_methods	=	!empty($withdrawal_methods) ? $withdrawal_methods : 0;
				$query->where(['Casinos.id IN('.$withdrawal_methods.')']);
			} 
			
			if(isset($licencesMethodsCondition)){
				$licences	=	!empty($licences) ? $licences : 0;
				$query->where(['Casinos.id IN('.$licences.')']);
			} 
			
			if(isset($languageCondition)){
				$language	=	!empty($language) ? $language : 0;
				$query->where(['Casinos.id IN('.$language.')']);
			} 
			
			if(isset($restrictedCountryCondition)){
				$restricted_country	=	!empty($restricted_country) ? $restricted_country : 0;
				$query->where(['Casinos.id IN('.$restricted_country.')']);
			} 
			
			
			$result				= 	$this->paginate($query);		
			
			$view 				= 	new View();
			$view->viewPath		=	'Element';
			$view->layout		=	false;
			$isAjax				=	true;
			$view->set (compact('result','isAjax')); 

			$html				=	$view->render('online_casino_search');			
			$data['data']		=	$html;
			$data['query']		=	$query;
			echo json_encode($data);
		}
		exit;
	}
	
	function ccsr(){
		$type	=	$this->request->session()->read('ccsr');
		$avg_rating	=	'';
		if(!empty($this->request->data)){
			$this->request->session()->write('ccsr',$this->request->data);
			$thisData	=	$this->request->data;
		}else{
			$thisData	=	$this->request->session()->read('ccsr');
		}
		$city_name	=	$this->request->session()->read('city_name');
		$yesIsCheck	=	false;
		if(!empty($thisData)){
			$nearby		=	isset($this->request->query['nearby']) ? $this->request->query['nearby'] : 'asc';
			$rating		=	isset($this->request->query['rating']) ? $this->request->query['rating'] : 'asc';
			$review		=	isset($this->request->query['review']) ? $this->request->query['review'] : 'asc';
			$page		=	isset($this->request->query['page']) ? $this->request->query['page'] : 1;
			$OFFSET		=	isset($this->request->query['page']) ? $this->request->query['page'] : 0;
			
			$query 		= 	$this->Casinos->find();
			foreach($thisData as $key => $val){
				## Bonus type conditions ##
				if($key == 'aminities'){
					foreach($val as $key => $isCheck){
						if($isCheck){
							$yesIsCheck	=	true;
							$query->matching('CasinoAmenities', function ($q) use ($key) {
								return $q->orWhere(['CasinoAmenities.master_id' => $key]);
							});
						}
					}
				}else if($key == 'rating'){
					$oi	=	array();
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$query->orWhere(['avg_rating' => $key1]);
							$avg_rating		.=	' avg_rating = '.$key1.' OR';
						}
					}
				}else if($key == 'gambling_options'){
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							
							$yesIsCheck	=	true;
							$query->matching('CasinoGamblingOptions', function ($q) use ($key1) {
								return $q->orWhere(['CasinoGamblingOptions.master_id' => $key1]);
							});							
						}
					}								
				}
			}
			
			if(isset($this->request->query['rating'])){
				$order	=	'avg_rating';
				$by		=	$this->request->query['rating'];
			}else if(isset($this->request->query['review'])){
				$order	=	'review_count';			
				$by		=	$this->request->query['review'];
			}else{
				$order	=	'distance';			
				$by		=	$nearby;
			}
			
			
			$limit		=	12;
			if($yesIsCheck){
				$this->paginate = [
					'sortWhitelist' => ['id','created','avg_rating','title','MainPromotion.is_main_promotion'],
					'limit' => $limit,
					'group' => 'Casinos.id'
				];				
				$casinos	= 	$this->paginate($query);
			}else{
				$location	=	$this->Cookie->read('location');
				$lat		=	isset($location['lat']) ? $location['lat']  : LAT;
				$lang		=	isset($location['lang']) ? $location['lang'] : LONG;
				
				$distance 	=	'(3959 * acos (cos ( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lang.') ) + sin ( radians('.$lat.') ) * sin( radians( latitude )))) AS distance';
				if(!empty($avg_rating)){
					$avg_rating	=	substr($avg_rating, 0, -2);
					$avg_rating	=	' AND '.$avg_rating;
				}else{
					$avg_rating	=	'';
				}
				$conn 		=    ConnectionManager::get('default');		
				// $query		=	'((SELECT 1 AS type,review_count,id,name,slug,avg_rating,image,1000000 AS distance FROM countries WHERE name collate utf8_general_ci like "%'.$city_name.'%" '.$avg_rating.') UNION ALL (SELECT 2 AS type,review_count,id,name,slug,avg_rating,image,'.$distance.' FROM cities WHERE name collate utf8_general_ci like "%'.$city_name.'%"'.$avg_rating.') UNION ALL (SELECT type,review_count ,id,title , slug, avg_rating,image,1000000 AS distance FROM casinos WHERE (type = "online" '.$avg_rating.' AND (title like "%'.$city_name.'%" OR description like "%'.$city_name.'%" OR address like "%'.$city_name.'%"))) UNION ALL (SELECT type,review_count ,id , title , slug, avg_rating,image,1000000 AS distance FROM casinos WHERE (type = "normal" '.$avg_rating.' AND (title like "%'.$city_name.'%" OR description like "%'.$city_name.'%" OR address like "%'.$city_name.'%"))))';
				// echo $query;
				$query		=	'(
					(SELECT 1 AS type,review_count,id,name,slug,avg_rating,image,1000000 AS distance FROM countries WHERE name collate utf8_general_ci like "%'.$city_name.'%") 
						UNION ALL 				
					(SELECT 2 AS type,review_count,id,name,CONCAT(slug,"!2!",(select slug from countries where id = cities.country_id)),avg_rating,image,'.$distance.' FROM cities WHERE name collate utf8_general_ci like "%'.$city_name.'%")
						UNION ALL 
					(SELECT type,review_count,Casinos.id,Casinos.title,Casinos.slug,avg_rating,Casinos.image,1000000 AS distance FROM casinos AS Casinos INNER JOIN promotions AS MainPromotion ON (Casinos.id = (MainPromotion.casino_id)) WHERE (type = "online" AND (Casinos.title like "%'.$city_name.'%" OR description like "%'.$city_name.'%" OR address like "%'.$city_name.'%")))
						UNION ALL				
					(SELECT type,review_count ,id ,title , slug, avg_rating,image,1000000 AS distance FROM casinos WHERE (type = "normal" AND (title like "%'.$city_name.'%" OR description like "%'.$city_name.'%" OR address like "%'.$city_name.'%")))
				)';
				$stmt		= 	$conn->execute('Select * FROM '.$query.' a Order BY '.$order.' '.$by.' LIMIT '.$limit.' OFFSET '.$OFFSET);
				
				$countStmt 	= 	$conn->execute('Select count(*) as count FROM '.$query.' a');
				
				$countStmt 	=  	$countStmt ->fetchAll('assoc');
				$casinos 	=  	$stmt ->fetchAll('assoc');
			}
			$pageCount	=	isset($countStmt[0]['count']) ? $countStmt[0]['count'] : 0;
			
			$view 				= 	new View();
			$view->viewPath		=	'Element';
			$view->layout		=	false;
			$isAjax				=	true;
			// $view->set (compact('result','isAjax')); 

			$view->set(compact('gamblingOptions','amenities','slug','slugName','casinos','city_name','page','pageCount','limit','nearby','review','rating','order','isAjax','yesIsCheck'));
			
			$html				=	$view->render('casino_slug_search');			
			$data['data']		=	$html;
			$data['query']		=	$query;
			echo json_encode($data);
		}
		exit; 
	}
}
