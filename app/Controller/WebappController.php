<?php

App::uses("AppController", "Controller");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebappController
 *
 * @author Himanshu
 * @property Customer $Customer Description
 * @property Review $Review Description
 * @property Vendor $Vendor Description
 * @property Combination $Combination Description
 */
class WebappController extends AppController {

    public $components = array('Paginator', 'Session');
    public $_since = "2015-2-19";

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = "webapp";
        $this->Auth->allow(array('home', 'login', 'fblogin', 'chef', 'checkout','reviews', 'getuser', 'checklogin', "aboutus", "contactus", "faq", "press", "privacy", "terms", "forgot_password", "change_password", "change_password", 't'));
        
        $this->loadModel('Category');
        $this->set("top_menu", $this->Category->find('threaded'));
        
        $this->loadModel('Combination');
        $this->set("extras", $this->Combination->find("all",array(
            "conditions" => array(
                "Combination.type <>" => "MAIN" 
            ),
            "contain" => array('Vendor')
        )));
        
    }

    public function home() {
        $this->layout = "webapp";
    }
    public function dev() {
        $this->layout = "webapp-dev";
    }

    public function checklogin() {
        if ($this->request->is(array('ajax', 'post'))) {
            $this->autoRender = false;
            $this->loadModel('Customer');
            $x = $this->Customer->find("count", array(
                "conditions" => array(
                    "Customer.mobile_number" => $this->request->data['Customer']['mobile_number']
                )
            ));
            if ($x == 0) {
                // create new Customer here..
                $pass = $this->randomString(6);
                $this->Customer->save(array(
                    'Customer' => array(
                        'mobile_number' => $this->request->data['Customer']['mobile_number'],
                        'password' => $pass,
                        "registered_on" => time()
                    )
                ));
                $this->sendSms($this->request->data['Customer']['mobile_number'], "Your pickmeals.com password is " . $pass);
            }
            $this->response->type('json');
            $this->response->body(json_encode(array("count" => $x)));
        }
    }

    public function login() {
        $this->loadModel('Customer');

        $this->layout = "webapp_inner";
        if ($this->request->is(array('ajax', 'post'))) {
            $this->autoRender = false;

            if ($this->Auth->login()) {
                $res['error'] = 0;
                $res['msg'] = "Welcome Back " . $this->Auth->user('name');
            } else {
                $res['error'] = 1;
                $res['msg'] = "Please try again...";
            }
            $this->response->type('json');
            $this->response->body(json_encode($res));
        }
    }

    public function fblogin() {
//        Configure::write('debug', 2);
        if ($this->request->is('ajax')) {
//            debug($this->request->data);
//            exit;
            $d = $this->request->data;
            $this->loadModel('Customer');
            $user = $this->Customer->find('first', array(
                "conditions" => array(
                    //"Customer.email" => $d['email'],
                    "Customer.fbid" => $d['id']
                )
            ));
            if (!isset($user['Customer'])) {
               
                $data = array(
                    "Customer" => array(
                        "fbid" => $d['id'],
                        "fbrawdata" => json_encode($d),
                        "email" => isset($d['email']) ? $d['email'] : $d['id']."@facebook.com",
                        "name" => @$d['first_name'] . " " . @$d['last_name'],
                        "verified" => @$d['verified'],
                        "status" => "VERIFIED",
                        "password" => "pickm",
                        "address" => @$d['location']['name'],
                        "v_code" => "pickm",
                        "registered_on" => time()
//                      "fbid" => $d['id'],
//                      "fbid" => $d['id'],
                    )
                );
                $this->Customer->create();
                $msg = "You are registered successfuly...";
                $error = 0;
                if ($this->Customer->save($data)) {
                    if($d['profile_pic'] != ''){
                        App::uses("HtmlHelper", "View/Helper");
                        $html = new HtmlHelper(new View());
                        
                        App::uses('HttpSocket', 'Network/Http');
                        $HttpSocket = new HttpSocket(array(
                            'ssl_verify_peer' => false,
                            'ssl_verify_host' => false,
                        ));
                        $data_img = $HttpSocket->get($d['profile_pic']);
                        
                        file_put_contents($pth2 = "files/profile_image/".date('YmdHis') . rand(1, 999) . ".jpg", $data_img);
                        $this->Customer->updateAll(array(
                            "Customer.image" => "'".$html->url("/".$pth2, true)."'"
                        ), array(
                            "Customer.id" => $this->Customer->getLastInsertID()
                        ));
                    }
                    $user = $this->Customer->find("first", array(
                        "conditions" => array(
                            "Customer.id" => $this->Customer->getLastInsertID()
                        )
                    ));
                    $this->generatePromo($this->Customer->getLastInsertID());
                } else {
                    $msg = "Error occured while registration...";
                    $error = 1;
                }
            } else {
                $error = 0;
                $msg = "Welcome back " . $user['Customer']['name'];
            }
            $this->Auth->authenticate = array(
                "Form" => array(
                    'userModel' => 'Customer',
                    'fields' => array(
                        'username' => 'fbid',
                        'password' => 'password'
                    )
                ),
            );
            Configure::write('debug', 0);
            $this->request->data = false;
            $this->request->data("Customer.fbid", $user['Customer']['fbid']);
            $this->request->data("Customer.password", $user['Customer']['v_code']);            
            
            if ($this->Auth->login()) {
                $res = array(
                    "error" => 0,
                    "data" => $user,
                    "msg" => $msg,
                );
                
            } else {
                debug("unable to login");
                $res = array(
                    "error" => 1,
                    "data" => "",
                    "msg" => $msg,
                );
            }

            $this->autoRender = false;
            $this->response->type('json');
            $this->response->body(json_encode($res));
        } else {
            throw new NotFoundException("page not found");
        }
    }

    public function logout() {
        parent::logout();
    }

    public function getuser() {
        $this->autoRender = FALSE;
        $x = AuthComponent::user();
        $this->response->type('json');
        $this->response->body(json_encode($x));
    }

    public function checkout() {
        $this->layout = "webapp_inner";
        $this->loadModel('Customer');
        $x = $this->Customer->find("first",array(
            'conditions' => array(
                'Customer.id' => AuthComponent::user('id')
            ),
            'contain' => false
        ));
        $this->set("me", $x['Customer']);
    }

    public function chef($slug = null) {
        $this->layout = "webapp_inner";
        if ($slug == null) {
            throw new NotFoundException("Page Not Found...");
        }
        $slug = str_replace("-", " ", $slug);
        $this->loadModel('Vendor');
        $vendor = $this->Vendor->find("first", array(
            "conditions" => array(
                "Vendor.name LIKE" => $slug
            ),
            "contain" => array(
                "Combination",
                "DATE(Combination.date) >= ".$this->_since." AND Combination.visible = 1 AND Combination.type = 'MAIN'",
                "Combination.Review"
            )
//            array(
//                //"Combination.date BETWEEN '" . date("Y-m-d 00:00:00") . "' AND '" . date("Y-m-d 00:00:00", strtotime("+1 day")) . "'",
//                //"DATE(Combination.date) >= ".$this->_since." AND Combination.visible = 1 AND Combination.type = 'MAIN'",
//                "Combination.visible" => 0,
//                "Combination.type" => "MAIN",
//                "Combination.Review"
//            )
        ));
//        print_r($vendor);
//        exit;
        $this->loadModel('Review');
        $reviews = $this->Review->find("all",array(
            "conditions" => array(
                "Review.vendor_id" => $vendor['Vendor']['id']
            )
        ));
        $rvCount = count($reviews);
        $this->set("reviews", $reviews);
        $this->set("vendor", $vendor);
        $this->set("rvCount", $rvCount);
//        debug($vendor);
//        exit;
    }

    public function reviews($key = null) {
        $this->layout = "webapp_inner";
        $this->loadModel("Combination");
        $this->loadModel("Review");
        $x = $this->Combination->find("first", array(
            "conditions" => array(
                "Combination.id" => $key
            )
        ));
        $this->Paginator->settings['limit'] = 10;
        $this->Paginator->settings['recursive'] = 0;
        //$this->Paginator->settings['contain'] = array("Address", "Combination", "Combination.Vendor", "Combination.Review");
        $x2 = $this->Paginator->paginate("Review", array(
            'Review.vendor_id' => $x['Combination']['vendor_id'],
            'Review.combination_reviewkey' => $x['Combination']['reviewkey']
        ));
        $this->set("combination", $x);
        $this->set("reviews", $x2);
        $this->set("authusr", AuthComponent::user());
//        debug($x);
//        exit;
    }

    public function myaccount() {
        ini_set("upload_max_filesize", "10M");
        ini_set("post_max_size", "10M");
        ini_set("max_execution_time", -1);
//        Configure::write('debug', 2);
        $this->loadModel('Customer');
        $this->layout = "webapp_inner";
        $me = $this->Customer->find("first", array("conditions" => array('Customer.id' => AuthComponent::user('id'))));
        $this->set("me", $me['Customer']);

        if ($this->request->is(array('ajax', 'post'))) {
            
            $d = $this->request->data;
            if(isset($d['Customer']['mobile_number'])){
                if($d['Customer']['mobile_number'] == ''){
                    unset($d['Customer']['mobile_number']);
                }
            }
            if($d['Customer']['name'] == ''){
                unset($d['Customer']['name']);
            }
            if($d['Customer']['address'] == ''){
                unset($d['Customer']['address']);
            }
            if(!isset($d['Customer']['image']['size'])){
                unset($d['Customer']['address']);
            }
            
            if ($d['Customer']['id'] != "") {
//                App::uses("AuthComponent", "Controller/Component");
//                if($d['Customer']['password'] == "" || AuthComponent::password($d['Customer']['opassword']) != AuthComponent::user('password')){
//                    unset($d['Customer']['password']);
//                }
                if ($this->Customer->save($d)) {
                    $this->autoRender = FALSE;
                    $this->response->type('json');
                    $me = $this->Customer->find("first", array("conditions" => array('Customer.id' => AuthComponent::user('id'))));
                    $this->response->body(json_encode($me));
                }
            } else {
                $this->autoRender = FALSE;
                $this->response->type('json');
                $this->response->body(json_encode(array('Customer' => array('image' => ''))));
            }
        }
    }
    
    public function cropImg() {
        //Configure::write('debug', 2);
        if ($this->request->is(array("ajax", "post"))) {
            $d = $this->request->data;
            $url = ltrim($d['uri'],"https://www.pickmeals.com/");
            $im = new Imagick($url);
            $im->cropimage($d['w'], $d['h'], $d['x'], $d['y']);
            $im->scaleimage(253, 0);
            $im->writeimage($url); 
            $im->destroy();
            $this->autoRender = false;
            $this->response->type('json');
            $this->response->body(json_encode(array("error"=>0)));
            
        }else{
            exit;
        }
        
    }
    public function removeImg(){
        if($this->request->is(array('post','ajax'))){
           $this->loadModel('Customer');
           $d = $this->Customer->read(array('image'), $this->request->data['id']);
           $img = ltrim($d['Customer']['image'],"https://www.pickmeals.com/");
           unlink($img);
           $this->Customer->updateAll(array(
               'Customer.image' => "''"
           ),array(
               'Customer.id' => $this->request->data['id']
           ));
           exit;
        }
    }

    public function myorders() {
        $this->layout = "ajax";
        $this->loadModel("Order");
        $this->Paginator->settings['limit'] = 4;
        $this->Paginator->settings['recursive'] = 2;
        $this->Paginator->settings['order'] = "Order.id DESC";
        $this->Paginator->settings['contain'] = array("Address", "Combination", "Combination.Vendor", "Combination.Review");
        $x = $this->Paginator->paginate("Order", array(
            'Order.customer_id' => AuthComponent::user('id'),
        ));
        foreach ($x as &$orderRecord) {
            foreach ($orderRecord['Combination']['Review'] as $k => &$rv) {
                if ($orderRecord['Order']['id'] != $rv['order_id']) {
                    unset($orderRecord['Combination']['Review'][$k]);
                }
            }
        }
        $this->set("orders", $x);
//        debug($x);
//        exit;
        if ($this->request->is(array('post'))) {
            $this->autoRender = FALSE;
            $this->loadModel('Review');
            $this->Review->create();
            $this->request->data['Review']['customer_id'] = AuthComponent::user('id');
            if ($this->Review->save($this->request->data)) {
                $res['error'] = 0;
                $res['msg'] = "Review posted... ID:" . $this->Review->getLastInsertID();
            } else {
                $res['error'] = 1;
                $res['msg'] = $this->Review->validationErrors;
            }
            $this->response->type('json');
            $this->response->body(json_encode($res));
        }
    }

    public function t() {
        $x = $this->randomString(6);
        //$response = $this->sendSms("8699445905", "Your password for ".$x);
        //debug($response);
        exit;
    }

    public function aboutus() {
        $this->layout = "webapp_inner";
    }

    public function contactus() {
      Configure::write('debug', 2);
        $this->layout = "webapp_inner";
        if($this->request->is('post')){        
        App::uses("CakeEmail", "Network/Email");
        $fm = new CakeEmail('smtp');
        $viewVars = array(
            'name'=>$this->request->data['name'],
            'email'=>$this->request->data['email'],
            'number'=>  $this->request->data['number'],
            'message'=>  $this->request->data['message']
        );
        $fm->to("pickmeals@gmail.com")
                ->cc("himan.verma@live.com")
                ->viewVars($viewVars)
                ->from("no-reply@pickmeals.com", "PickMeals.com")
                ->replyTo("support@pickmeals.com", "PickMeals.com")
                ->subject("Query on PickMeals.com")
                ->template("contact")
                ->emailFormat('html');
        try {
            $x = $fm->send();
            $this->Session->setFlash("Your message has been sent to our team we will contact you soon.");
        } catch (SocketException $e) {
            $this->Session->setFlash("Some error occured sending your query/message.");
        }
        }
        
    }
    public function feedback() {
        $this->layout = "webapp_inner";
    }

    public function faq() {
        $this->layout = "webapp_inner";
    }

    public function press() {
        $this->layout = "webapp_inner";
    }

    public function privacy() {
        $this->layout = "webapp_inner";
    }

    public function terms() {
        $this->layout = "webapp_inner";
    }

    public function payments() {
        $this->layout = "webapp_inner";
    }

    public function forgot_password() {
        $this->layout = "webapp_inner";
        if ($this->request->is(array('post'))) {
            $this->loadModel('Customer');
            $cst = $this->Customer->find("all", array(
                "conditions" => array(
                    "Customer.mobile_number" => $this->request->data['mobile_number']
                ),
                "contain" => false
            ));
            if (count($cst) > 0) {
                $pass = $this->randomString(6);
                $this->Customer->updateAll(array(
                    "Customer.password" => "'".AuthComponent::password($pass)."'" ,
                    "Customer.v_code" => "'".$pass."'"
                ),
                array(
                    'Customer.mobile_number' => $this->request->data['mobile_number']
                ));
                $this->Session->setFlash("New password has been sent to your registered Mobile Number...");
                $this->sendSms($this->request->data['mobile_number'], "Your pickmeals.com password is " . $pass);
            } else {
                $this->Session->setFlash("Mobile Number is not registered...");
            }
        }
    }

    public function change_password() {
        $this->layout = "webapp_inner";
        if($this->request->is(array('post'))){
            $this->loadModel('Customer');
            $user = $this->Customer->find("first", array(
                "conditions" => array(
                    "Customer.password" => AuthComponent::password($this->request->data['current_password']),
                    "Customer.id" => AuthComponent::user('id')
                ),
                "contain" => false
            ));
            if(count($user) == 0){
                $this->Session->setFlash("Invalid Current Password...");
            }elseif($this->request->data['new_password'] != $this->request->data['confirm_password']){
                $this->Session->setFlash("New Password and Confirm Passwords are not matching...");
            }elseif(strlen ($this->request->data['new_password']) < 4){
                $this->Session->setFlash("Please use at least 4 characters passwords...");
            }else{
                $this->Customer->updateAll(array(
                    "Customer.password" => "'".AuthComponent::password($this->request->data['new_password'])."'",
                    "Customer.v_code" => "'".$this->request->data['new_password']."'",
                ), array(
                    "Customer.id" => AuthComponent::user('id')
                ));
                $this->Session->setFlash("Password has been updated successfully...");
                $this->redirect("/myaccount");
            }
        }
    }

}
