<?php

App::uses('AuthComponent', 'Controller/Component');

class LoginFixture extends CakeTestFixture {

	public $import = array('table' => 'logins');

	public $records = array(
    	array(
			'id' => 1,
			'user_id' => 1,
			'created' => '2013-11-30 12:15:45',
			'modified' => '2013-11-30 12:15:45'
		),
    	array(
			'id' => 2,
			'user_id' => 1,
			'created' => '2013-11-30 13:15:45',
			'modified' => '2013-11-30 13:15:45'
		)
	);

}