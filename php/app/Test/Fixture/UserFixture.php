<?php

App::uses('AuthComponent', 'Controller/Component');

class UserFixture extends CakeTestFixture {

	public $import = array('table' => 'users');

	public function init()
	{
        $this->records = array(
        	array(
				'id' => 1,
				'email' => 'harry@potter.com',
				'password' => AuthComponent::password('ilovelucious'),
				'created' => '2013-11-30 10:15:45',
				'modified' => '2013-11-30 10:15:45'
			),
        	array(
				'id' => 2,
				'email' => 'lucious@malfoy.com',
				'password' => AuthComponent::password('iloveharry'),
				'created' => '2013-11-30 10:15:45',
				'modified' => '2013-11-30 10:15:45'
			)
		);
        parent::init();
    }

}