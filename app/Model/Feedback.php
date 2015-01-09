<?php
App::uses('AppModel', 'Model');
/**
 * Feedback Model
 */
class Feedback extends AppModel {
    
    var $useTable = "feedbacks";

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public function afterFind($results, $primary = false) {
            Configure::write('debug', 0);
            App::uses("CakeTime", "Utility");
            $gc = new CakeTime();
            parent::afterFind($results, $primary);
            foreach ($results as $key => $val) {
                if (isset($val['Feedback']['id'])) {
                    $results[$key]['Feedback']['created'] = $gc->timeAgoInWords($results[$key]['Feedback']['created']);
                }
            }
            return $results;
        }
}
