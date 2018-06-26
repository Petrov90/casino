<?php
namespace CasinoActivities\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * CasinoActivities Model
 *
 * @property \Cake\ORM\Association\HasMany $CasinoActivitityDatas
 *
 * @method \CasinoActivities\Model\Entity\CasinoActivity get($primaryKey, $options = [])
 * @method \CasinoActivities\Model\Entity\CasinoActivity newEntity($data = null, array $options = [])
 * @method \CasinoActivities\Model\Entity\CasinoActivity[] newEntities(array $data, array $options = [])
 * @method \CasinoActivities\Model\Entity\CasinoActivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \CasinoActivities\Model\Entity\CasinoActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \CasinoActivities\Model\Entity\CasinoActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \CasinoActivities\Model\Entity\CasinoActivity findOrCreate($search, callable $callback = null)
 */
class CasinoActivitiesTable extends Table
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

        $this->table('casino_activities');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->hasMany('CasinoActivitityDatas', [
            'foreignKey' => 'casino_activity_id',
            'className' => 'CasinoActivities.CasinoActivitityDatas'
        ]); 
		
		$this->hasMany('CasinoImages', [
            'foreignKey' => 'object_id',
			'bindingKey' => 'object_id',
            'className' => 'CasinoImages'
        ]);
		$this->belongsTo('ParentMasters', [
            'className' => 'CasinoActivities',
            'foreignKey' => 'parent_id'
        ]);
		
		$this->hasMany('ChildMasters', [
            'className' => 'CasinoActivities',
            'foreignKey' => 'parent_id',
			'conditions' => ['is_deleted' => 0]
        ]);
		
		$this->hasMany('ActivityInfo', [
            'className' => 'Master.Masters',
            'foreignKey' => 'mater_id'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

		if(!empty($this->type)){
       /*  $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description'); */

		/*  $validator->add('object_id',[
				'notEmptyCheck'=>[
					'rule'=>'notEmptyCheck',
					'provider'=>'table',
					'message'=>'Please select atleast one image'
				 ]
			]);  */
		}
        return $validator;
    }
	public function notEmptyCheck($value,$context){
		$object_id	 	 =	$context['data']['object_id'];
		$CasinoImage	 =  TableRegistry::get('CasinoImages');
		$CasinoImage	 =	$CasinoImage->find('all')->where(array('object_id' => $object_id))->first();
		if(empty($CasinoImage)){
			return false;
		}
		return true;
	}
}
