<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RestricatedCountries Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Casinos
 * @property \Cake\ORM\Association\BelongsTo $Countries
 *
 * @method \App\Model\Entity\RestricatedCountry get($primaryKey, $options = [])
 * @method \App\Model\Entity\RestricatedCountry newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RestricatedCountry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RestricatedCountry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RestricatedCountry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RestricatedCountry[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RestricatedCountry findOrCreate($search, callable $callback = null)
 */
class RestricatedCountriesTable extends Table
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

        $this->table('restricated_countries');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Casinos', [
            'foreignKey' => 'casino_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
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
        $rules->add($rules->existsIn(['country_id'], 'Countries'));

        return $rules;
    }
}
