<?php
namespace Custom\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomFields Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CustomPages
 *
 * @method \Custom\Model\Entity\CustomField get($primaryKey, $options = [])
 * @method \Custom\Model\Entity\CustomField newEntity($data = null, array $options = [])
 * @method \Custom\Model\Entity\CustomField[] newEntities(array $data, array $options = [])
 * @method \Custom\Model\Entity\CustomField|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Custom\Model\Entity\CustomField patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Custom\Model\Entity\CustomField[] patchEntities($entities, array $data, array $options = [])
 * @method \Custom\Model\Entity\CustomField findOrCreate($search, callable $callback = null)
 */
class CustomFieldsTable extends Table
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

        $this->table('custom_fields');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('CustomPages', [
            'foreignKey' => 'custom_page_id',
            'joinType' => 'INNER',
            'className' => 'Custom.CustomPages'
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

        $validator
            ->requirePresence('field_name', 'create')
            ->notEmpty('field_name');

        $validator
            ->requirePresence('field_value', 'create')
            ->notEmpty('field_value');

        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

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
        $rules->add($rules->existsIn(['custom_page_id'], 'CustomPages'));

        return $rules;
    }
}
