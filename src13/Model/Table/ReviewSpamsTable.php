<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReviewSpams Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Reviews
 *
 * @method \App\Model\Entity\ReviewSpam get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReviewSpam newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReviewSpam[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReviewSpam|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReviewSpam patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewSpam[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReviewSpam findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReviewSpamsTable extends Table
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

        $this->table('review_spams');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Reviews', [
            'foreignKey' => 'review_id',
            'joinType' => 'LEFT',
			'conditions' => ['ReviewSpams.type' => 'review']

        ]);
		
		$this->belongsTo('ReviewComments', [
            'foreignKey' => 'review_id',
            'joinType' => 'LEFT',
			'conditions' => ['ReviewSpams.type' => 'comment']
        ]);
		
		$this->belongsTo('Master', [
            'foreignKey' => 'category',
            'joinType' => 'INNER',
			'className' => 'Master.Masters',

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
            ->integer('category')
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        return $validator;
    }
	
		public function validationReportAsSpam()
    {
		$validator = new Validator();
        $validator->requirePresence('category',__('Please select one of mentioned category.',true))
					->notEmpty('category',__('Please select one of mentioned category.',true));
					
		/* $validator->requirePresence('message',__('Please enter message.',true))
					->notEmpty('message',__('Please enter message.',true));
		 */
        return $validator;    
    }
	
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
/*     public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['review_id'], 'Reviews'));

        return $rules;
    } */
}
