<?php
App::uses('AppModel', 'Model');
/**
 * AppVersion Model
 *
 */
class AppVersion extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'version' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
