<?php
namespace CasinoActivities\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CasinoActivityDatas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Casinos
 * @property \Cake\ORM\Association\BelongsTo $CasinoActivities
 *
 * @method \CasinoActivities\Model\Entity\CasinoActivityData get($primaryKey, $options = [])
 * @method \CasinoActivities\Model\Entity\CasinoActivityData newEntity($data = null, array $options = [])
 * @method \CasinoActivities\Model\Entity\CasinoActivityData[] newEntities(array $data, array $options = [])
 * @method \CasinoActivities\Model\Entity\CasinoActivityData|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CasinoActivities\Model\Entity\CasinoActivityData patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CasinoActivities\Model\Entity\CasinoActivityData[] patchEntities($entities, array $data, array $options = [])
 * @method \CasinoActivities\Model\Entity\CasinoActivityData findOrCreate($search, callable $callback = null)
 */
class CasinoActivityDatasTable extends Table
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

        $this->table('casino_activity_datas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Casinos', [
            'foreignKey' => 'casino_id',
            'joinType' => 'INNER',
            'className' => 'CasinoActivities.Casinos'
        ]);
        $this->belongsTo('CasinoActivities', [
            'foreignKey' => 'casino_activity_id',
            'joinType' => 'INNER',
            'className' => 'CasinoActivities.CasinoActivities'
        ]);
		
		 $this->belongsTo('ChildMasters', [
			'className' => 'Master.Masters',
            'foreignKey' => 'master_id',
            'joinType' => 'INNER'
        ]); 
		$this->belongsTo('ParentMasters', [
            'foreignKey' => 'parent_id',
            'className' => 'CasinoActivities.CasinoActivities',
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
            ->integer('id')
            ->allowEmpty('id', 'create');

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
        $rules->add($rules->existsIn(['casino_activity_id'], 'CasinoActivities'));

        return $rules;
    }
}
