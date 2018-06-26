<?php
namespace GuideContent\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Master\Model\Entity\Master;

/**
 * GuideContents Model
 *
 * @method \GuideContent\Model\Entity\GuideContent get($primaryKey, $options = [])
 * @method \GuideContent\Model\Entity\GuideContent newEntity($data = null, array $options = [])
 * @method \GuideContent\Model\Entity\GuideContent[] newEntities(array $data, array $options = [])
 * @method \GuideContent\Model\Entity\GuideContent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \GuideContent\Model\Entity\GuideContent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \GuideContent\Model\Entity\GuideContent[] patchEntities($entities, array $data, array $options = [])
 * @method \GuideContent\Model\Entity\GuideContent findOrCreate($search, callable $callback = null)
 */
class GuideContentsTable extends Table
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

        $this->table('guide_contents');
        $this->displayField('title');
        $this->primaryKey('id');
		
		
		$this->addBehavior('Translate', ['fields' => ['title','description','second_description','h1t','h1d','h2t','h2d','h3t','h3d','sdescription','image_alt']]);
		
		$this->addBehavior('Muffin/Slug.Slug', [
			'field' => 'slug',
			'displayField' => 'title',
			'onUpdate' => true
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');
		
		$validator
            ->requirePresence('second_description', 'create')
            ->notEmpty('second_description');

      $validator
            ->requirePresence('sdescription', 'create')
            ->notEmpty('sdescription');

      
		$validator->add('image',[			
			'fileSize' => [
				'rule' => ['fileSize', '<=', FILE_SIZE_IN_KB],
				'last' => true,
				'message' => __('File must be less then '.FILE_SIZE_IN_MB)
			],
            'validExtension' => [
                'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
                'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')               
            ]
        ])->allowEmpty('image','update');
       
		$validator->add('image2',[			
			'fileSize' => [
				'rule' => ['fileSize', '<=', FILE_SIZE_IN_KB],
				'last' => true,
				'message' => __('File must be less then '.FILE_SIZE_IN_MB)
			],
            'validExtension' => [
                'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
                'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')               
            ]
        ])->allowEmpty('image2','update');
       
	
        return $validator;
    }
}
