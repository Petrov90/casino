<?php
namespace Custom\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomPages Model
 *
 * @property \Cake\ORM\Association\HasMany $CustomFields
 *
 * @method \Custom\Model\Entity\CustomPage get($primaryKey, $options = [])
 * @method \Custom\Model\Entity\CustomPage newEntity($data = null, array $options = [])
 * @method \Custom\Model\Entity\CustomPage[] newEntities(array $data, array $options = [])
 * @method \Custom\Model\Entity\CustomPage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Custom\Model\Entity\CustomPage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Custom\Model\Entity\CustomPage[] patchEntities($entities, array $data, array $options = [])
 * @method \Custom\Model\Entity\CustomPage findOrCreate($search, callable $callback = null)
 */
class CustomPagesTable extends Table
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

        $this->table('custom_pages');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('CustomFields', [
            'foreignKey' => 'custom_page_id',
            'className' => 'Custom.CustomFields'
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
            ->requirePresence('slug', 'create')
            ->notEmpty('slug');

        return $validator;
    }
}
