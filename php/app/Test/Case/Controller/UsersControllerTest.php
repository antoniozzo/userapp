<?php

App::uses('UsersController', 'Controller');

class UsersControllerTest extends ControllerTestCase {

	public $fixtures = array('app.user', 'app.login');

	/**
	 * setup tests
	 *
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();

		// mocking the UsersController with a User model and Auth component
		$this->Users = $this->generate('Users', array(
			'models' => array(
				'User' => array('save', 'find', 'exists'),
				'Login' => array('save', 'find')
			),
			'components' => array(
				'Session',
				'Auth' => array('user', 'login', 'loggedIn')
			)
		));
	}

	/**
	 * Basic routing tests:
	 */

	// get: users/view/1 should return a user
	public function testView() {
		$this->Users->User->expects($this->once())->method('find')->will($this->returnValue(true));
		$response = $this->testAction('users/view/1', array('method' => 'get'));
		$this->assertArrayHasKey('user', $this->vars);
	}

	// post: users/login should redirect to users/view
	public function testLogin() {
		$this->Users->Auth->expects($this->once())->method('login')->will($this->returnValue(true));
		$this->Users->Auth->expects($this->any())->method('loggedIn')->will($this->returnValue(false));
		$this->Users->Auth->staticExpects($this->any())->method('user')->will($this->returnValue(1));
		$response = $this->testAction('users/login', array('method' => 'post'));
		$this->assertStringEndsWith('users/view', $this->headers['Location']);
	}

	// get: users/logout should redirect to front
	public function testLogout() {
		$response = $this->testAction('users/logout', array('method' => 'get'));
		$this->assertStringEndsWith('Console/', $this->headers['Location']);
	}

	// post: users/register should redirect to front
	public function testRegister() {
		$this->Users->User->expects($this->once())->method('save')->will($this->returnValue(true));
		$response = $this->testAction('users/register', array('method' => 'post'));
		$this->assertStringEndsWith('Console/', $this->headers['Location']);
	}

	// post: users/edit should redirect to users/view
	public function testEdit() {
		$this->Users->User->expects($this->once())->method('save')->will($this->returnValue(true));
		$response = $this->testAction('users/edit', array('method' => 'post'));
		$this->assertStringEndsWith('users/view', $this->headers['Location']);
	}

	/**
	 * Specific routing tests:
	 */

	// users/login should call save on Login model
	public function testLoginShouldSaveLastLogin() {
		$this->Users->Auth->expects($this->once())->method('login')->will($this->returnValue(true));
		$this->Users->Auth->expects($this->any())->method('loggedIn')->will($this->returnValue(false));
		$this->Users->Auth->staticExpects($this->any())->method('user')->will($this->returnValue(1));
		$this->Users->Login->expects($this->once())->method('save')->with(array('user_id' => 1))->will($this->returnValue(true));
		$response = $this->testAction('users/login', array('method' => 'post'));
		$this->assertStringEndsWith('users/view', $this->headers['Location']);
	}

}