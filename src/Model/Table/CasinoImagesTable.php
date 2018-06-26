<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CasinoLikes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Casinos
 *
 * @method \App\Model\Entity\CasinoLike get($primaryKey, $options = [])
 * @method \App\Model\Entity\CasinoLike newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CasinoLike[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CasinoLike|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CasinoLike patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CasinoLike[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CasinoLike findOrCreate($search, callable $callback = null)
 */
class CasinoImagesTable extends Table
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

        $this->table('casino_images');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Casinos', [
            'foreignKey' => 'object_id',
            'bindingKey' => 'object_id'
        ]);
		
		$this->belongsTo('City', [
			'className' => 'CityManager.City',
            'foreignKey' => 'object_id',
            'bindingKey' => 'object_id'
        ]);
		
		$this->belongsTo('Country', [
			'className' => 'CityManager.Country',
            'foreignKey' => 'object_id',
            'bindingKey' => 'object_id'
        ]);
    }
}
