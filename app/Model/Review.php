<?php
App::uses('AppModel', 'Model');
/**
 * Review Model
 *
 * @property Customer $Customer
 * @property Vendor $Vendor
 * @property Combination $Combination
 */
class Review extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'review';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'customer_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'combination_reviewkey' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'review' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ratings' => array(
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
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Vendor' => array(
			'className' => 'Vendor',
			'foreignKey' => 'vendor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'Order' => array(
                            'className' => 'Order',
                            'foreignKey' => 'order_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
                    )
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Combination' => array(
			'className' => 'Combination',
			'joinTable' => 'combinations_reviews',
			'foreignKey' => 'review_id',
			'associationForeignKey' => 'combination_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);
        public function afterSave($created, $options = array()) {
            parent::afterSave($created, $options); 
            if(isset($this->data["Combination"]['Combination'][0])){
                $x = $this->Combination->find("first", array("conditions" => array("Combination.id" => $this->data["Combination"]['Combination'][0])));
                $x2 = $this->Combination->find("all", array("contain"=>false, "conditions" => array("Combination.reviewkey" => $x['Combination']['reviewkey']),"fields" => array("id")));
                foreach ($x2 as $v){
                    App::uses("CombinationsReview", "Model");
                    $a = new CombinationsReview();
                    $a->create();
                    if(!$a->hasAny(array("CombinationsReview.combination_id"=>$v['Combination']['id'],"CombinationsReview.review_id"=>$this->getLastInsertID()))){
                        $a->save(array(
                            "CombinationsReview" => array(
                                'combination_id' => $v['Combination']['id'],
                                'review_id' => $this->getLastInsertID()
                            )
                        ));
                    }
                }
            }elseif($this->data["Review"]['combination_reviewkey']){
                $x2 = $this->Combination->find("all", array("contain"=>false, "conditions" => array("Combination.reviewkey" => $this->data["Review"]['combination_reviewkey']),"fields" => array("id")));
                foreach ($x2 as $v){
                    App::uses("CombinationsReview", "Model");
                    $a = new CombinationsReview();
                    $a->create();
                    if(!$a->hasAny(array("CombinationsReview.combination_id"=>$v['Combination']['id'],"CombinationsReview.review_id"=>$this->getLastInsertID()))){
                        $a->save(array(
                            "CombinationsReview" => array(
                                'combination_id' => $v['Combination']['id'],
                                'review_id' => $this->getLastInsertID()
                            )
                        ));
                    }
                }
            }
        }
        
        public function afterFind($results, $primary = false) {
            Configure::write('debug', 0);
            App::uses("CakeTime", "Utility");
            $gc = new CakeTime();
            parent::afterFind($results, $primary);
            if(isset($results[0]['Review']['created'])){
                foreach ($results as $key => $val){
                    $results[$key]['Review']['created'] = $gc->timeAgoInWords($results[$key]['Review']['created']);
                }
            }
            return $results;
        }

}
