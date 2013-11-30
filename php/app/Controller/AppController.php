<?php

/**
 * Base application controller
 *
 * @author Antonio Rizzo <info@antoniorizzo.com>
 */

App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $components = array(
		'Session',
		'RequestHandler',
		'Auth' => array(
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email')
				)
			),
            // 'authorize' => array('Controller')
		)
	);

	/**
	 * beforeFilter method
	 *
	 * @return void
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();

		$this->set('current_user', $this->Auth->user());
	}
}