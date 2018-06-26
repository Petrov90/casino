<?php
namespace App\Model\Table;

use App\Model\Entity\Casino;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
/**
 * Casinos Model
 *
 */
class CasinosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('casinos');
        $this->displayField('title');
        $this->primaryKey('id');
		
		/* $this->addBehavior('Muffin/Slug.Slug', [
			// Optionally define your custom options here (see Configuration)
		]);
		 */
        $this->addBehavior('Timestamp');		
		// $this->addBehavior('Sitemap.Sitemap');
		
        $this->hasMany('CasinoAmenities', [
            'className' => 'CasinoAmenities',
            'foreignKey' => 'casino_id'
        ]);

		
		$this->hasMany('CasinoImages', [
            'className' => 'CasinoImages',
            'foreignKey' => 'object_id',
            'bindingKey' => 'object_id',
			'sort' => ['CasinoImages.display_order' =>'asc']

        ]); 
		
		$this->hasMany('RestricatedCountries', [
            'className' => 'RestricatedCountries',
            'foreignKey' => 'casino_id' ,
			'joinType' => 'INNER',
        ]); 
		
		$this->hasMany('CasinoSoftware', [
            'className' => 'CasinoSoftware',
            'foreignKey' => 'casino_id',
			'sort' => 'CasinoSoftware.id ASC'
        ]); 
		
		$this->hasMany('CasinoDepositMethods', [
            'className' => 'CasinoSoftware',
            'foreignKey' => 'casino_id',
			'sort' => 'CasinoDepositMethods.id ASC'
		]); 
		
		$this->hasMany('CasinoDevices', [
            'className' => 'CasinoSoftware',
            'foreignKey' => 'casino_id',
			'sort' => 'CasinoDevices.id ASC'
		]); 
		
		$this->hasMany('CasinoCurrencies', [
            'className' => 'CasinoSoftware',
            'foreignKey' => 'casino_id',
			'sort' => 'CasinoCurrencies.id ASC'
		]); 
		// 'software','deposit_methods','currencies','language','withdrawal_methods','withdrawal_limit','devices'
		$this->hasMany('CasinoLanguage', [
            'className' => 'CasinoSoftware',
            'foreignKey' => 'casino_id',
			'sort' => 'CasinoLanguage.id ASC'
		]); 
		$this->hasMany('CasinoWithdrawalMethods', [
            'className' => 'CasinoSoftware',
            'foreignKey' => 'casino_id',
			'sort' => 'CasinoWithdrawalMethods.id ASC'
		]); 
		$this->hasMany('CasinoWithdrawalLimit', [
            'className' => 'CasinoSoftware',
            'foreignKey' => 'casino_id',
			'sort' => 'CasinoWithdrawalLimit.id ASC'
		]); 
		
		$this->hasMany('CasinoLicences', [
            'className' => 'CasinoSoftware',
            'foreignKey' => 'casino_id',
			'sort' => 'CasinoLicences.id ASC'
		]); 
		
		$this->hasMany('CasinoGamblingOptions', [
            'className' => 'CasinoGamblingOptions',
            'foreignKey' => 'casino_id'
        ]);
		
		$this->hasMany('CasinoActivityDatas', [
            'className' => 'CasinoActivities.CasinoActivityDatas',
            'foreignKey' => 'casino_id'
        ]);
		
		$this->belongsTo('Masters', [
            'className' =>	'Master.Masters',
            /* 'joinType' => 'INNER' */
        ]);
		
		$this->belongsTo('City', [
            'className' =>	'CityManager.City',
            /* 'joinType' => 'LEFT', */
			 'foreignKey' => 'city_id'
        ]);
	
		$this->belongsTo('Country', [
            'className' =>	'CityManager.Country',
            'joinType' => 'LEFT'
        ]);
		
		$this->hasMany('Reviews', [
            'foreignKey' => 'foreign_key',
            'joinType' => 'LEFT',
			'className' =>	'Reviews',
			'sort' => 'Reviews.id DESC',
			'conditions' => array('Reviews.type' => 'casino')
        ]); 
		
		$this->hasMany('Questions', [
            'foreignKey' => 'foreign_key',
            'joinType' => 'LEFT',
			'className' =>	'Questions',
			'sort' => 'Questions.id DESC',
			'condionts' => ['Questions.type' => 'casino']
        ]); 
		
		$this->hasMany('singleReview', [
            'foreignKey' => 'foreign_key',
            'joinType' => 'LEFT',
			'className' =>	'Reviews',
			'sort' => 'singleReview.id DESC',
			'conditions' => function ($e, $query) {
				$query->limit(1);
				return [];
			} 
        ]); 
		
		$this->hasMany('Promotions', [
            'foreignKey' => 'casino_id',
            /* 'joinType' => 'LEFT', */
            'className' => 'Promotion.Promotions',
			'sort' => ['Promotions.is_main_promotion' =>'desc']
        ]);
		
		$this->hasOne('MainPromotion', [
            'foreignKey' => 'casino_id',
            'joinType'   => 'INNER',
            'className'  => 'Promotion.Promotions',
			'sort' => ['MainPromotion.is_main_promotion' =>'desc']

			 /* 'conditions' => function ($e, $query) {
				$query->limit(1);
				return [];
			}  */
        ]);
		
		
		$this->hasMany('CasinoVisits', [
            'className' => 'CasinoVisits',
            'foreignKey' => 'casino_id',
			'joinType' => 'INNER'
        ]);
		$this->hasMany('CasinoLikes', [
            'className' => 'CasinoLikes',
            'foreignKey' => 'casino_id',
			'joinType' => 'INNER'
        ]);
		$this->hasMany('PopularCasinos', [
            'className' => 'Promotion.PopularCasinos',
            'foreignKey' => 'casino_id'
        ]);
		
		$this->addBehavior('CounterCache', [
            'City' => ['casino_count']
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
		
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notBlank('title');
		
		/* $validator
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');
		 */
		$validator->add('slug', 'unique', [
			'rule' => 'validateUnique',
			'provider' => 'table',
			'message' => 'Slug is alreay exists.Please enter a unique slug.'
		]);
    /*     $validator
            ->requirePresence('sdescription', 'create')
            ->notEmpty('sdescription'); */
		
		$validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');
		
		$validator->notEmpty('tdescription');

		$validator->notEmpty('fdescription');
		
		
		$validator->add('payout_percentage', 'comparison', [
			'rule' => function ($value, $context) {
				if(is_numeric($value) && $value >= 0 && $value <= 100){
					return true;	
				}
				return false;
			},
			/* 'message' => 'Small size cannot be bigger than Big size.' */
		]);
		
        $validator
            /* ->requirePresence('address', 'create') */
            ->notEmpty('address'); 
		
		// $validator
            /* ->requirePresence('address', 'create') */
            // ->notEmpty('review'); 
		 
		$validator
            /* ->requirePresence('address', 'create') */
            ->notEmpty('country_id'); 
		
		$validator
            /* ->requirePresence('city_name', 'create','You need to select city in the list') */
            ->notEmpty('city_name','You need to select city in the list');
		$validator
            /* ->requirePresence('city_id', 'create','You need to select city in the list') */
            ->notEmpty('city_id','You need to select city in the list');
/* 
        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');
		
		$validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');
		 */	
		if(isset($this->type) && $this->type == 'normal'){
			
		}else{
			$validator->add('object_id',[
				'notEmptyCheck'=>[
					'rule'=>'notEmptyCheck',
					'provider'=>'table',
					'message'=>'Please select atleast one image'
				 ]
			]); 
		}
		$validator->add('min_time',[
				'minmaxtime'=>[
					'rule'=>'minmaxtime',
					'provider'=>'table',
					'message'=>'Please select valid time'
				 ]
			]);
		$validator->add('type1',[
				'minmaxtime'=>[
					'rule'=>'minmaxtime',
					'provider'=>'table',
					'message'=>'Please select valid time'
				 ]
			]);
		$validator->add('max_time',[
				'minmaxtime'=>[
					'rule'=>'minmaxtime',
					'provider'=>'table',
					'message'=>'Please select valid time'
				 ]
			]);
		$validator->add('type2',[
				'minmaxtime'=>[
					'rule'=>'minmaxtime',
					'provider'=>'table',
					'message'=>'Please select valid time'
				 ]
			]);
			
		$validator->add('logo',[
			'fileSize' => [
				'rule' => ['fileSize', '<=', FILE_SIZE_IN_KB],
				'last' => true,
				'message' => __('File must be less then '.FILE_SIZE_IN_MB)
			],
			'validExtension' => [
				'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
				'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')				
			]
        ])->allowEmpty('logo','update');
		
		return $validator;
    }
	
	public function notEmptyCheck($value,$context){
		$object_id	 	 =	$context['data']['object_id'];
		$CasinoImage	 =  TableRegistry::get('CasinoImages');
		$CasinoImage	 =	$CasinoImage->find('all')->where(array('object_id' => $object_id))->first();
		if(empty($CasinoImage)){
			return false;
		}
		return true;
	}
	
	public function minmaxtime($value,$context){
		$min1	 	 =	$context['data']['min_time'];
		$min2	 	 =	$context['data']['type1'];
		$min3	 	 =	$context['data']['max_time'];
		$min4	 	 =	$context['data']['type2'];
		
		if($min2 == 'hour'){
			$mintime = $min1*3600;
		}else{
			$mintime = $min1*3600*24;
		}
		
		if($min4 == 'hour'){
			$maxtime = $min3*3600;
		}else{
			$maxtime = $min3*3600*24;
		}
		
		if($maxtime < $mintime){
			return false;
		}
		return true;
	}

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
  /*   public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['slug']));
        return $rules;
    } */
	
	
	/* public function beforeFind($event, $query, $options, $primary)
	{ 
		$query->cache('cache_key');
		$query->cache('longlong', 'longlong');
		
		$query->cache(function ($q) {
		  $key = serialize($q->clause('select'));
		  $key .= serialize($q->clause('where'));
		  return md5($key);
		});
	} */
	
	public function getUrl(\Cake\ORM\Entity $entity) {
		if($entity->type == 'normal'){
			return WEBSITE_URL.'casino/'.$entity->slug;
		}else{
			return WEBSITE_URL.'online-casinos/'.$entity->slug;
		}
	}
}
