<?php

App::uses('AppModel', 'Model');

/**
 * Vendor Model
 *
 * @property Combination $Combination
 * @property VendorDay $VendorDay
 * @property VendorDocument $VendorDocument
 * @property VendorReview $VendorReview
 */
class Vendor extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    public function afterFind($results, $primary = false) {
        parent::afterFind($results, $primary);
//        foreach ($results as $key => $value) {
//            if(!isset($results[0])){
//                if($key == "id"){
//                    $x = $this->query('SELECT SUM(VendorReview.ratings) / COUNT(VendorReview.ratings) as trate FROM vendor_reviews as VendorReview WHERE VendorReview.vendor_id='.$results['id']);
//                    $results['ratings'] = number_format($x[0][0]['trate'],2,".","");
//                }
//            }else{
//                $x = $this->query('SELECT SUM(VendorReview.ratings) / COUNT(VendorReview.ratings) as trate FROM vendor_reviews as VendorReview WHERE VendorReview.vendor_id='.$value['Vendor']['id']);
//                $results[$key]['Vendor']['ratings'] = number_format($x[0][0]['trate'],2,".","");
//            }
//        }
        return $results;
    }

    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

        //$this->virtualFields['rating'] = 'SELECT SUM(VendorReview.ratings) as trate FROM vendor_reviews as VendorReview';
    }

    /**
     * Validation rules
     *
     * @var array
     */
//    public $validate = array(
//        'name' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'photo' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'company_logo' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'company_name' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'address' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'city' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'state' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'country' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'email' => array(
//            'email' => array(
//                'rule' => array('email'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'password' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'mobile_number' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'phone_number' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'lat' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'long' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//        'status' => array(
//            'notEmpty' => array(
//                'rule' => array('notEmpty'),
//            //'message' => 'Your custom message here',
//            //'allowEmpty' => false,
//            //'required' => false,
//            //'last' => false, // Stop validation after this rule
//            //'on' => 'create', // Limit validation to 'create' or 'update' operations
//            ),
//        ),
//    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Combination' => array(
            'className' => 'Combination',
            'foreignKey' => 'vendor_id',
            'dependent' => true,
            'conditions' => array('Combination.status' => 'ACTIVE'),
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
//		'VendorDay' => array(
//			'className' => 'VendorDay',
//			'foreignKey' => 'vendor_id',
//			'dependent' => true,
//			'conditions' => '',
//			'fields' => '',
//			'order' => '',
//			'limit' => '',
//			'offset' => '',
//			'exclusive' => '',
//			'finderQuery' => '',
//			'counterQuery' => ''
//		),
        'VendorDocument' => array(
            'className' => 'VendorDocument',
            'foreignKey' => 'vendor_id',
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
//        'VendorReview' => array(
//            'className' => 'VendorReview',
//            'foreignKey' => 'vendor_id',
//            'dependent' => true,
//            'conditions' => '',
//            'fields' => '',
//            'order' => 'VendorReview.id DESC',
//            'limit' => '',
//            'offset' => '',
//            'exclusive' => '',
//            'finderQuery' => '',
//            'counterQuery' => ''
//        )
    );

    public function beforeSave($options = array()) {
        Configure::write('debug', 2);
        parent::beforeSave($options);
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['v_code'] = $this->data[$this->alias]['password'];
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }


        if (isset($this->data[$this->alias]['photo'])) {
            App::uses("HtmlHelper", "View/Helper");
            $html = new HtmlHelper(new View());
            if (isset($this->data[$this->alias]['photo']['name'])) {
                if (isset($this->data[$this->alias]['photo']['size'])) {

                    if (isset($this->data[$this->alias]['id'])) {
                        $fx = $this->find("first", array(
                            "contain" => false,
                            "conditions" => array(
                                "Vendor.id" => $this->data[$this->alias]['id']
                            )
                        ));
                        $fn = ltrim($fx[$this->alias]['photo'], "https://www.pickmeals.com/");
                        @unlink($fn);
                    }

                    $ext = pathinfo($this->data[$this->alias]['photo']['name'], PATHINFO_EXTENSION);
                    $image_name = date('YmdHis') . rand(1, 999) . "." . $ext;
                    $path = $this->data[$this->alias]['photo']['tmp_name'];
                    $this->data[$this->alias]['photo'] = $html->url("/files/vendor_photo/" . $image_name, true);
                    $destination = "files/vendor_photo/" . $image_name;
                    move_uploaded_file($path, $destination);
                    $im = new Imagick($destination);
                    $im->scaleimage(253, 0);
                    $im->writeimage($destination);
                    $im->destroy();
                }
            }
            if(isset($this->data[$this->alias]['company_logo'])) {
                if (isset($this->data[$this->alias]['company_logo']['name'])) {
                    if (isset($this->data[$this->alias]['company_logo']['size'])) {

                        if (isset($this->data[$this->alias]['id'])) {
                            $fx = $this->find("first", array(
                                "contain" => false,
                                "conditions" => array(
                                    "Vendor.id" => $this->data[$this->alias]['id']
                                )
                            ));
                            $fn = ltrim($fx[$this->alias]['company_logo'], "https://www.pickmeals.com/");
                            @unlink($fn);
                        }

                        $ext = pathinfo($this->data[$this->alias]['company_logo']['name'], PATHINFO_EXTENSION);
                        $image_name = date('YmdHis') . rand(1, 999) . "." . $ext;
                        $path = $this->data[$this->alias]['company_logo']['tmp_name'];
                        $this->data[$this->alias]['company_logo'] = $html->url("/files/company_logo/" . $image_name, true);
                        $destination = "files/company_logo/" . $image_name;
                        move_uploaded_file($path, $destination);
                        $im = new Imagick($destination);
                        $im->scaleimage(253, 0);
                        $im->writeimage($destination);
                        $im->destroy();
                    }
                }
            }
        }
        return TRUE;
    }

}
