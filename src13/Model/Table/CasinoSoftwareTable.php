<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CasinoSoftware Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Casinos
 * @property \Cake\ORM\Association\BelongsTo $Masters
 *
 * @method \App\Model\Entity\CasinoSoftware get($primaryKey, $options = [])
 * @method \App\Model\Entity\CasinoSoftware newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CasinoSoftware[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CasinoSoftware|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CasinoSoftware patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CasinoSoftware[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CasinoSoftware findOrCreate($search, callable $callback = null)
 */
class CasinoSoftwareTable extends Table
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

        $this->table('casino_software');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Casinos', [
            'foreignKey' => 'casino_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Masters', [
            'foreignKey' => 'master_id',
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
            ->allowEmpty('id', 'create');

        $validator
            ->integer('value')
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
        $rules->add($rules->existsIn(['casino_id'], 'Casinos'));
        $rules->add($rules->existsIn(['master_id'], 'Masters'));

        return $rules;
    }
}
