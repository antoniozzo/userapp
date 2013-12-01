<?php

App::uses('User', 'Model');

class UserTest extends CakeTestCase {

	public $fixtures = array('app.user', 'app.login');
	
	/**
	 * setup tests
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

	/**
	 * tear down tests
	 *
	 * @return void
	 */
	public function tearDown()
	{
		unset($this->User);
		parent::tearDown();
	}

	// should save a user with email and password
	public function testSave()
	{
		// create a new user
		$this->User->create();
		$user = $this->User->save(array('email' => 'info@antoniorizzo.com', 'password' => 'test', 'password_confirm' => 'test'));
		$this->assertInternalType('array', $user);
	}

	// emails must be unique
	public function testEmailShouldBeUnique()
	{
		// create a new user with existing email
		$this->User->create();
		$user = $this->User->save(array('email' => 'harry@potter', 'password' => 'voldemort', 'password_confirm' => 'voldemort'));
		$this->assertFalse($user);
	}

	// test that password matches password_confirm
	public function testPasswordConfirmation()
	{
		// create a new user with wrong password_confirm
		$this->User->create();
		$user = $this->User->save(array('email' => 'info@antoniorizzo.com', 'password' => 'pass', 'password_confirm' => 'nothing'));
		$this->assertFalse($user);

		// create a new user with correct password_confirm
		$this->User->create();
		$user = $this->User->save(array('email' => 'info@antoniorizzo.com', 'password' => 'pass', 'password_confirm' => 'pass'));
		$this->assertInternalType('array', $user);
	}

}