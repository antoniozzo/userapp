<?php

/**
 * Login model for storing last logins
 *
 * @author Antonio Rizzo <info@antoniorizzo.com>
 */

App::uses('AppModel', 'Model');

class Login extends AppModel {

	/**
	 * basic login validation
	 */
	public $validate = array(

		'user_id' => array(

			// check if numeric
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'user_id must be numeric'
			)

		)

	);
	
	/**
	 * beforeSave method
	 *
	 * @param array $options
	 * @return bool
	 */
	public function beforeSave($options = array())
	{
		// Inject current logged in user if user_id is not provided
		if (!isset($this->data[$this->alias]['user_id'])) {
			$this->data[$this->alias]['user_id'] = CakeSession::read('Auth.user.id');
		}
		
		return true;
	}

}