<?php
App::uses('AppController', 'Controller');

/**
 * Customers Controller
 *
 * @property Customer $Customer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CustomersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('api_index', 'api_add', 'add1','api_edit','login'));
    }
    
    public function login(){
        if($this->request->is(array('post'))){
            if($this->Auth->login()){
                debug($this->Auth->user());
                exit;
            }else{
                debug($this->request->data);
                exit;
            }
        }
    } 

    public function api_index() {
        $customers = $this->Customer->find('all');
        $this->set(array(
            'data' => $customers,
            '_serialize' => array('data')
        ));
    }
    
    
    public function api_view($id = null) {
        $this->Customer->recursive=2;
        $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
        $this->set(array(
            'data' => $this->Customer->find('first', $options),
            '_serialize' => array('data')
        ));
    }
    public function api_verify(){
        if($this->request->is(array('post'))){
            $res = array();
            if(isset($this->request->data['Customer']['mobile_number'])){
                $this->sendSms($this->request->data['Customer']['mobile_number'], "Your pickmeals.com password is ".$this->request->data['Customer']['v_code']);
                $res['error'] = 0;
                $res['msg'] = "Verification Code has been sent to ".$this->request->data['Customer']['mobile_number']." number.";
            }else{
                $res['error'] = 1;
                $res['msg'] = "Unable to send verifaction code.";
            }
            $this->set(array(
                'data' => $res,
                '_serialize' => array('data')
            ));
        }else{
            exit;
        }
    }

    public function api_add() {
        Configure::write('debug', 0);
//        if ($this->request->is('post')) {
//        $this->request->data['Customer']['image'] = "https://graph.facebook.com/1592823174279742/picture?type=small";
//        $this->request->data['Customer']['fbid'] = "1592823174279742";
//        $this->request->data['Customer']['deviceId'] = "9f56f4f95f72c6da";
//        $this->request->data['Customer']['name'] = "Harry James";
//        $this->request->data['Customer']['email'] = "15928231742791742@facebook.com";
        ob_start();
        var_dump($this->request->data);
        $c = ob_get_clean();
        $fc = fopen('files' . DS . 'detail.txt', 'w');
        fwrite($fc, $c);
        fclose($fc);
        
        if (isset($this->request->data['Customer']['mobile_number'])) {
            $customerRcord = $this->Customer->find('first', array(
                'conditions' => array(
                    "Customer.mobile_number" => $this->request->data['Customer']['mobile_number'],
                )
            ));
        }
        if (isset($this->request->data['Customer']['fbid'])) {
            $customerRcord = $this->Customer->find('first', array(
                'conditions' => array(
                    "Customer.fbid" => $this->request->data['Customer']['fbid'],
                )
            ));
            
        }
       
//        debug($customerRcord);exit;
        if (!empty($customerRcord)) {
            if (isset($this->request->data['Customer']['fbid'])) {
                $this->Customer->updateAll(array(
                    'Customer.deviceId' => "'" . $this->request->data['Customer']['deviceId'] . "'",
                        ), array(
                    'Customer.id' => $customerRcord['Customer']['id']
                ));
            }else{
                $this->Customer->updateAll(array(
                    'Customer.deviceId' => "'" . $this->request->data['Customer']['deviceId'] . "'",
                    'Customer.password' => "'" . AuthComponent::password($this->request->data['Customer']['v_code']) . "'",
                    'Customer.v_code' => "'" . $this->request->data['Customer']['v_code'] . "'"
                        ), array(
                    'Customer.id' => $customerRcord['Customer']['id']
                ));
            }
            $insertUserInfo = $this->Customer->find('first', array(
                'recusive' => -1,
                'conditions' => array('Customer.id' => $customerRcord['Customer']['id'])
            ));
            $this->set(array(
                'data' => array(
                    "error" => 0,
                    "record" => $insertUserInfo
                ),
                '_serialize' => array('data')
            ));
        } else {
            $this->request->data['Customer']["registered_on"] = time();
            if ($this->Customer->save($this->request->data)) {
                /* send this v_code to mail and sms for verification */
                App::uses("AuthComponent", "Controller/Component");
                $this->Customer->updateAll(array(
                    'Customer.password' => "'" . AuthComponent::password($this->request->data['Customer']['v_code']) . "'"
                        ), array(
                    "Customer.id" => $this->Customer->getLastInsertID()
                ));
                $insertUserInfo = $this->Customer->find('first', array(
                    'recusive' => -1,
                    'conditions' => array('Customer.id' => $this->Customer->getLastInsertID())
                ));
                $this->set(array(
                    'data' => array(
                        "error" => 0,
                        "record" => $insertUserInfo
                    ),
                    '_serialize' => array('data')
                ));
                $this->generatePromo($this->Customer->getLastInsertID());
                
            } else {
                $this->set(array(
                    'data' => array("error" => 1, "msg" => $this->Customer->validationErrors),
                    '_serialize' => array('data')
                ));
            }
        }
    }
    
    
    public function api_edit($id = null) {
        Configure::write('debug',0);
//        debug($id);exit;
        $this->Customer->id=$id;
        if ($this->request->is('post')) {
            if ($this->Customer->save($this->request->data)) {
                $info = $this->Customer->find('first',array(
                    'recursive'=>-1,
                    'conditions'=>array(
                        'Customer.id'=>$id
                    )));
                $this->set(array(
                    'data' => array("error" => 0, "list" => $info),
                    '_serialize' => array('data')
                ));
            } else {
                $this->set(array(
                    'data' => array("error" => 1, "msg" => 'something went wrong please try again!!!'),
                    '_serialize' => array('data')
                ));
            }
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Customer->recursive = 0;
        $this->set('customers', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Customer->exists($id)) {
            throw new NotFoundException(__('Invalid customer'));
        }
        $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
        $this->set('customer', $this->Customer->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Customer->create();
            $this->request->data['Customer']['registered_on'] = time();
            if ($this->Customer->save($this->request->data)) {
                $this->Session->setFlash(__('The customer has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Customer->exists($id)) {
            throw new NotFoundException(__('Invalid customer'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Customer->save($this->request->data)) {
                $this->Session->setFlash(__('The customer has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
            $this->request->data = $this->Customer->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Customer->id = $id;
        if (!$this->Customer->exists()) {
            throw new NotFoundException(__('Invalid customer'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Customer->delete()) {
            $this->Session->setFlash(__('The customer has been deleted.'));
        } else {
            $this->Session->setFlash(__('The customer could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Customer->recursive = 0;
        $this->set('customers', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->Customer->exists($id)) {
            throw new NotFoundException(__('Invalid customer'));
        }
        $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
        $this->set('customer', $this->Customer->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Customer->create();
            if ($this->Customer->save($this->request->data)) {
                $this->Session->setFlash(__('The customer has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->Customer->exists($id)) {
            throw new NotFoundException(__('Invalid customer'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Customer->save($this->request->data)) {
                $this->Session->setFlash(__('The customer has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The customer could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
            $this->request->data = $this->Customer->find('first', $options);
        }
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Customer->id = $id;
        if (!$this->Customer->exists()) {
            throw new NotFoundException(__('Invalid customer'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Customer->delete()) {
            $this->Session->setFlash(__('The customer has been deleted.'));
        } else {
            $this->Session->setFlash(__('The customer could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
