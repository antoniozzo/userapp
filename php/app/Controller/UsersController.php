<?php

/**
 * User controller
 *
 * @author Antonio Rizzo <info@antoniorizzo.com>
 */

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $uses = array('User', 'Login');

	/**
	 * isAuthorized method
	 *
	 * @param array
	 * @return bool
	 */
	public function isAuthorized($user) 
	{
    	return parent::isAuthorized($user);
	}

	/**
	 * beforeFilter method
	 *
	 * @return void
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();

		// Allow users to login, logout and register
		$this->Auth->allow('login', 'logout', 'register');
	}

	/**
	 * view a specific user
	 *
	 * @param string $id
	 * @throws NotFoundException
	 * @return void
	 */
	public function view($id = null)
	{	
		$id = $id ?: $this->Auth->user('id');

		// fetch user by id
		$user = $this->User->find('first', array(
			'conditions' => array(
				'User.id' => $id
			),
			'contain' => array(
				'Login' => array(
					'limit' => 5,
					'order' => 'created DESC'
				)
			)
		));

		// throw exception a user is not found
		if (!$user) {
			throw new NotFoundException(__('User not found'));
		}

		// send the user to our view
		$this->set(compact('user'));

		$this->set('title_for_layout', $user['User']['full_name']);

		if ($user['User']['image']) {
			$this->set('image_for_layout', '/files/user/image/' . $user['User']['id'] . '/thumb_' . $user['User']['image']);
		}
	}

	/**
	 * edit method
	 *
	 * @return void
	 */
	public function edit($id = null)
	{
		if ($this->request->is('post')) {

			// inject logged in user id
			$this->request->data['User']['id'] = $this->Auth->user('id');
			
			// update user
			if ($this->User->save($this->request->data)) {

				// redirect to view on success
				return $this->redirect(array('controller' => 'users', 'action' => 'view'));

			} else {

				// error message on fail
				$this->Session->setFlash(__('You could not edit the information'));
			
			}
		}

		$this->set('title_for_layout', 'Settings');
		$this->set('icon_for_layout', 'edit-b');
	}

	/**
	 * user login method
	 *
	 * @return void
	 */
	public function login()
	{
		if ($this->Auth->loggedIn()) {

			// display a flash if the user is already logged in
			$this->Session->setFlash(__('You are logged in'));

		} else if ($this->request->is('post')) {

			if ($this->Auth->login()) {

				// fetch user id
				$user_id = $this->Auth->user('id');

				// Record current login timestamp
				$this->Login->create();
				$this->Login->save(array('user_id' => $user_id));

				// redirect to user profile
				return $this->redirect(array('action' => 'view'));

			} else {

				// display a failed login message
				$this->Session->setFlash(__('You could not login'));

			}

		}

		$this->set('title_for_layout', 'Login');
		$this->set('icon_for_layout', 'logout-b');
	}

	/**
	 * logout method
	 * 
	 * @return void
	 */
	public function logout()
	{
		$this->Session->destroy();		
		$this->redirect($this->Auth->logout());
	}

	/**
	 * register method
	 *
	 * @return void
	 */
	public function register()
	{
		if ($this->request->is('post')) {

			// prepare for new user
			$this->User->create();
			
			// save user with data
			if ($this->User->save($this->request->data)) {

				// redirect to login on success
				return $this->redirect(array('controller' => 'users', 'action' => 'login'));

			} else {

				// error message on fail
				$this->Session->setFlash(__('You could not register'));
			
			}
		}

		$this->set('title_for_layout', 'Register');
		$this->set('icon_for_layout', 'edit-b');
	}
}