<?php

App::uses('AppController', 'Controller');

/**
 * Orders Controller
 *
 * @property Order $Order
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OrdersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array(
                'api_order', 
                'payu',
                "successipn",
                "failureipn",
                "payment_success",
                "payment_failure"
            ));
    }

    public function api_order($id = null) {
        $this->Order->recursive = 2;
        $orderRecords = $this->Order->find('all', array(
            'contain' => array(
                'Combination' => array(
                    'Vendor',
                    'Review.customer_id = ' . $id,
                    'Review'
                ),
                'Address',
                'Feedback'
            ),
            'order' => array('Order.id DESC'),
            'conditions' => array(
                "Order.customer_id" => $id,
            )
        ));

        foreach ($orderRecords as &$orderRecord) {
            $va = array();
            if (isset($orderRecord['Combination']['Review'])) {
                foreach ($orderRecord['Combination']['Review'] as $k => $rv) {
                    if ($orderRecord['Order']['id'] != $rv['order_id']) {
                        
                    } else {
                        $va[] = $orderRecord['Combination']['Review'][$k];
                    }
                }
            }
            $orderRecord['Combination']['Review'] = $va;
        }
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->body(json_encode(array("data" => $orderRecords), JSON_PRETTY_PRINT));
        file_put_contents("files/d.txt", json_encode(array("data" => $orderRecords), JSON_PRETTY_PRINT));
//        $this->set(array(
//            'data' => $orderRecords,
//            '_serialize' => array('data')
//        ));
    }

    public function api_add() {
        if ($this->request->is('post')) {
            $this->Order->create();
            if ($this->Order->save($this->request->data)) {
                $x = $this->Order->find("all", array(
                    "conditions" => array(
                        "Order.id" => $this->Order->getLastInsertID(),
                        //"Order.sku" => "I5KP9X7Q"
                    ),
                    "contain" => array("Address", "Combination", "Combination.Vendor")
                ));
                App::uses("CakeEmail", "Network/Email");
                $fm = new CakeEmail('smtp');
                $viewVars = array(
                    'id_o' => $x[0]['Order']['sku'],
                    'name' => $x[0]['Address']['f_name'] . " " . $x[0]['Address']['l_name'],
                    'mob' => $x[0]['Address']['phone_number'],
                    'address' => $x[0]['Address']['address'],
                    'orders' => $x
                );
                $fm->to("pickmeals@gmail.com")
                        //->cc("himan.verma@live.com")
                        ->viewVars($viewVars)
                        ->from("no-reply@pickmeals.com", "PickMeals.com")
                        ->replyTo("support@pickmeals.com", "PickMeals.com")
                        ->subject("New Order on PickMeals.com (ID :" . $x[0]['Order']['sku'] . ")")
                        ->template("referal")
                        ->emailFormat('html');
                try {
                    $mailObj = $fm->send();
                } catch (SocketException $e) {
                    debug($e);
                }
                //CakeLog::debug(print_r($x,true));
                
                // Code to Deduct money from wallet
                $this->loadModel("Customer");
                $cst = $this->Customer->find("first",array(
                    "conditions" => array(
                        "Customer.id" => $x[0]['Order']['customer_id']
                    ),
                    "contain" => false
                ));
                //CakeLog::debug(print_r($cst,true));
                if($cst['Customer']['cash_by_promo'] > 0){
                    if($cst['Customer']['cash_by_promo'] - $x[0]['Order']['price'] <= 0){
                        $cashAm = 0;
                    }else{
                        $cashAm = $cst['Customer']['cash_by_promo'] - $x[0]['Order']['price'];
                    }
                    $v = $this->Customer->updateAll(array(
                        "Customer.cash_by_promo" => "'".$cashAm."'"
                    ),array(
                        "Customer.id" => $cst['Customer']['id']
                    ));
                    //CakeLog::debug(print_r($v,true));
                    //CakeLog::debug(print_r($cst,true));
                }
                
                
//                $promo = new PromoController();
//                $promo->sendCashToReferal($x[0]['Order']['customer_id']);
                
                $this->set(array(
                    'data' => array(
                        'error' => 0,
                        'msg' => 'Success',
                        'url' => FULL_BASE_URL . $this->webroot . 'orders/payu/' . $this->Order->getLastInsertID()
                    ),
                    '_serialize' => array('data')
                ));
            } else {
                $this->set(array(
                    'data' => array(
                        "error" => 1,
                        "msg" => "Error Occured...",
                        "trace" => $this->Order->validationErrors
                    ),
                    '_serialize' => array('data')
                ));
            }
        }
    }

    public function payuweb($id = null) {
        if ($id == null) {
            throw new NotFoundException("Page Not Found");
        }
        $d = explode("U", $id);
        $this->layout = "ajax";
        $options = array('conditions' => array('Order.' . $this->Order->primaryKey => $d[0]));
        $odr = $this->Order->find('first', $options);
        $this->Order->updateAll(array(
            "Order.txn_data" => "'".  json_encode(array("data" => $this->request->data, "query" => $this->request->query))."'",
            //"Order.txnid" => "'".@$this->request->data['txnid']."'"
        ),array(
            "Order.id" => $d[0]
        ));
        $this->set('order', $odr);
        $this->set('total', $d[1]);
        $this->set('tm', $d[2]);
    }

    public function api_makeorder() {
        if ($this->request->is('post')) {
            $d = $this->request->data;

            $sum = 0;
            $tm = null;
            foreach ($d as $v) {
                $sum += $v['Order']['price'] * $v['Order']['qty'];
                $tm = $v['Order']['timestamp'];
            }

            if ($this->Order->saveAll($d, array('atomic' => true))) {
                $x = $this->Order->find("all", array(
                    "conditions" => array(
                        //"Order.id" => $this->Order->getLastInsertID(),
                        "Order.sku" => $d[0]['Order']['sku']
                    ),
                    "contain" => array("Address", "Combination", "Combination.Vendor")
                ));
                App::uses("CakeEmail", "Network/Email");
                $fm = new CakeEmail('smtp');
                $viewVars = array(
                    'id_o' => $x[0]['Order']['sku'],
                    'name' => $x[0]['Address']['f_name'] . " " . $x[0]['Address']['l_name'],
                    'mob' => $x[0]['Address']['phone_number'],
                    'address' => $x[0]['Address']['address'],
                    'orders' => $x
                );
                $fm->to("pickmeals@gmail.com")
                        ->cc("himan.verma@live.com")
                        ->viewVars($viewVars)
                        ->from("no-reply@pickmeals.com", "PickMeals.com")
                        ->replyTo("support@pickmeals.com", "PickMeals.com")
                        ->subject("New Order on PickMeals.com (ID :" . $x[0]['Order']['sku'] . ")")
                        ->template("referal")
                        ->emailFormat('html');
                try {
                    $x = $fm->send();
                } catch (SocketException $e) {
                    debug($e);
                }
                
//                $promo = new PromoController();
//                $promo->sendCashToReferal($x[0]['Order']['customer_id']);
                
                
                $this->set($x = array(
                    'data' => array(
                        'error' => 0,
                        'msg' => 'Success',
                        'url' => FULL_BASE_URL . $this->webroot . 'orders/payuweb/' . $this->Order->getLastInsertID() . "U" . $sum . "U" . $tm
                    ),
                    '_serialize' => array('data')
                ));
            } else {
                $this->set($x = array(
                    'data' => array(
                        "error" => 1,
                        "msg" => "Error Occured...",
                        "trace" => $this->Order->validationErrors
                    ),
                    '_serialize' => array('data')
                ));
            }
            Debugger::log($x);
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Order->recursive = 0;
        $this->Paginator->settings['limit'] = 8;
        $this->Paginator->settings['group'] = "Order.sku";
        $this->Paginator->settings['order'] = "Order.timestamp DESC";
        $x = $this->Paginator->paginate();
        $this->set('orders',$x );
    }
    
    public function smsdeliver(){
        if($this->request->is('post')){
            $this->autoRender = false;
            $res = array(
                "error" => 0,
                "msg" => $this->sendSms($this->request->data['num'], $this->request->data['msg'])
            );
            $this->response->type('json');
            $this->response->body(json_encode($res));
        }
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        $options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
        $this->set('order', $this->Order->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Order->create();
            if ($this->Order->save($this->request->data)) {
                $this->Session->setFlash(__('The order has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The order could not be saved. Please, try again.'));
            }
        }
        $vendorDays = $this->Order->VendorDay->find('list');
        $customers = $this->Order->Customer->find('list');
        $this->set(compact('vendorDays', 'customers'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Order->save($this->request->data)) {
                $this->Session->setFlash(__('The order has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The order could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
            $this->request->data = $this->Order->find('first', $options);
        }
        $vendorDays = $this->Order->VendorDay->find('list');
        $customers = $this->Order->Customer->find('list');
        $this->set(compact('vendorDays', 'customers'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Order->id = $id;
        if (!$this->Order->exists()) {
            throw new NotFoundException(__('Invalid order'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Order->delete()) {
            $this->Session->setFlash(__('The order has been deleted.'));
        } else {
            $this->Session->setFlash(__('The order could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    /**
     * changepaymentstatus method
     * 
     * This change the status of Payment from Admin Panel
     * @return void Description
     */
    public function changepaymentstatus($token = null){
        $tmp = explode(",", $token);
        $cId = $tmp[1];
        $oId = $tmp[0];
        $this->request->allowMethod('post', 'delete');
        $order = $this->Order->find("first", array(
           "conditions" => array(
               "Order.id" => $oId 
           )
        ));
        if($order['Order']['payment_status'] == "PENDING"){
            $this->Order->updateAll(array(
                "Order.payment_status" => "'PAID'"
            ),array(
                "Order.sku" => $order['Order']['sku']
            ));
            
            App::uses("PromoController", "Controller");
            $promo = new PromoController();
            $promo->sendCashToReferal($order['Order']['customer_id']);
        }else{
            $this->Order->updateAll(array(
                "Order.payment_status" => "'PENDING'"
            ),array(
                "Order.sku" => $order['Order']['sku']
            ));
        }
        return $this->redirect(array('action' => 'index'));
        
    }

    
    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Order->recursive = 0;
        $this->set('orders', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        $options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
        $this->set('order', $this->Order->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Order->create();
            if ($this->Order->save($this->request->data)) {
                $this->Session->setFlash(__('The order has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The order could not be saved. Please, try again.'));
            }
        }
        $vendorDays = $this->Order->VendorDay->find('list');
        $customers = $this->Order->Customer->find('list');
        $this->set(compact('vendorDays', 'customers'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {
        if (!$this->Order->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Order->save($this->request->data)) {
                $this->Session->setFlash(__('The order has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The order could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
            $this->request->data = $this->Order->find('first', $options);
        }
        $vendorDays = $this->Order->VendorDay->find('list');
        $customers = $this->Order->Customer->find('list');
        $this->set(compact('vendorDays', 'customers'));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->Order->id = $id;
        if (!$this->Order->exists()) {
            throw new NotFoundException(__('Invalid order'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Order->delete()) {
            $this->Session->setFlash(__('The order has been deleted.'));
        } else {
            $this->Session->setFlash(__('The order could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function payu($id = NULL) {
        $this->layout = "ajax";
        $options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
        $this->set('order', $this->Order->find('first', $options));
    }

    public function payment_success($orderId = null) {
        configure::write('debug',0);
        $this->layout = "webapp_inner";
        $this->set("oid",$orderId);
        if($orderId != NULL){
            $this->Order->updateAll(array(
                'Order.status' => "'PLACED'",
                'Order.payment_status' => "'PAID'"
            ),array(
                'Order.sku' => $orderId
            ));
        }
        $orders = $this->Order->find("all",array(
            "conditions"=>array(
                "Order.sku" => $orderId
            ),
            "contain" => array(
                "Combination.Vendor",
                "Customer",
                "Address"
            )
        ));
        $mobile_num = explode("-", $orders[0]['Address']['phone_number']);
        if(count($mobile_num)>1){
            $mobile_num = $mobile_num[1];
        }else{
            $mobile_num = ltrim($mobile_num[0],"0");
        }
        $this->sendSms($mobile_num, "Dear ".$orders[0]['Address']['f_name']." ".$orders[0]['Address']['l_name']." thanks for placing Order ID:".$orderId.". Your order will be delivered within 45 minutes.");
        $this->set("orders",$orders);
    }

    public function payment_failure($orderId = null) {
        configure::write('debug',0);
        $this->layout = "webapp_inner";
        $this->set("oid",$orderId);
        if($orderId != NULL){
            $this->Order->updateAll(array(
                'Order.status' => "'CANCELED'",
                'Order.payment_status' => "'FAILED'"
            ),array(
                'Order.sku' => $orderId
            ));
        }
        $orders = $this->Order->find("all",array(
            "conditions"=>array(
                "Order.sku" => $orderId
            )
        ));
        $this->set("orders",$orders);
    }
    
    
    // Payumoney WebHooks 
    public function successipn($data){
        ob_start();
        print_r($_POST); // Post Data 
        print_r($_GET);
        
        print_r($data);
        print_r($this->request->data);
        print_r($this->request->query);
        $txt = ob_get_clean();
        $old = file_get_contents("s.txt");
        file_put_contents("s.txt", $txt."\n=====\n".$old);
        $this->autoRender = false;
        $this->response->body($txt);
        
    }
    public function failureipn($data){
        ob_start();
        print_r($_POST);
        print_r($_GET);
        print_r($data);
        print_r($this->request->data);
        print_r($this->request->query);
        $txt = ob_get_clean();
        $old = file_get_contents("f.txt");
        file_put_contents("f.txt", $txt."\n=====\n".$old);
        $this->autoRender = false;
        $this->response->body($txt);
    }

}
