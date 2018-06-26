<?php
namespace App\Model\Table;

use App\Model\Entity\CasinoGamblingOption;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CasinoGamblingOptions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Casinos
 */
class CasinoGamblingOptionsTable extends Table
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

        $this->table('casino_gambling_options');

        $this->belongsTo('Casinos', [
            'foreignKey' => 'casino_id',
            'joinType' => 'INNER'
        ]);
		
		  $this->belongsTo('Masters', [
            'foreignKey' => 'master_id',
			'className' => 'Master.Masters',
            'joinType' => 'INNER'
        ]);
		
		$this->addBehavior('Translate', ['fields' => ['name']]);

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
            ->integer('id')
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->integer('master')
            ->requirePresence('master', 'create')
            ->notEmpty('master');

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
        $rules->add($rules->existsIn(['casino_id'], 'Casinos'));
        return $rules;
    }
}
