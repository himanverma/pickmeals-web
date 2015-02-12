<?php
App::uses('AppModel', 'Model');
/**
 * Combination Model
 *
 * @property Vendor $Vendor
 * @property CombinationItem $CombinationItem
 * @property Order $Order
 * @property Review $Review
 */
class Combination extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'display_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'vendor_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'display_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'day' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'reviewkey' => array(
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Vendor' => array(
			'className' => 'Vendor',
			'foreignKey' => 'vendor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CombinationItem' => array(
			'className' => 'CombinationItem',
			'foreignKey' => 'combination_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'combination_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Review' => array(
			'className' => 'Review',
			'joinTable' => 'combinations_reviews',
			'foreignKey' => 'combination_id',
			'associationForeignKey' => 'review_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);
        
         public function beforeSave($options = array()) {
            parent::beforeSave($options);
            $this->data[$this->alias]['date'] = date('Y-m-d h:i:s');
            
            if(isset($this->data[$this->alias]['vendor_id']) && isset($this->data[$this->alias]['display_name'])){
                $this->data[$this->alias]['reviewkey'] = $this->data[$this->alias]['vendor_id'] ."_".$this->data[$this->alias]['display_name'];
            }
            
            if(isset($this->data[$this->alias]['vendor_cost']) && $this->data[$this->alias]['vendor_cost'] > 10){
                $this->data[$this->alias]['price'] = $this->data[$this->alias]['vendor_cost'] + ($this->data[$this->alias]['vendor_cost'] * 20/100);
                $this->data[$this->alias]['price'] = $this->roundUpToAny($this->data[$this->alias]['price']);
            }
        }
        
        
        private function roundUpToAny($n,$x=5) {
            return (round($n)%$x === 0) ? round($n) : round(($n+$x/2)/$x)*$x;
        }
        
        
        public function deleteAll($conditions, $cascade = true, $callbacks = false) {
            $x = $this->find("all",array(
                "contain" => false,
                "fields" => array('image'),
                "conditions" => $conditions
            ));
            foreach($x as $v){
                $pth = ltrim($v[$this->alias]['image'], "https://www.pickmeals.com/");
                unlink(str_replace("-0-", "-1-", $pth));
                unlink(str_replace("-0-", "-2-", $pth));
                unlink($pth);
            }
            parent::deleteAll($conditions, $cascade, $callbacks);
        }
        
}
