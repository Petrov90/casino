<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
	
	public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        /* $this->displayField('full_name'); */
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');		
		
		
		$this->addBehavior('Muffin/Slug.Slug', [
			'field' => 'slug',
			'displayField' => 'full_name'
		]);
		
		$this->hasOne('UserFollowers', [
            'className' => 'UserFollowers',
			 'joinType' => 'LEFT'
        ]);
		
		$this->hasOne('HeFollowME', [
			'foreignKey' => 'follower_id',
            'className' => 'UserFollowers',
			 'joinType' => 'LEFT'
        ]);
		
		
		$this->hasOne('IFollowHIM', [
			'foreignKey' => 'follower_id',
            'className' => 'UserFollowers',
			 'joinType' => 'LEFT'
        ]);
		
		$this->hasMany('UserPreference', [
            'className' => 'UserPreference'
        ]);
		
		
        $this->addBehavior('Captcha', [
			'field' => 'securitycode',
			'message' => 'Incorrect captcha code value'
		]);

    }

	public function validationAdminEditProfile()
    {
		
		$validator = new Validator();
        $validator
            ->requirePresence('sex')
            ->notEmpty('sex'); 
		$validator
            ->requirePresence('email')
			->add('email', 'validFormat', [
				'rule' => 'email',
				'message' => 'E-mail must be valid'
			]);
		$validator
            ->add('new_password', 'passwordsEqual', [
				'rule' => function ($value, $context) {
					return
						isset($context['data']['confirm_password']) && $context['data']['confirm_password'] === $value;
				}
			])->allowEmpty('new_password', 'update');
		$validator
            ->add('old_password', 'oldPassword', [
				'rule' => function ($value, $context) {
					return
						isset($context['data']['old_password']) && $context['data']['old_password'] === $value;
				}
			])->allowEmpty('old_password', 'update');
			
        return $validator;    
    }
	
	
	public function validationUpdateProfile()
    {
		
		$validator = new Validator();
        $validator->requirePresence('full_name',true,__('Please enter full name'));
        $validator->notBlank('full_name',__('Please enter full name'));
		
		$validator->requirePresence('email',true,__('Please enter email'))
			->add('email', 'validFormat', [
				'rule' => 'email',
				'message' => 'E-mail must be valid'
			])
			->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table','message' => 'Email id already exists.Please login with your exists account']);
		
		/* $validator->requirePresence('password1',true,__('Please enter password'));
        $validator->notEmpty('password1',__('Please enter password'))
			->add('password1', [
				'length' => [
					'rule' => ['minLength', 6],
					'message' => 'Password need to be at least 6 characters long',
				]
			]);
			 */
		$validator->requirePresence('city',true,__('Please enter city',true));
		$validator->notEmpty('city', __('Please enter city',true));
		
		$validator->requirePresence('country_id',true,__('Please select country',true));
		$validator->notEmpty('country_id', __('Please select country',true));
		
		/* $validator->requirePresence('accept',true,__('Please accept term & conditions',true)); */
		/* $validator->notEmpty('accept', __('Please accept term & conditions',true)); */
			 
        return $validator;    
    }
	
	public function validationContactUsForm()
    {
		
		$validator = new Validator();
        $validator->requirePresence('name',__('Please enter name.',true)); 
		
		$validator->requirePresence('email')
			->add('email', 'validFormat', [
				'rule' => 'email',
				'message' => 'E-mail must be valid'
			]);
		$validator->requirePresence('subject',__('Please enter subject.',true)); 	
		$validator->requirePresence('master_id',__('Please select department.',true)); 	
		$validator->requirePresence('message',__('Please enter message.',true)); 	
        return $validator;    
    }	
	
	public function emailUniqueCheck($value,$context){
		$email	 	 =	$context['data']['email'];
		$CasinoImage	 =	$this->find('all')->where(array('email' => $email,'is_deleted' => 0))->first();
		if(empty($CasinoImage)){
			return true;
		}
		return false;
	}
	
	public function validationSignUpForm()
    {
		
		$validator = new Validator();
		$validator
            ->requirePresence('sex',__('Please select sex.',true))
            ->notEmpty('sex',__('Please select sex.',true));
		
		$validator
            ->requirePresence('full_name',__('Please enter full name.',true))
            ->notBlank('full_name',__('Please enter full name.',true));

		$validator
            ->notEmpty('email',__('Please enter E-mail.',true))
			->add('email', 'validFormat', [
				'rule' => 'email',
				'message' => __('E-mail must be valid.',true)
			])->add('email',[
				'emailUniqueCheck'=>[
					'rule'	  	=>  'emailUniqueCheck',
					'provider' 	=>  'table',
					'message'	=>	'Email id already exists.Please login with your exists account'
				 ]
			]);

			
		$validator
			->notEmpty('password',__('Please enter password.',true))
			->requirePresence('password',__('Please enter password.',true))
            ->add('password', [
				'length' => [
					'rule' => ['minLength', 6],
					'message' => 'Password need to be at least 6 characters long',
				]
			])->add('password', 'passwordsEqual', [
				'rule' => function ($value, $context) {
					return
						isset($context['data']['password']) && $context['data']['c_password'] === $value;
				},
				'message' => __('Password or Confirm password does not match.',true)
			]);
			
		$validator
			->notEmpty('c_password',__('Please enter confirm password.',true))
			->requirePresence('c_password',__('Please enter confirm password.',true));
        // pr($validator);
        return $validator;    
    }
	
	public function validationUploadImageForm()
    {
		$validator = new Validator();		
        $validator		
		->notEmpty('image',__('Please select an image.',true))
		->add('image',[
			 'validExtension' => [
                    'rule' => ['extension'], // default  ['gif', 'jpeg', 'png', 'jpg']
                    'message' => __('These files extension are allowed: .gif, .jpeg, .png, .jpg')
                ]
        ]);
		// PR($validator);
		return $validator;    
    }
	
	public function validationForgotPasswordForm()
    {
		
		$validator = new Validator();       
		$validator
            ->notEmpty('email',__('Please enter E-mail.',true))
			->add('email', 'validFormat', [
				'rule' => 'email',
				'message' => __('E-mail must be valid.',true)
			]);
		
        return $validator;    
    }
	
	 
}