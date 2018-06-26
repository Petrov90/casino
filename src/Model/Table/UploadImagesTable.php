<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UploadImages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UploadImage get($primaryKey, $options = [])
 * @method \App\Model\Entity\UploadImage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UploadImage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UploadImage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UploadImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UploadImage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UploadImage findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UploadImagesTable extends Table
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

        $this->table('upload_images');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
		
		$this->belongsTo('City', [
			'foreignKey' => 'foreign_key',
            'className' => 'CityManager.City',
			'conditions' => array('UploadImages.type' => 'city')
        ]);
		
		$this->belongsTo('Country', [
			'foreignKey' => 'foreign_key',
            'className' => 'CityManager.Country',
			'conditions' => array('UploadImages.type' => 'country')
        ]);
		
		$this->belongsTo('Casinos', [
			'foreignKey' => 'foreign_key',
            'className' => 'Casinos',
			'conditions' => array('UploadImages.type' => 'casino')
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
            ->requirePresence('image', 'create')
            ->notEmpty('image');

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
}
