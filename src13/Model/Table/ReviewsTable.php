<?php
namespace App\Model\Table;

use App\Model\Entity\Review;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reviews Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class ReviewsTable extends Table
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

        $this->table('reviews');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
			'className' => 'Users'
        ]);
		$this->belongsTo('City', [
			'foreignKey' => 'foreign_key',
            'className' => 'CityManager.City',
            /* 'joinType' => 'INNER', */
			'table' => 'City',
			/* 'conditions' => array('Reviews.type' => 'city') */
        ]);
		
		$this->belongsTo('Country', [
			'foreignKey' => 'foreign_key',
            'className' => 'CityManager.Country',
            /* 'joinType' => 'INNER', */
			/* 'conditions' => array('Reviews.type' => 'country') */
        ]);
		
		$this->belongsTo('Casinos', [
			'foreignKey' => 'foreign_key',
            'className' => 'Casinos',
            /* 'joinType' => 'INNER', */
			/* 'conditions' => array('Reviews.type' => 'casino') */
        ]);
		
		$this->hasMany('ReviewLikes', [
            'className' => 'ReviewLikes',
            'joinType' => 'INNER'
        ]);
		
		$this->hasMany('ReviewComments', [
            'className' => 'ReviewComments',
            'joinType' => 'INNER',
			'sort' => ['ReviewComments.id' => 'asc']/* ,
			'conditions' => function ($e, $query) {
				$query->limit(3);
				return [];
			} */
        ]);
		
    }
	
	public function validationAddReviewForm()
    {
		$validator = new Validator();
        $validator/* ->requirePresence('rating',__('Please select rating.',true)) */
					/* ->notEmpty('rating',__('Please select rating.',true)) */
					->requirePresence('comment',__('Please enter message.',true))	
					->notBlank('comment',__('Please enter message.',true))
					->add('checkbox', 'minLength', [
							'rule' => ['range',1,5],
							'min' => 1,
							'message' => 'Please accept term & conditions.'
						]);	
		
        return $validator;    
    }
	

}
