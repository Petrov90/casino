<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UserPreference extends Table
{
	
	public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('user_preference');
        $this->primaryKey('id');

    }
	
	
}