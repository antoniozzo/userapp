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

	public function __construct() {
		if (getenv("OPENSHIFT_MYSQL_DB_HOST")) {
			$this->default['host']     = getenv("OPENSHIFT_MYSQL_DB_HOST");
			$this->default['port']     = getenv("OPENSHIFT_MYSQL_DB_PORT");
			$this->default['login']    = getenv("OPENSHIFT_MYSQL_DB_USERNAME");
			$this->default['password'] = getenv("OPENSHIFT_MYSQL_DB_PASSWORD");
			$this->default['database'] = getenv("OPENSHIFT_APP_NAME");
		}
	}
}
