<?php
/**
 * 
 * 
 * @property Customer $Customer Description
 * @property Address $Address Description
 */

App::uses("AppController", "Controller");

class DashboardController extends AppController {

    public $_since = "2015-2-19";
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('sdkfix','login','cordova','getNotRespondedOrders'));
    }
    
    public function sdkfix(){
        $this->layout = "sdk8fix";
    }

        public function login(){
        if($this->Auth->user()){
            $this->redirect("/Dashboard");
        }
        $this->layout = "login";
    }

    public function index() {
        
    }

    public function neworder() {
        $this->loadModel("Combination");
        $this->loadModel("Customer");
        $this->loadModel("Address");
        $this->loadModel("Order");
        
        if($this->request->is(array('post'))){
            $d = $this->request->data;
            
//            print_r($d);
//            exit;
            
            
            $customer = $this->Customer->find("first", array(
                "conditions" => array(
                    "Customer.id" => $d['Customer']['id']
                    )
                )
            );
            
            if(empty($customer)){
                $this->Customer->create();
                $d['Customer']['v_code'] = strtoupper($this->randomString(5));
                $d['Customer']['password'] = $d['Customer']['v_code'];
                $d['Customer']['is_admin'] = 0;
                $d['Customer']['registered_on'] = time();
                $d['Customer']['device_token'] = 'Added From Admin';
                $d['Customer']['verified'] = 'true';
                $d['Customer']['status'] = 'VERIFIED';
                $d['Customer']['cash_by_promo'] = 0;
                $d['Customer']['referal_paid'] = 0;
                $d['Customer']['address'] = $d['Address']['address'];
                
                $this->Customer->save(array(
                    "Customer" => $d['Customer']
                ));
                $this->generatePromo($cid = $this->Customer->getLastInsertID());
                $customer = $this->Customer->find("first", array(
                    "conditions" => array(
                        "Customer.id" => $cid
                        )
                    )
                );
            }
            
            $old_address = $this->Address->find("first",array(
                "conditions" => array(
                    'Address.customer_id' => $customer['Customer']['id']
                ),
                "order" => "Address.id DESC"
            ));
            
            
            $this->Address->create();
            $d['Address']['customer_id'] = $customer['Customer']['id'];
            $tmp = explode(" ", $customer['Customer']['name']);
            $d['Address']['f_name'] = isset($tmp[0]) ? $tmp[0] : '';
            $d['Address']['l_name'] = isset($tmp[1]) ? $tmp[1] : '';
            $d['Address']['email'] = $customer['Customer']['email'];
            $d['Address']['phone_number'] = $customer['Customer']['mobile_number'];
            $d['Address']['status'] = 1;
            if(!empty($old_address)){
                if(strlen($d['Address']['address']) < 4){
                    $d['Address']['address'] = $old_address['Address']['address'];
                }
            }
            $this->Address->save(array(
                "Address" => $d['Address']
            ));
            $aid = $this->Address->getLastInsertID();
            $s = rand(0,5);
            $sku = time();
            $sku = strtoupper(md5($sku));
            $sku = substr($sku, $s, 5);
            $sku = "P-".$sku;
            $eodrs = array();
            foreach($d['orders'] as $order){
                $odr = json_decode($order,true);
                $combination = $this->Combination->find("first",array(
                    "conditions" => array(
                        "Combination.id" => $odr['Order']['combination_id']
                    ),
                    "contain" => FALSE
                ));
                
                
                
                
                $odr['Order']['customer_id'] = $customer['Customer']['id'];
                $odr['Order']['address_id'] = $aid;
                $odr['Order']['recipe_names'] = $combination['Combination']['display_name'];
                $odr['Order']['price'] = $combination['Combination']['price'];
                $odr['Order']['essentials'] = 'chk_value';
                $odr['Order']['paid_via'] = 'Cash on Delivery';
                $odr['Order']['sku'] = $sku;
                $odr['Order']['status'] = 1;
                $odr['Order']['timestamp'] = time();
                
                $this->Order->create();
                $this->Order->save(array(
                    "Order" => $odr['Order']
                ));
                $eodrs[] = $this->Order->find("first",array(
                    "conditions" => array(
                        "Order.id" => $this->Order->getLastInsertID()
                    ),
                    "contain" => array("Address", "Combination", "Combination.Vendor")
                ));
            }
            
            $ttl = 0;
            foreach($eodrs as $rt){
                $ttl += $rt['Combination']['price'] * $rt['Order']['qty'];
                
                $ComboObj = new Combination();
                    $ComboObj->updateAll(array(   //-------- Update Stock
                        "Combination.stock_count" => "'".((int)$rt['Combination']['stock_count'] - (int)$rt['Order']['qty'])."'"
                    ), array(
                       "Combination.id" => $rt['Combination']['id'] 
                    ));
            }
            
            $cashToPay = $eodrs[0]['Combination']['price'];

            if ($customer['Customer']['cash_by_promo'] >= 0) {
                if ($customer['Customer']['cash_by_promo'] - $ttl <= 0) {
                    $cashAm = 0;
                    $cashToPay = abs($customer['Customer']['cash_by_promo'] - $ttl);
                } else {
                    $cashAm = $customer['Customer']['cash_by_promo'] - $ttl;
                    $cashToPay = 0;
                }
                $v = $this->Customer->updateAll(array(
                    "Customer.cash_by_promo" => "'" . $cashAm . "'"
                        ), array(
                    "Customer.id" => $customer['Customer']['id']
                ));

                $this->Order->updateAll(array(
                    "Order.discount_amount" => "'".$customer['Customer']['cash_by_promo']."'"
                ), array(
                    "Order.sku" => $eodrs[0]['Order']['sku']
                ));                    

//                    CakeLog::debug(print_r($cashToPay,true));
//                    CakeLog::debug(print_r($cst,true));
            }
            
            App::uses("CakeEmail", "Network/Email");
            $fm = new CakeEmail('smtp');
            $viewVars = array(
                'id_o' => $eodrs[0]['Order']['sku'],
                'name' => $eodrs[0]['Address']['f_name'] . " " . $eodrs[0]['Address']['l_name'],
                'mob' => $eodrs[0]['Address']['phone_number'],
                'address' => $eodrs[0]['Address']['address'],
                'orders' => $eodrs,
                'total' => $cashToPay
            );
            $fm->to("pickmeals@gmail.com")
                    //->cc("himan.verma@live.com")
                    ->viewVars($viewVars)
                    ->from("no-reply@pickmeals.com", "PickMeals.com")
                    ->replyTo("support@pickmeals.com", "PickMeals.com")
                    ->subject("New Order on PickMeals.com (ID :" . $eodrs[0]['Order']['sku'] . ")")
                    ->template("referal")
                    ->emailFormat('html');
            try {
                $x = $fm->send();
            } catch (SocketException $e) {
                debug($e);
            }
            $this->sendSms($customer['Customer']['mobile_number'], "Dear " . $customer['Customer']['name'] . ", Thanks for placing order. Your Order " . $eodrs[0]['Order']['recipe_names']." will be delivered within 45 minutes.");
            $this->autoRender = FALSE;
            $this->response->type('json');
            $this->response->body(json_encode(array(
                "error" => 0,
                "msg" => "Order Placed..."
            )));
            
        }
        
        
        
        $cnd = array(
            "Combination.type" => "MAIN",
            "Combination.visible" => 1,
            "DATE(Combination.date) >= " => $this->_since // date("Y-m-d"),
                //"get_distance_in_miles_between_geo_locations($lat,$long,Vendor.lat,Vendor.long) <=" => 3.73
        );
        $combinations = $this->Combination->find('all', array(
            "conditions" => $cnd,
            "fields" => array("get_distance_in_miles_between_geo_locations(0,0,Vendor.lat,Vendor.long) as distance", "Vendor.*", "Combination.*"),
            //"order" => 'distance ASC',
            "order" => 'Combination.id DESC',
            "limit"=>10
        ));
        $this->set("combinations",$combinations);
        $customers = $this->Customer->find("all",array(
            "conditions"=>array(
                "Customer.is_admin" => 0
            ),
            "contain" => false,
            "order" => "Customer.mobile_number DESC"
        ));
        $cs = array();
        foreach($customers as $c){
            $cs[$c['Customer']['id']] = $c['Customer']['mobile_number']." ".$c['Customer']['name'];
        }
//        print_r($cs); exit;
        $this->set("customers",$cs);
        
        
    }
    public function cordova(){
        
    }
    public function getNotRespondedOrders(){
        $this->loadModel('Order');
        $nOrders = $this->Order->find("all",array(
            "conditions" => array(
                "Order.responded" => 0
            ),
            "group" => "Order.sku",
            "order" => "Order.id"
        ));
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->body(json_encode(json_encode($nOrders)));
    }


    public function t(){
        
        print_r("P-".$d);
        exit;
    }

}
