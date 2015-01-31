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
            if($this->request->is('post')){
                if(AuthComponent::user('mobile_number') == null || AuthComponent::user('mobile_number') == ""){
                    $this->loadModel('Customer');
                    $this->Customer->updateAll(array(
                        "Customer.mobile_number" => "'".$this->request->data['Address']['phone_number']."'",
                    ), array(
                        "Customer.id" => AuthComponent::user('id')
                    ));
                }
                if(AuthComponent::user('city') == null || AuthComponent::user('city') == ""){
                    $this->loadModel('Customer');
                    $this->Customer->updateAll(array(
                        "Customer.city" => "'".$this->request->data['Address']['city']."'",
                    ), array(
                        "Customer.id" => AuthComponent::user('id')
                    ));
                }
                if(AuthComponent::user('pin_code') == null || AuthComponent::user('pin_code') == ""){
                    $this->loadModel('Customer');
                    $this->Customer->updateAll(array(
                        "Customer.pin_code" => "'".$this->request->data['Address']['zipcode']."'",
                    ), array(
                        "Customer.id" => AuthComponent::user('id')
                    ));
                }
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
