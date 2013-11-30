<?php

class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '127.0.0.1',
		'port' => '8889',
		'login' => 'root',
		'password' => 'root',
		'database' => 'cakebb',
		'prefix' => '',
		'encoding' => 'utf8',
	);

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '127.0.0.1',
		'port' => '8889',
		'login' => 'root',
		'password' => 'root',
		'database' => 'cakebb_test',
		'prefix' => '',
		'encoding' => 'utf8',
	);
}
