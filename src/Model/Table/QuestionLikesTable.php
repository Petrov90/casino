<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * QuestionLikes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Questions
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\QuestionLike get($primaryKey, $options = [])
 * @method \App\Model\Entity\QuestionLike newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\QuestionLike[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\QuestionLike|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\QuestionLike patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\QuestionLike[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\QuestionLike findOrCreate($search, callable $callback = null)
 */
class QuestionLikesTable extends Table
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

        $this->table('question_likes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
		
		$this->addBehavior('CounterCache', [
            'Questions' => [
		          'like_count' => [
		              'conditions' => [
		                  'value' => 'yes'
		              ]
		          ],
				  'dislike_count' => [
		              'conditions' => [
		                  'value' => 'no'
		              ]
		          ]
		      ]
        ]);
		
	/* 	$this->addBehavior('CounterCache', [
            'Questions' => [
		          'dislike_count' => [
		              'conditions' => [
		                  'value' => 'no'
		              ]
		          ]
		      ]
        ]); */
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
            ->allowEmpty('value');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['question_id'], 'Questions'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
