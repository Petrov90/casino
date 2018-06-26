<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Questions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $QuestionComments
 *
 * @method \App\Model\Entity\Question get($primaryKey, $options = [])
 * @method \App\Model\Entity\Question newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Question[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Question|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Question patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Question[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Question findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QuestionsTable extends Table
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

        $this->table('questions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
		
        $this->belongsTo('Casinos', [
            'foreignKey' => 'foreign_key',
            /* 'joinType' => 'LEFT', */
			'conditions' => array('Questions.type' => 'casino')
        ]); 
		
		$this->belongsTo('City', [
			'foreignKey' => 'foreign_key',
            'className' => 'CityManager.City',
            /* 'joinType' => 'INNER', */
			'table' => 'City',
			'conditions' => array('Questions.type' => 'city')
        ]);
		
		$this->belongsTo('Country', [
			'foreignKey' => 'foreign_key',
            'className' => 'CityManager.Country',
            /* 'joinType' => 'INNER', */
			'conditions' => array('Questions.type' => 'country')
        ]);
		
		$this->belongsTo('News', [
			'foreignKey' => 'foreign_key',
            'className' => 'News',
			'conditions' => array('Questions.type' => 'news')
        ]);
		
        $this->hasMany('QuestionComments', [
            'foreignKey' => 'question_id'/* ,
			'conditions' => function ($e, $query) {
				$query->limit(3);
				return [];
			}  */
        ]);
		
		$this->hasMany('QuestionLikes', [
            'foreignKey' => 'question_id'
        ]);
		
		$this->hasMany('QuestionSpams', [
            'foreignKey' => 'foreign_key',
			'conditions' => ['QuestionSpams.type' => 'question']
        ]);
		
		$this->addBehavior('CounterCache', [
            'Casinos' => [
				'question_count' => 
				[
					'conditions' => [
					  'type' => 'casino'
					]
				]
			],
            'City' => [
				'question_count' => 
				[
					'conditions' => [
					  'type' => 'city'
					]
				]
			],
            'Country' => [
				'question_count' => 
				[
					'conditions' => [
					  'type' => 'country'
					]
				]
			],
            'News' => [
				'question_count' => 
				[
					'conditions' => [
					  'type' => 'news'
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->requirePresence('foreign_key', 'create')
            ->notEmpty('foreign_key');

        $validator
            ->requirePresence('comment', 'create')
            ->notBlank('comment');

        $validator
            ->allowEmpty('language');

        $validator
            ->integer('like_count')
            ->allowEmpty('like_count');

        $validator
            ->integer('comment_count')
            ->allowEmpty('comment_count');

        $validator
            ->integer('user_points')
            ->allowEmpty('user_points');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
	
	public function validationAddReviewForm()
    {
		$validator = new Validator();
        $validator->requirePresence('comment',__('Please enter  required field.',true))	
					->notBlank('comment',__('Please enter  required field.',true))
					->add('checkbox', 'minLength', [
							'rule' => ['range',1,5],
							'min' => 1,
							'message' => 'Please accept term & conditions.'
						]);	
		
        return $validator;    
    }
	
	public function validationAddCommentForm()
    {
		$validator = new Validator();
        $validator->requirePresence('answer_comment',__('Please enter required field.',true))	
					->notBlank('answer_comment',__('Please enter  required field.',true));
					
		$validator->requirePresence('question_id',__('Please enter answer.',true))	
					->notEmpty('question_id',__('Please enter answer.',true));	
		
        return $validator;    
    }
}
