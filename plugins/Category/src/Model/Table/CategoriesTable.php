<?php
namespace Category\Model\Table;

use Category\Model\Entity\Categories;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Cache\Cache;

/**
 * Blocks Model
 *
 */
class CategoriesTable extends Table
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

        $this->table('categories');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
		$this->addBehavior('Translate', ['fields' => [
			'title',
			'sub_title',
			'sub_title_description',
            'middle_title',
			'middle_title_description',
			'icon_title',
			'description',
			'head_first_block',
			'head_second_block',
            'second_description',
            'footer_main_title',
            'preview_text',
            'preview_title',
            'preview_url_title'
			]]);
		
		
		/* $this->addBehavior('Muffin/Slug.Slug', [
			'field' => 'slug',
			'displayField' => 'title'
		]); */
		
		$this->belongsTo('Countries', [
            'className' =>	'CityManager.Countries',
            /* 'joinType' => 'INNER' */
        ]);
		
		$this->hasMany('CountryPages', [
            'className' =>	'CountryPages',
            'joinType' => 'INNER'
        ]);
		 // <!--Start  New changing (04/08/17) by kp shekhawat -->
        $this->hasMany('FaqQuestions', [
            'className' =>  'FaqQuestions',
            'joinType' => 'INNER'
        ]);
		  $this->hasMany('GuideContents', [
            'className' =>  'GuideContents',
            'joinType' => 'INNER'
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
			
			
		$validator->notBlank('page_title');
		$validator->notBlank('meta_description');
		
        
     

        $validator
            /* ->requirePresence('icon_title', 'create') */
            ->notBlank('icon_title');

       
	
		 $validator
            /* ->requirePresence('description', 'create') */
            ->notBlank('preview_text');
		
		$validator->notBlank('second_description');
		$validator->notBlank('head_first_block');
		$validator->notBlank('head_second_block');
		$validator->notBlank('preview_title');
		$validator->notBlank('preview_url_title');
		
		$validator
			->add('image',[
			'validExtension' => [
				'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
				'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')				
			]
        ])->allowEmpty('image');
		
		$validator->add('slug', 'unique', [
			'rule' => 'validateUnique',
			'provider' => 'table',
			'message' => 'Slug is alreay exists.Please enter a unique slug.'
		]);
		
		$validator
			->add('head_image',[
            'validExtension' => [
                'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
                'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')               
            ]
        ])->allowEmpty('head_image');


		$validator
			->add('back_image',[
			'validExtension' => [
				'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
				'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')				
			]
        ])->allowEmpty('back_image');
		
        return $validator;
    }	
}
