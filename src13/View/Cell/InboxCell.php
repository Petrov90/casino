<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Inbox cell
 */
class InboxCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($sort_by)
    {	
		$this->loadModel('Master.Masters');
		$reviewOrder = $this->Masters->find('list')
			->where([
				'Masters.type' => 'review_order'
			])->all()->toArray();
		$this->set('sort_by', $sort_by);
		$this->set('reviewOrder', $reviewOrder);
    } 
	
	/**
     * Default display method.
     *
     * @return void
     */
    public function onlinecasino()
    {	
		$this->loadModel('Casinos');		
		$owner	=	$this->Casinos->find('list', [
			'keyField' => 'owner',
			'valueField' => 'owner'
		])->contain(['MainPromotion'])->group('owner')->order(['owner' => 'asc']);
		
		$this->loadModel('Master.Masters');
			
		$gambling_options = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'gambling_options',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
				
		$depositMethods = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'deposit_methods',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
				
		$software = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'software',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
		
		$devices = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'devices',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
		
		
		$language = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'language',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
		
		$withdrawalMethods = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'withdrawal_methods',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
			
		$currencies = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'currencies',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
				
		/* $WithdrawalLimit = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'withdrawal_limit',
					'is_deleted' => 0
				])->order(['name' => 'asc']); */
				
		$live_chat = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'live_chat',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
				
	/* 	$owner = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'owner',
					'is_deleted' => 0
				])->order(['name' => 'asc']); */
				
		$manual_flushing = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'manual_flushing',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
				
		$licences = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'licences',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
		
			
		$this->loadModel('CityManager.Country');
		$country		=	 $this->Country->find('translations')->order(['name' => 'asc']);

		$this->set(compact('pageTitle','metaDescription','result','guideContent','type','onlineCasinotop','allCat','headBlock','WithdrawalLimit','currencies','withdrawalMethods','language','software','depositMethods','allCatSideBar','allCountry','gambling_options','country','live_chat','owner','manual_flushing','licences','devices'));
    }
	
	/**
     * Default display method.
     *
     * @return void
     */
    public function bonuspage()
    {	
		
		$this->loadModel('Casinos');		
		$owner	=	$this->Casinos->find('list', [
			'keyField' => 'owner',
			'valueField' => 'owner'
		])->contain(['MainPromotion'])->group('owner')->order(['owner' => 'asc']);
		

		$this->loadModel('Master.Masters');
			
		$gambling_options = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'gambling_options',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
				
		$depositMethods = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'deposit_methods',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
				
		$software = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'software',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
		$devices = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'devices',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
		
		$language = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'language',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
		
		$withdrawalMethods = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'withdrawal_methods',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
			
		$currencies = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'currencies',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
				
		/* $WithdrawalLimit = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'withdrawal_limit',
					'is_deleted' => 0
				])->order(['name' => 'asc']); */
				
		$live_chat = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'live_chat',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
				
		/* $owner = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'owner',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
				 */
		$manual_flushing = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'manual_flushing',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
				
		$licences = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'licences',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
		
		$this->loadModel('Category.Categories');		
		$allCatSideBar	 =	 $this->Categories->find('translations')->where(['categorie_type' => 'bonus_type','Categories.id !=' => 46])->order(['title' => 'asc']);
		
				
		$this->loadModel('CityManager.Country');
		$country		=	 $this->Country->find('translations')->order(['name' => 'asc']);

		$this->set(compact('pageTitle','metaDescription','result','guideContent','type','onlineCasinotop','allCat','headBlock','WithdrawalLimit','currencies','withdrawalMethods','language','software','depositMethods','allCatSideBar','allCountry','gambling_options','country','live_chat','owner','manual_flushing','licences','devices'));
    }
	
	
    public function news_category()
    {	
		$this->loadModel('Master.Masters');
		
		$news_category = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'news_category',
					'is_deleted' => 0
				])->order(['name' => 'asc']);
		// pr($news_category);
		$this->set('news_category',$news_category);
    }	
	
	public function cms_side_bar()
    {	
		$this->loadModel('News.News');		
		$mostPopularNews = $this->News->find('translations')->select(['title','image','question_count','slug'])->order(['question_count' => 'desc'])->limit(5);
		
		$this->loadModel('News.News');		
		$latestNews = $this->News->find('translations')->select(['title','image','question_count','id','slug'])->order(['News.id' => 'desc'])->limit(5);
		
		$this->loadModel('Promotion.Promotions');
		$latestBonuses = $this->Promotions->find('all')->where(['is_main_promotion' => 1])->contain(['Casino' => ['fields' => ['avg_rating','slug','image','title']]])->order(['Promotions.id' => 'desc'])->limit(5);
		
		$this->loadModel('Casinos');		
		$recommedCasinos = $this->Casinos->find('all')->contain(['MainPromotion' => ['conditions' => ['is_main_promotion' => 1]]])->order(['Casinos.avg_rating' => 'desc'])->limit(5);
		
		$this->set(compact('mostPopularNews','latestBonuses','recommedCasinos','latestNews'));
    }	
	
	public function news_right_side_bar()
    {	
		$this->loadModel('News.News');		
		$mostPopularNews = $this->News->find('translations')->select(['title','image','question_count','slug'])->order(['question_count' => 'desc'])->limit(5);
		
		$this->loadModel('News.News');		
		$latestNews = $this->News->find('translations')->select(['title','image','question_count','id','slug'])->order(['News.id' => 'desc'])->limit(5);
		
		$this->loadModel('Promotion.Promotions');
		$latestBonuses = $this->Promotions->find('all')->where(['is_main_promotion' => 1])->contain(['Casino' => ['fields' => ['avg_rating','slug','image','title']]])->order(['Promotions.id' => 'desc'])->limit(5);
		
		$this->loadModel('Casinos');		
		$recommedCasinos = $this->Casinos->find('all')->contain(['MainPromotion' => ['conditions' => ['is_main_promotion' => 1]]])->order(['Casinos.avg_rating' => 'desc'])->limit(5);
		
		$this->set(compact('mostPopularNews','latestBonuses','recommedCasinos','latestNews'));
    }	
	
	public function news_right_side_bar_index()
    {	
		$this->loadModel('News.News');		
		$mostPopularNews = $this->News->find('translations')->select(['title','image','question_count','slug'])->order(['question_count' => 'desc'])->limit(5);
		
		$this->loadModel('Promotion.Promotions');
		$latestBonuses = $this->Promotions->find('all')->where(['is_main_promotion' => 1])->contain(['Casino' => ['fields' => ['avg_rating','slug','image','title']]])->order(['Promotions.id' => 'desc'])->limit(5);
		
		$this->loadModel('Casinos');		
		$recommedCasinos = $this->Casinos->find('all')->contain(['MainPromotion' => ['conditions' => ['is_main_promotion' => 1]]])->order(['Casinos.avg_rating' => 'desc'])->limit(5);
		
		$this->set(compact('mostPopularNews','latestBonuses','recommedCasinos'));
    }		
	
	public function casino_side_bar()
    {	
		
		
		$this->loadModel('Promotion.Promotions');
		$latestBonuses = $this->Promotions->find('all')->where(['is_main_promotion' => 1])->contain(['Casino' => ['fields' => ['avg_rating','slug','image','title']]])->order(['Promotions.id' => 'desc'])->limit(5);
		
		$this->loadModel('Casinos');		
		$recommedCasinos = $this->Casinos->find('all')->contain(['MainPromotion' => ['conditions' => ['is_main_promotion' => 1]]])->order(['Casinos.avg_rating' => 'desc'])->limit(5);
		
		$this->set(compact('mostPopularNews','latestBonuses','recommedCasinos'));
    }	
	
	public function casinosearch($casino)
    {	
		if($casino->type == 'normal'){
			$this->loadModel('Casinos');
			$result =	$this->Casinos->find('all')->contain(['City' => ['fields' => ['name']],'City.Country' => ['fields' => ['name']]])->where(['Casinos.id' => $casino->id])->select(['id'])->first();
			// pr($result);
		}elseif($casino->type == 'online'){
			$this->loadModel('Casinos');
			$result =	$this->Casinos->find('all')->contain(['MainPromotion' => ['fields' => ['text','slug']]])->where(['Casinos.id' => $casino->id])->select(['id'])->first();
			// pr($result);
		}
		
		$this->set(compact('casino','result'));
    }	
	
	function casinosearchpage(){
		$this->loadModel('Master.Masters');
		$gamblingOptions = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'gambling_options',
					'is_deleted' => 0					
				])->order(['name' =>'asc']);
		// pr($gamblingOptions)
		$amenities = $this->Masters->find('translations')
				->where([
					'Masters.type' => 'aminities',
					'Masters.parent_id !=' => 0,
					'is_deleted' => 0
				])->order(['name' =>'asc']);
		$this->set(compact('amenities','gamblingOptions'));
	}
}
