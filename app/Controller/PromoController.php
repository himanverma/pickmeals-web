<?php

App::uses("AppController", "Controller");

/**
 * Description of PromoController
 *
 * @author Himanshu Verma <himan.verma@live.com>
 * @property Customer $Customer Description
 */
class PromoController extends AppController {
    
    private $_promodiscount = 40;
    private $_referalBonus = 25;

    public function beforeFilter() {
        parent::beforeFilter();
        // $this->generatePromoAll();
    }

    /**
     *  Api to Display Customer's balance
     */
    public function api_payments() {
        //Configure::write('debug', 2);
        if (!$this->request->is(array('post'))) {
            throw new NotFoundException("Invalid Request Method");
        }
        $this->loadModel('Customer');
        $data = $this->Customer->find("first", array(
            "conditions" => array(
                "Customer.deviceId" => $this->request->data['Customer']['deviceId'],
                "Customer.id" => $this->request->data['Customer']['id']
            ),
            "contain" => false
        ));
        if (empty($data)) {
            $res = array(
                "error" => 1,
                "msg" => "No records found for this deviceId: " . $this->request->data['Customer']['deviceId'] . " and id: " . $this->request->data['Customer']['id']
            );
        } else {
            $res = array(
                "error" => 0,
                "msg" => $data['Customer']['cash_by_promo']
            );
        }
        $this->set(array(
            'data' => $res,
            '_serialize' => array('data')
        ));
    }

    /**
     * Api to Apply Referal Promo Code
     */
    public function api_applypromo() {
        if (!$this->request->is(array('post'))) {
            //throw new NotFoundException("Invalid Request Method");
        }
        $this->request->data['Customer']['code'] = strtoupper($this->request->data['Customer']['code']);
        $this->loadModel('Customer');
        $me = $this->Customer->find("first", array(
            "conditions" => array(
                "Customer.deviceId" => $this->request->data['Customer']['deviceId'],
                "Customer.id" => $this->request->data['Customer']['id']
            ),
            "contain" => false
        ));
        $cnt = $this->Customer->find("count", array(
            "conditions" => array(
                "Customer.deviceId" => $this->request->data['Customer']['deviceId'],
                //"Customer.id" => $this->request->data['Customer']['id']
            ),
            "contain" => false
        ));
        $referal = $this->Customer->find("first", array(
            "conditions" => array(
                "Customer.my_promo_code" => $this->request->data['Customer']['code']
            ),
            "contain" => false
        ));
        
        
        if($cnt > 1){
            $res = array(
                "error" => 1,
                "msg" => "You can't redeem promo code twice on the same device."
            );
        }elseif(empty($referal)){
            $res = array(
                "error" => 1,
                "msg" => "Invalid Promo Code"
            );
        }elseif (!empty($referal) && $me['Customer']['refered_by'] == null) {
            // Add cash to me
            $this->Customer->updateAll(array(
                "Customer.cash_by_promo" => "'" . ($me['Customer']['cash_by_promo'] + $this->_promodiscount) . "'",
                "Customer.refered_by" => "'" . $this->request->data['Customer']['code'] . "'",
                    ), array(
                "Customer.id" => $me['Customer']['id']
            ));

//            // Add cash to referal
//            $this->Customer->updateAll(array(
//                "Customer.cash_by_promo" => "'" . ($referal['Customer']['cash_by_promo'] + ".$this->_referalBonus.") . "'"
//                    ), array(
//                "Customer.id" => $referal['Customer']['id']
//            ));
            $res = array(
                "error" => 0,
                "msg" => "You just earned Rs.".$this->_promodiscount."/-"
            );
        } else {
            $res = array(
                "error" => 1,
                "msg" => "You can't redeem promo code twice on the same device."
            );
        }
        
        $this->set(array(
            'data' => $res,
            '_serialize' => array('data')
        ));
    }

    /**
     * Api to Get Referal Code
     */
    public function api_getpromostring() {
        if (!$this->request->is(array('post'))) {
            throw new NotFoundException("Invalid Request Method");
        }
        $this->loadModel('Customer');
        $data = $this->Customer->find("first", array(
            "conditions" => array(
                "Customer.deviceId" => $this->request->data['Customer']['deviceId'],
                "Customer.id" => $this->request->data['Customer']['id']
            ),
            "contain" => false
        ));
        if (empty($data)) {
            $res = array(
                "error" => 1,
                "msg" => "No records found for this deviceId: " . $this->request->data['Customer']['deviceId'] . " and id: " . $this->request->data['Customer']['id'],
                "code" => ""
            );
        } else {
            $res = array(
                "error" => 0,
                "msg" => "Share your promo code <b>".$data['Customer']['my_promo_code']."</b> with your friends, and they get Rs ".$this->_promodiscount." first meal free. Once they order, you get Rs ".$this->_referalBonus." in Pickmeals credits.",
                "code" => $data['Customer']['my_promo_code']
            );
        }
        $this->set(array(
            'data' => $res,
            '_serialize' => array('data')
        ));
    }

    /**
     * Api to send contact us query by E-Mail
     */
    public function api_contactus() {
        if (!$this->request->is(array('post'))) {
            throw new NotFoundException("Invalid Request Method");
        }

        App::uses("CakeEmail", "Network/Email");
        $fm = new CakeEmail('smtp');
        $viewVars = array(
            'name' => $this->request->data['name'],
            'email' => $this->request->data['email'],
            'number' => $this->request->data['number'],
            'message' => $this->request->data['message']
        );
        $fm->to("pickmeals@gmail.com")
                ->cc("himan.verma@live.com")
                ->viewVars($viewVars)
                ->from("no-reply@pickmeals.com", "PickMeals.com")
                ->replyTo("support@pickmeals.com", "PickMeals.com")
                ->subject("Query on PickMeals.com via Android App")
                ->template("contact")
                ->emailFormat('html');
        try {
            $x = $fm->send();
            $res = array(
                "error" => 0,
                "msg" => "Your message has been sent to our team we will contact you soon."
            );
            
        } catch (SocketException $e) {
            $res = array(
                "error" => 0,
                "msg" => "Some error occured sending your query/message."
            );
        }


        $this->set(array(
            'data' => $res,
            '_serialize' => array('data')
        ));
    }
    
    /**
     * Add Cash to Referals Account when When first order is placed using his/her code
     *       
     */
    public function sendCashToReferal($cId){
        if(is_object($this->request)){
            throw new NotFoundException("Page not found 404");
        }
        $this->loadModel('Order');
        $this->loadModel('Customer');
        $x = $this->Order->find("first",array(
           "contain" => array(
               "Address","Customer"
           ),
           "conditions" => array(
               "Customer.referal_paid" => 0,
               "Order.customer_id" => $cId,
               "Order.payment_status" => "PAID"
           ) 
        ));
        if(!empty($x)){
            $referal = $this->Customer->find("first",array(
                "conditions" => array(
                    "Customer.my_promo_code" => $x['Customer']['refered_by'] == NULL ? "tmp77val" : $x['Customer']['refered_by']
                )
            ));
            if(!empty($referal)){
                $this->Customer->updateAll(array(
                        "Customer.cash_by_promo" => "'" . ($referal['Customer']['cash_by_promo'] + $this->_referalBonus) . "'"
                            ), array(
                        "Customer.id" => $referal['Customer']['id']
                    ));

                $this->Customer->updateAll(array(
                        "Customer.referal_paid" => "'1'"
                            ), array(
                        "Customer.id" => $cId
                    ));
            }
        }
    }
    
}
    