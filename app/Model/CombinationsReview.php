<?php
App::uses('AppModel', 'Model');
/**
 * CombinationsReview Model
 *
 * @property Combination $Combination
 * @property Review $Review
 */
class CombinationsReview extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'combination_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'review_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Combination' => array(
			'className' => 'Combination',
			'foreignKey' => 'combination_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Review' => array(
			'className' => 'Review',
			'foreignKey' => 'review_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
