<?php

/**
 * User model
 *
 * @author Antonio Rizzo <info@antoniorizzo.com>
 */

App::uses('AppModel', 'Model');

class User extends AppModel {

	/**
	 * behaviors
	 */
	public $actsAs = array(
		'Cropable' => array(
			'image' => array(
				'thumbnailSizes' => array(
					'thumb' => array(
						'size' => '120x120',
						'quality' => 90
					)
				)
			)
		)
	);

	/**
	 * basic user validation
	 */
	public $validate = array(

		'email' => array(

			// check if real email
			'isEmail' => array(
				'rule' => array('email'),
				'message' => 'This is not a real email adress'
			),

			// check if email is registered
	        'isUnique' => array(
	            'rule'    => array('isUnique'),
				'message' => 'This email is already registered here'
	        )

		)

	);

	/**
	 * user associations
	 */
	public $hasMany = array('Login');

	/**
	 * __construct method
	 *
	 * @return void
	 */
	public function __construct($id = false, $table = null, $ds = null)
	{
	    parent::__construct($id, $table, $ds);

	    // Concat first and last name as full name
	    $this->virtualFields['full_name'] = sprintf('CONCAT(%s.first_name, " ", %s.last_name)', $this->alias, $this->alias);
	}
	
	/**
	 * beforeSave method
	 *
	 * @param array $options
	 * @return bool
	 */
	public function beforeSave($options = array())
	{
		// Hash password if provided
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		
		return true;
	}

}