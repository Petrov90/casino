<?php
namespace Promotion\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Promotion\Model\Entity\Promotion;
use Cake\ORM\TableRegistry;
use Cake\Cache\Cache;

/**
 * Promotions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Objects
 * @property \Cake\ORM\Association\BelongsTo $City
 * @property \Cake\ORM\Association\HasMany $PromotionAmenities
 * @property \Cake\ORM\Association\HasMany $PromotionGamblingOptions
 */
class PromotionsTable extends Table
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

        $this->table('promotions');
        $this->displayField('title');
        
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
		
		$this->addBehavior('Muffin/Slug.Slug', [
			'field' => 'slug',
			'displayField' => 'title',
			'onUpdate' => true
		]);
		
       /*  $this->belongsTo('Objects', [
            'foreignKey' => 'object_id',
            'joinType' => 'INNER',
            'className' => 'Promotion.Objects'
        ]); */
       
	    $this->belongsTo('Casino', [
            'foreignKey' => 'casino_id',
            'joinType' => 'LEFT',
            'className' => 'Casinos'
        ]);
		
		$this->belongsTo('Masters', [
            'className' =>	'Master.Masters'/* ,
            'joinType' => 'INNER' */
        ]);
		
		$this->hasMany('PromotionBonusTypes', [
            'className' =>	'Promotion.PromotionBonusTypes',
            'joinType' => 'LEFT'
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
        $validator
            ->requirePresence('bonus_amount', 'create')
            ->notBlank('bonus_amount');
	/* 
        $validator
            ->requirePresence('description', 'create')
            ->notBlank('description');
 */
		$validator
            ->requirePresence('casino_id', 'create','You need to select casino in the list')
            ->notBlank('casino_id','You need to select casino in the list');
		
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
        ])->allowEmpty('logo');
		
		$validator
            ->requirePresence('amount', 'create')
            ->notBlank('amount');
	
		/* $validator
            ->requirePresence('matched_amount', 'create')
            ->notBlank('matched_amount');
	 */
		$validator
            ->requirePresence('wagering', 'create')
            ->notBlank('wagering');
		
		$validator
            ->requirePresence('wagering', 'create')
            ->notBlank('wagering');
			
		$validator
            ->requirePresence('url', 'create')
            ->notBlank('url');
			
		$validator->requirePresence('small_text', 'create')->notBlank('small_text');
		$validator->requirePresence('small_text2', 'create')->notBlank('small_text2');
		
		
		$validator
            ->requirePresence('code', 'create')
            ->notBlank('code');
			
	/* 	$validator
            ->requirePresence('conditions', 'create')
            ->notBlank('conditions');
		 */
		$validator->add('gambling_options',[
			'notBlankCheck'=>[
				'rule'=>'notBlankCheck',
				'provider'=>'table',
				'message'=>'Please select atleast one type'
			 ]
			]);
		
		$validator->add('text1',[
			'notBlankCheck'=>[
				'rule'=>'notBlankCheckMessage',
				'provider'=>'table',
				'message'=>'Please enter message'
			 ]
			]);
		return $validator;
    }

	public function notBlankCheck($value,$context){ 
		if(isset($context['data']['gambling_options'])){
			foreach($context['data']['gambling_options'] as $options){
				if($options){
					return true;
				}
			}
		}
		return false;
	}
	
	public function notBlankCheckMessage($value,$context){ 
		if(isset($context['data']['text1'])){
			foreach($context['data']['text1'] as $options){
				$options	=	trim($options);
				if(empty($options) || $options == ''){ 
					return false;
				}
			}
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
   /*  public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['object_id'], 'Objects'));
        $rules->add($rules->existsIn(['city_id'], 'City'));
        return $rules;
    } */
	
	
	public function afterSave($entity, $options = [])
	{
	   //  echo "<pre>";
    //             print_r($entity);die;
		Cache::delete('promotions','longlong');
	} 
	
	public function afterDelete($entity, $options = [])
	{
		Cache::delete('promotions','longlong');
	} 
}
