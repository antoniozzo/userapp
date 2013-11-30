<?php

App::uses('ClassRegistry', 'Utility');
App::uses('AuthComponent', 'Controller/Component');

class AppSchema extends CakeSchema {

	public function before($event = array())
	{
		$db = ConnectionManager::getDataSource($this->connection);
		$db->cacheSources = false;

		return true;
	}

	public function after($event = array())
	{
		if (isset($event['create']) && !isset($event['errors']))
		{
			$table = $event['create'];

			switch ($table) {
				case 'users':
					$data = array(
						array(
							'email' => 'harry@potter.com',
							'password' => 'ilovelucious',
							'first_name' => 'Harry',
							'last_name' => 'Potter',
							'image' => 'harry.jpg'
						),
			        	array(
							'email' => 'lucious@malfoy.com',
							'password' => 'iloveharry',
							'first_name' => 'Lucious',
							'last_name' => 'Malfoy'
						)
					);
					ClassRegistry::init('User')->saveAll($data);
				break;
			}
	    }
	}

	public $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'first_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'last_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'image' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $logins = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_logins_users1' => array('column' => 'user_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
}