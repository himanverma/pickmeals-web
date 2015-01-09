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
                "failureipn"
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
//        $this->set(array(
//            'data' => $orderRecords,
//            '_serialize' => array('data')
//        ));
    }

    public function api_add() {
        if ($this->request->is('post')) {
            $this->Order->create();
            if ($this->Order->save($this->request->data)) {
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
                $this->set(array(
                    'data' => array(
                        'error' => 0,
                        'msg' => 'Success',
                        'url' => FULL_BASE_URL . $this->webroot . 'orders/payuweb/' . $this->Order->getLastInsertID() . "U" . $sum . "U" . $tm
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

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Order->recursive = 0;
        $this->set('orders', $this->Paginator->paginate());
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
            )
        ));
        $this->set("orders",$orders);
    }

    public function payment_failure($orderId = null) {
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
