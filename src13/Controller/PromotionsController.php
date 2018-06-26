<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\View\View;
use Cake\Core\Configure; 
use Cake\Cache\Cache;
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

		
	public function promotion($type='bonus-type'){		
		$this->loadModel('Master.Masters');
		// pr($type);die;
		$this->loadModel('Promotion.Promotions');
		$query 		= 	$this->Promotions->find();
		
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
		$this->set(compact('pageTitle','metaDescription','promotions','headBlock','allCat','software','depositMethods','language','withdrawalMethods','type','footerBlock','allCatSideBar','currencies','WithdrawalLimit'));		
		$this->render('promotion');
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
}
