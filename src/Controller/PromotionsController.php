<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\View\View;
use Cake\Core\Configure;
use Cake\Cache\Cache;
use Cake\Datasource\ConnectionManager;

/**
 * promotions Controller
 *
 * @property \App\Model\Table\promotionsTable $promotions
 */
class PromotionsController extends AppController
{
	public function beforeFilter(Event $event)
    {
		parent::beforeFilter($event);

		$this->Auth->allow();
	}

	public $helpers = ['SocialShare'];

	public $components = ['Paginator'];

	public function findbonus()
	{
		// if(isset($_REQUEST))
		// {
		// 	echo "<pre>";
		// 	print_r($_REQUEST);
		// }

	}

	public function promotion($type='bonus-type'){

		$this->loadModel('Master.Masters');

		if(isset($_REQUEST['page']) && !empty($_REQUEST['page'])){
			// "<pre>"; print_r($_REQUEST); die;
			//$this->redirect(array('action' => 'onlinecasinoFilter'));
			//$this->redirect('online-casinos-filter/?page=2');
			$this->redirect(array(
			    'action' => 'promotionFilter', '?' => array(
			        'page' => $_REQUEST['page']
			    )
			));
		}
		$this->loadModel('Promotion.Promotions');
		$query 		= 	$this->Promotions->find();
		if(isset($this->request->data) && !empty($this->request->data)){
	  // echo "<pre>"; print_r($this->request->data['bonus-type']); die;
		// echo $type; die;

		}

		if(!empty($this->request->query)){
		    $requestedQuery = $this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'amount' || $name == 'bonustype' || $name == 'language' || $name == 'sort' || $name == 'direction')
				continue;

				// $query->where(['Casino.title  LIKE' => '%'.$value.'%']);
			}
			$this->set('requestedQuery',$requestedQuery);
		}

		$requestedQuery	=	$this->request->query;
		// Bonus Type Filter
		if(!empty($this->request->query['bonustype'])) {
		    $key = $this->request->query['bonustype'];
		    
		    $query->matching('PromotionBonusTypes', function ($q) use ($key) {
								return $q->orWhere(['PromotionBonusTypes.category_id' => $key]);
							});
			 
		}
		// Amounts Filter
		if(!empty($this->request->query['amount'])) {
		    $amount = $this->request->query['amount'];
			if (strpos($amount, '-') !== false) {
				 $amounts = explode("-",$amount);
				 $query->where([
            "Promotions.b_amount BETWEEN :start AND :end"
         ])
         ->bind(':start', $amounts[0])
         ->bind(':end', $amounts[1]);
         $query->where(["Promotions.currency like '%".$amounts[2]."%'"]);
			}else if(strpos($amount, '_') !== false){
				$amounts = explode("_",$amount);
				if($amounts[0] == 'less'){
					$t = '<';
				}else if($amounts[0] == 'greter'){
					$t = '>';
				}
				$query->where(["Promotions.b_amount ".$t." ".$amounts[1]." and Promotions.currency like '%".$amounts[2]."%'"]);
			}

		}
		// Game Filter
		if(!empty($this->request->query['game_id'])) {
		    $key1 = $this->request->query['game_id'];
				 
				$query->matching('Casino.CasinoGamblingOptions', function ($q) use ($key1) {
								return $q->orWhere(['CasinoGamblingOptions.master_id' => $key1]);
							}); 
		 }


		$this->paginate = [
			'sortWhitelist' => ['id','created','Casino.avg_rating','title'],
			'contain' =>	[
				'Casino' => ['fields' => ['image','avg_rating','title','slug','id']],
				'Casino.City'=> ['fields' => ['name']]
			],
			'limit' => Configure::read('Reading.record_per_page')
		];
		$promotions		   =   $this->paginate($query);



		if (($allCat = Cache::read('allCatPromotion','longlong')) === false) {
			$this->loadModel('Category.Categories');

			$allCat	= 	$this->Categories->find('translations')->where(['type' => 'double_with_image','categorie_type' => 'bonus_type'])->order(['created' => 'ASC'])->limit(6)->toList();
			Cache::write('allCatPromotion', $allCat,'longlong');
		}

		if (($allCatSideBar = Cache::read('allCatSideBarPromotion','longlong')) === false) {
			$this->loadModel('Category.Categories');

			$allCatSideBar	 =	 $this->Categories->find('translations')->where(['categorie_type' => 'bonus_type','Categories.id !=' => 46])->toList();
			Cache::write('allCatSideBarPromotion', $allCatSideBar,'longlong');
		}

		if (($headBlock = Cache::read('headBlockPromotion','longlong')) === false) {
			$this->loadModel('Category.Categories');

			$headBlock 		= 	$this->Categories->find('translations')->where(['Categories.id' => '46'])->order(['created' => 'ASC'])->first();
			Cache::write('headBlockPromotion', $headBlock,'longlong');
		}
		$pageTitle			=	str_replace("{0}",Date('Y'),$headBlock->page_title);
		$metaDescription	=	str_replace("{0}",Date('Y'),$headBlock->meta_description);

		if($type != 'bonus-type'){
			foreach($allCatSideBar as $cat){ //pr($cat);
				if($cat->id == $key){
					$pageTitle			=	str_replace("{0}",Date('Y'),$cat->page_title);
					$metaDescription	=	str_replace("{0}",Date('Y'),$cat->meta_description);
					// pr($cat);
					// break;
				}
			}
		}
		$this->loadModel('Category.Categories');
