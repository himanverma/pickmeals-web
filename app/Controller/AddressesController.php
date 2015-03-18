<?php
App::uses('AppController', 'Controller');
/**
 * Addresses Controller
 *
 * @property Customer $Customer
 * @property Address $Address
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AddressesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler','Paginator', 'Session');
        
        public function beforeFilter() {
            parent::beforeFilter();
            
            //$this->Auth->allow(array('api_add'));
        }
        
        
        public function api_add(){
            Configure::write('debug', 2);
            if($this->request->is('post')){
                $this->loadModel('Customer');
                $cst = $this->Customer->find("first", array(
                    "Customer.id" => $this->request->data['Address']['customer_id']
                ));
                
                if(isset($cst['Customer']['email'])){
                    $this->loadModel('Customer');
                    $this->Customer->updateAll(array(
                        "Customer.email" => "'".$this->request->data['Address']['email']."'",
                    ), array(
                        "Customer.id" => $this->request->data['Address']['customer_id']
                    ));
                }
                if($cst['Customer']['mobile_number'] == null || $cst['Customer']['mobile_number'] == ""){
                    $this->loadModel('Customer');
                    $this->Customer->updateAll(array(
                        "Customer.mobile_number" => "'".$this->request->data['Address']['phone_number']."'",
                    ), array(
                        "Customer.id" => $this->request->data['Address']['customer_id']
                    ));
                }
                if($cst['Customer']['city'] == null || $cst['Customer']['city'] == ""){
                    $this->loadModel('Customer');
                    $this->Customer->updateAll(array(
                        "Customer.city" => "'".$this->request->data['Address']['city']."'",
                    ), array(
                        "Customer.id" => $this->request->data['Address']['customer_id']
                    ));
                }
                if($cst['Customer']['pin_code'] == null || $cst['Customer']['pin_code'] == ""){
                    $this->loadModel('Customer');
                    $this->Customer->updateAll(array(
                        "Customer.pin_code" => "'".$this->request->data['Address']['zipcode']."'",
                    ), array(
                        "Customer.id" => $this->request->data['Address']['customer_id']
                    ));
                }
                
                if($cst['Customer']['address'] == null || $cst['Customer']['address'] == ""){
                    $this->loadModel('Customer');
                    $this->Customer->updateAll(array(
                        "Customer.address" => "'".$this->request->data['Address']['address']."'",
                    ), array(
                        "Customer.id" => $this->request->data['Address']['customer_id']
                    ));
                }
                
//                if($cst['Customer']['name'] == null || $cst['Customer']['name'] == ""){
                    $this->loadModel('Customer');
                    $this->Customer->updateAll(array(
                        "Customer.name" => "'".$this->request->data['Address']['f_name']." ".$this->request->data['Address']['l_name']."'",
                    ), array(
                        "Customer.id" => $this->request->data['Address']['customer_id']
                    ));
                    if($cst['Customer']['my_promo_code'] == null || $cst['Customer']['my_promo_code'] == ""){
                        $this->generatePromo($this->request->data['Address']['customer_id']);
                    }
//                }
                
                if($this->Address->save($this->request->data)){
                    $this->set(array(
                        'data' => array(
                            'msg'=>'success',
                            'addressid'=>$this->Address->getLastInsertID()
                            ),
                        '_serialize' => array('data')
                    ));
                }else{
                    $this->set(array(
                        'data' => 'sorry',
                        '_serialize' => array('data')
                    ));
                }
            }
        }
}
