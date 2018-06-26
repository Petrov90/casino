<?php
namespace Promotion\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Cache\Cache;

/**
 * PopularCasinos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Casinos
 *
 * @method \Promotion\Model\Entity\PopularCasino get($primaryKey, $options = [])
 * @method \Promotion\Model\Entity\PopularCasino newEntity($data = null, array $options = [])
 * @method \Promotion\Model\Entity\PopularCasino[] newEntities(array $data, array $options = [])
 * @method \Promotion\Model\Entity\PopularCasino|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Promotion\Model\Entity\PopularCasino patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Promotion\Model\Entity\PopularCasino[] patchEntities($entities, array $data, array $options = [])
 * @method \Promotion\Model\Entity\PopularCasino findOrCreate($search, callable $callback = null)
 */
class PopularCasinosTable extends Table
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

        $this->table('popular_casinos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Casinos', [
            'foreignKey' => 'casino_id',
            'joinType' => 'INNER',
            'className' => 'Casinos'
        ]); 
		
		$this->belongsTo('Casino', [
            'foreignKey' => 'casino_id',
            /* 'joinType' => 'INNER', */
            'className' => 'Casino'
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
            ->requirePresence('text', 'create')
            ->notEmpty('text');

       /*  $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');
		 */
		$validator
            ->requirePresence('casino_id', 'create','You need to select casino in the list')
            ->notEmpty('casino_id','You need to select casino in the list');
		
		$validator->add('logo',[
			'validExtension' => [
				'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
				'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')				
			]
        ])->allowEmpty('logo', 'update');
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
	
	public function afterSave($entity, $options = [])
	{
		Cache::delete('popularCasinos','longlong');
	} 
	
	public function afterDelete($entity, $options = [])
	{
		Cache::delete('popularCasinos','longlong');
	} 
}