// 		$allCatSideBarq	 =	 $this->Categories->find('translations')->where(['categorie_type' => 'bonus_type','Categories.id !=' => 46])->order(['title' => 'asc']);
		
		$allCatSideBarq	 =	 $this->Categories->find('translations')
		                    ->join([
                                'pbt' => [
                                    'table' => 'promotion_bonus_types',
                                    'type' => 'inner',
                                    'conditions' => [
                                        'Categories.id = pbt.category_id',
                                        'pbt.category_id !=46'
                                    ]
                                ],
                                'p' => [
                                    'table' => 'promotions',
                                    'type' => 'inner',
                                    'conditions' => [
                                        'p.id = pbt.promotion_id'
                                    ]
                                ],
                                'c' => [
                                    'table' => 'casinos',
                                    'type' => 'inner',
                                    'conditions' => [
                                        'c.id=p.casino_id'
                                    ]
                                ],
                                'cgo' => [
                                    'table' => 'casino_gambling_options',
                                    'type' => 'inner',
                                    'conditions' => [
                                        'c.id=cgo.casino_id'
                                    ]
                                ]
                            ])
		                    ->where(['categorie_type' => 'bonus_type','Categories.id !=' => 46])
		                    ->group(['Categories.id'])
		                    ->order(['Categories.title' => 'asc']);
		
		$this->loadModel('Promotion.Promotions');
		$this->loadModel('Promotions.PromotionBonusTypes');
		$allCatSideBarqWithAmount = [];
 		foreach ($allCatSideBarq as $cwa){
 		    $promoAmounts	 =	 $this->Promotions->find()
		                            ->join([
                                    'pbt' => [
                                        'table' => 'promotion_bonus_types',
                                        'type' => 'inner',
                                        'conditions' => [
                                            'Promotions.id = pbt.promotion_id',
                                            'pbt.category_id =' . $cwa->id
                                        ]
                                    ]
                            ])->extract('b_amount')
                            ->toArray();
            $allCatSideBarqWithAmount[$cwa->id] = array_unique($promoAmounts);
		}
			
		
		$this->loadModel('Master.Masters');
		$gambling_options = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'gambling_options',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
				//$amounts = ['id' => '1','title'=>'USD'];
		//$this->Amounts->find('');
		 $this->loadModel('AmountsTable.Amounts');

		$currencies = $this->Amounts->find('list');
		//echo "<pre>"; print_r($currencies); die;
		$this->set(compact('amounts','pageTitle','metaDescription','promotions','headBlock','allCat','software','depositMethods','language','withdrawalMethods','type','footerBlock','allCatSideBar','currencies','WithdrawalLimit','allCatSideBarq','$allCatSideBarqWithAmount','gambling_options'));
		$this->render('promotion');
	}

	public function promotionFilter($type='bonus-type'){
		$this->loadModel('Master.Masters');
		// pr($type);die;

		$this->loadModel('Promotion.Promotions');
		$query 		= 	$this->Promotions->find();
		if(isset($this->request->data) && !empty($this->request->data)){
			//echo "<pre>"; print_r($this->request->data); die;
		}
		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
				continue;
				$query->where(['Casino.title  LIKE' => '%'.$value.'%']);
			}
			$this->set('requestedQuery',$requestedQuery);
		}

	 	if($type == 'cash-back-bonus' || $type == 'welcome-bonuses' || $type == 'reload-bonus' ||  $type == 'no-deposit-bonuses' ||  $type == 'free-spins' || $type == 'high-roller-bonus'){
			$key	=	Configure::read('masters.'.$type);

			$query->matching('PromotionBonusTypes', function ($q) use ($key) {
				return $q->orWhere(['PromotionBonusTypes.category_id' => $key]);
			});
			$this->set('selectedId',$key);
		}
		$this->paginate = [
			'sortWhitelist' => ['id','created','Casino.avg_rating','title'],
			'contain' =>	[
				'Casino' => ['fields' => ['image','avg_rating','title','slug']],
				'Casino.City'=> ['fields' => ['name']]
			],
			'limit' => Configure::read('Reading.record_per_page')
		];

		$promotions		   =   $this->paginate($query);


		if (($allCat = Cache::read('allCatPromotion','longlong')) === false) {
			$this->loadModel('Category.Categories');

			$allCat	= 	$this->Categories->find('translations')->where(['type' => 'double_with_image','categorie_type' => 'bonus_type'])->order(['created' => 'ASC'])->limit(6)->toList();
			Cache::write('allCatPromotion', $allCat,'longlong');
		}

		if (($allCatSideBar = Cache::read('allCatSideBarPromotion','longlong')) === false) {
			$this->loadModel('Category.Categories');

			$allCatSideBar	 =	 $this->Categories->find('translations')->where(['categorie_type' => 'bonus_type','Categories.id !=' => 46])->toList();
			Cache::write('allCatSideBarPromotion', $allCatSideBar,'longlong');
		}

		if (($headBlock = Cache::read('headBlockPromotion','longlong')) === false) {
			$this->loadModel('Category.Categories');

			$headBlock 		= 	$this->Categories->find('translations')->where(['Categories.id' => '46'])->order(['created' => 'ASC'])->first();
			Cache::write('headBlockPromotion', $headBlock,'longlong');
		}
		$pageTitle			=	str_replace("{0}",Date('Y'),$headBlock->page_title);
		$metaDescription	=	str_replace("{0}",Date('Y'),$headBlock->meta_description);

		if($type != 'bonus-type'){
			foreach($allCatSideBar as $cat){ //pr($cat);
				if($cat->id == $key){
					$pageTitle			=	str_replace("{0}",Date('Y'),$cat->page_title);
					$metaDescription	=	str_replace("{0}",Date('Y'),$cat->meta_description);

		// pr($cat);
					// break;
				}
			}
		}
		$this->loadModel('Category.Categories');
		$allCatSideBarq	 =	 $this->Categories->find('translations')->where(['categorie_type' => 'bonus_type','Categories.id !=' => 46])->order(['title' => 'asc']);
		$this->loadModel('Master.Masters');
		$gambling_options = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'gambling_options',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
		//echo "<pre>"; print_r($gambling_options);  die;
		$this->set(compact('pageTitle','metaDescription','promotions','headBlock','allCat','software','depositMethods','language','withdrawalMethods','type','footerBlock','allCatSideBar','currencies','WithdrawalLimit','allCatSideBarq','gambling_options'));
		$this->render('promotion_filter');
	}

	public function welcomeBonuses(){
		$this->promotion('welcome-bonuses');
	}

	public function freeSpins(){
		$this->promotion('free-spins');
	}

	public function noDepoitBonus(){
		$this->promotion('no-deposit-bonuses');
	}

	public function reloadBonus(){
		$this->promotion('reload-bonus');
	}
	public function cashBackBonus(){
		$this->promotion('cash-back-bonus');
	}
	public function highRollerBonus(){
		$this->promotion('high-roller-bonus');
	}

	function promotionSearch(){
		$this->loadModel('Promotion.Promotions');
		$query 		= 	$this->Promotions->find();

		if(!empty($this->request->data)){
			$this->request->session()->write('promotion_search',$this->request->data);
			$thisData	=	$this->request->data;
		}else{
			$thisData	=	$this->request->session()->read('promotion_search');
		}

		if(!empty($thisData)){
			foreach($thisData as $key => $val){
				## Bonus type conditions ##
				if($key == 'categories'){
					foreach($val as $key => $isCheck){
						if($isCheck){
							$query->matching('PromotionBonusTypes', function ($q) use ($key) {
								return $q->orWhere(['PromotionBonusTypes.category_id' => $key]);
							});
						}
					}
				}else if($key == 'manual_flushing' || $key == 'owner' ||  $key == 'live_chat' || $key == 'established' || $key == 'owner'){
					$oi	=	array();
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							if($key == 'owner'){
								$key1	=	base64_decode($key1);
							}
							$oi[]['Casino.'.$key]	=	$key1;
						}
					}
					if(!empty($oi)){
						$query->where(['OR' => $oi]);
					}
				}else if($key == 'restricted_country'){
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$query->matching('Casino.RestricatedCountries', function ($q) use ($key1) {
								return $q->orWhere(['RestricatedCountries.country_id' => $key1]);
							});
						}
					}
				}else if($key == 'allowed_country'){
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$query->notMatching('Casino.RestricatedCountries', function ($q) use ($key1) {
								return $q->orWhere(['RestricatedCountries.country_id' => $key1]);
							});
						}
					}
				}else if($key == 'gambling_options'){
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$query->matching('Casino.CasinoGamblingOptions', function ($q) use ($key1) {
								return $q->orWhere(['CasinoGamblingOptions.master_id' => $key1]);
							});
						}
					}
				}else if($key == 'software'){
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$query->matching('Casino.CasinoSoftware', function ($q) use ($key1) {
								return $q->orWhere(['CasinoSoftware.master_id' => $key1]);
							});
						}
					}
				}else if($key == 'deposit_methods'){
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$query->matching('Casino.CasinoDepositMethods', function ($q) use ($key1) {
								return $q->orWhere(['CasinoDepositMethods.master_id' => $key1]);
							});
						}
					}
				}else if($key == 'devices'){
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$query->matching('Casino.CasinoDevices', function ($q) use ($key1) {
								return $q->orWhere(['CasinoDevices.master_id' => $key1]);
							});
						}
					}
				}else if($key == 'currencies'){
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$query->matching('Casino.CasinoCurrencies', function ($q) use ($key1) {
								return $q->orWhere(['CasinoCurrencies.master_id' => $key1]);
							});
						}
					}
				}else if($key == 'language'){
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$query->matching('Casino.CasinoLanguage', function ($q) use ($key1) {
								return $q->orWhere(['CasinoLanguage.master_id' => $key1]);
							});
						}
					}
				}else if($key == 'withdrawal_methods'){
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$query->matching('Casino.CasinoWithdrawalMethods', function ($q) use ($key1) {
								return $q->orWhere(['CasinoWithdrawalMethods.master_id' => $key1]);
							});
						}
					}
				}else if($key == 'licences'){
					foreach($val as $key1 => $isCheck){
						if($isCheck){
							$query->matching('Casino.CasinoLicences', function ($q) use ($key1) {
								return $q->orWhere(['CasinoLicences.master_id' => $key1]);
							});
						}
					}
				}else if($key == 'p_min'){
					if($thisData['p_min'] > 0){
						$p_min		=	$thisData['p_min']*3600;
						$query->where(['Casino.p_min >= ' => $p_min]);
					}
				}else if($key == 'p_max'){
					if($thisData['p_max'] < 300){
						$p_max		=	$thisData['p_max']*3600;
						$query->where(['Casino.p_max <= ' => $p_max]);
					}
				}else if($key == 'payout_percentage'){
					if($thisData['payout_percentage'] > 0){
						$payout_percentage		=	$thisData['payout_percentage'];
						$query->where(['Casino.payout_percentage >=' => $payout_percentage]);
					}
				}else if($key == 'payout_percentage_max'){
					if($thisData['payout_percentage_max'] < 100){
						$payout_percentage_max		=	$thisData['payout_percentage_max'];
						$query->where(['Casino.payout_percentage <= ' => $payout_percentage_max]);
					}
				}
			}


		$this->paginate = [
			'contain' =>	[
				'Casino' => ['fields' => ['image','avg_rating','title','slug','id']],
				'Casino.City'=> ['fields' => ['name']],
			],
			'limit' => Configure::read('Reading.record_per_page'),
			'order' => ['Promotions.id' =>  'desc'],
			'group' => 'Promotions.id'
		];

		$promotions		    =   $this->paginate($query);

		$view 				= 	new View();
		$view->viewPath		=	'Element';
		$view->layout		=	false;
		$isAjax				=	true;
		$view->set (compact('promotions','isAjax'));

		$html				=	$view->render('promotion_search');
		$data['data']		=	$html;
		echo json_encode($data);
		}
		exit;
	}
	
	/*
	
	SELECT id,name FROM masters WHERE id IN(SELECT master_id FROM `casino_gambling_options` WHERE casino_id IN(SELECT DISTINCT(casino_id) FROM promotions as p inner join promotion_bonus_types as pbt on (p.id=pbt.promotion_id && pbt.category_id = 41) inner join casinos as c on c.id=p.casino_id WHERE ( c.title like '%572%' OR p.b_amount BETWEEN '100' AND '500' AND p.currency like '%USD%' )))
*/

