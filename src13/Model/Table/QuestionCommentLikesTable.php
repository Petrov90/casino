<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * QuestionCommentLikes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $QuestionComments
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\QuestionCommentLike get($primaryKey, $options = [])
 * @method \App\Model\Entity\QuestionCommentLike newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\QuestionCommentLike[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\QuestionCommentLike|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\QuestionCommentLike patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\QuestionCommentLike[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\QuestionCommentLike findOrCreate($search, callable $callback = null)
 */
class QuestionCommentLikesTable extends Table
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

        $this->table('question_comment_likes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('QuestionComments', [
            'foreignKey' => 'question_comment_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
		
		$this->addBehavior('CounterCache', [
            'QuestionComments' => [
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
            ->requirePresence('value', 'create')
            ->notEmpty('value');

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
        $rules->add($rules->existsIn(['question_comment_id'], 'QuestionComments'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
