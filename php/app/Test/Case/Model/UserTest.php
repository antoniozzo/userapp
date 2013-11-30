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
		$user = $this->User->save(array('email' => 'info@antoniorizzo.com', 'password' => 'test'));

		// assert that the user has been created
		$this->assertInternalType('array', $user);
	}

	// emails must be unique
	public function testEmailShouldBeUnique()
	{
		// create a new user
		$this->User->create();
		$user = $this->User->save(array('email' => 'harry@potter', 'password' => 'ilovelucious'));

		// assert false
		$this->assertFalse($user);
	}

}