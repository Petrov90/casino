<?php
namespace CasinoContent\Model\Table;

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
class CasinoContentsTable extends Table
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

        $this->table('casino_contents');
        $this->displayField('title');
        $this->primaryKey('id');
        
        $this->addBehavior('Timestamp');
        $this->addBehavior('Translate', ['fields' => ['title','description']]);

        $this->addBehavior('Muffin/Slug.Slug', [
            'field' => 'slug',
            'displayField' => 'title'
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

      
$validator->add('image',[
            'validExtension' => [
                'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
                'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')               
            ]
        ])->allowEmpty('image','update');
       
$validator->add('back_image',[
            'validExtension' => [
                'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
                'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')               
            ]
        ])->allowEmpty('back_image','update');

        return $validator;
    }
}
