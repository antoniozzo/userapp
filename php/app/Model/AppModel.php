<?php

/**
 * Base application model
 *
 * @author Antonio Rizzo <info@antoniorizzo.com>
 */

App::uses('Model', 'Model');

class AppModel extends Model {

	// I want every model to act as containable
	public $actsAs = array('Containable');

}