function headerSearch(){
	$category_id = $this->request->data['category_id'];
	$game_id = $this->request->data['selected'];
	$query = '';
	if(!empty($this->request->data['amount'])) {
		$amount = $this->request->data['amount'];
		if (strpos($amount, '-') !== false) {
			$amounts = explode("-",$amount);
			$query = "p.b_amount BETWEEN ".$amounts[0]." AND ".$amounts[1]." AND p.currency like '%".$amounts[2]."%' ";			
		}else if(strpos($amount, '_') !== false){
			$amounts = explode("_",$amount);
			if($amounts[0] == 'less'){
				$t = '<=';
			}else if($amounts[0] == 'greter'){
				$t = '>=';
			}
			$query = "p.b_amount ".$t." ".$amounts[1]." AND p.currency like '%".$amounts[2]."%' ";
		}
	}
	
	
	$conn = ConnectionManager::get('default');
	$stmt = $conn->execute("SELECT id,name FROM masters WHERE id IN(SELECT master_id FROM `casino_gambling_options` WHERE casino_id IN(SELECT DISTINCT(casino_id) FROM promotions as p inner join promotion_bonus_types as pbt on (p.id=pbt.promotion_id && pbt.category_id = ".$category_id.") inner join casinos as c on c.id=p.casino_id WHERE (".$query.")))
	");
	$results = $stmt ->fetchAll('assoc');
$select = '<select name="game_id" id="slct_game">';
	if(!empty($results)){
		$select .= '<option value=""> Select a device</option>';
		foreach($results as $val){
			if($val['id'] == $game_id){
				
				$select .= '<option selected="selected" value="'.$val['id'].'">'.$val['name'].'</option>';
			}else{
				
				$select .= '<option value="'.$val['id'].'">'.$val['name'].'</option>';
			}
		}
	}else{
		$select .= '<option value=""> No record found</option>';
	}
	
	$select .= '</select>';
	echo $select;
	die;
}
	

}
