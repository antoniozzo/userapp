<?php

App::uses('Login', 'Model');

class LoginTest extends CakeTestCase {

	public $fixtures = array('app.user', 'app.login');
	
	/**
	 * setup tests
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();
		$this->Login = ClassRegistry::init('Login');
	}

	/**
	 * tear down tests
	 *
	 * @return void
	 */
	public function tearDown()
	{
		unset($this->Login);
		parent::tearDown();
	}

	// should save a login with user_id
	public function testSave()
	{
		$this->Login->create();
		$login = $this->Login->save(array('user_id' => 1));
		$this->assertInternalType('array', $login);
	}

}