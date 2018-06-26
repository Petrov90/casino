<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FollowersTable extends Table
{
	
	public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
		
		$this->hasMany('UserFollowers', [
            'className' => 'UserFollowers'
        ]);
		
		$this->hasMany('UserFollower', [
			'className' => 'UserFollowers',
            'foreignKey' => 'user_id',
            // 'joinType' => 'INNER',
			// 'conditions' => ['UserFollower.is_deleted' => 0]
        ]);
    }
}