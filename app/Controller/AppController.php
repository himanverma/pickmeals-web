<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array('RequestHandler', 'Auth', 'Session','MobileDetect.MobileDetect');
    public $helpers = array('Html', 'Form', 'Combinator.Combinator','Utilitymethods');
    public $_device = "desktop";
    
    public function _setGlobalConfig(){
        $this->loadModel("Globalsetting");
        $g = $this->Globalsetting->find("all");
        foreach($g as $gc){
            Configure::write('Global.'.$gc['Globalsetting']['ckey'], $gc['Globalsetting']['cvalue']);
        }
        
    }
    
    public function beforeRender() {
        if($this->name == 'CakeError') {
            $this->layout = 'error';
        }
    }


    public function beforeFilter() {
        
        parent::beforeFilter();
        if ($this->request->is('mobile')) {
            if($this->MobileDetect->detect('isTablet')){
                $this->_device = 'tablet';
            }
            if($this->MobileDetect->detect('isiOS')){
                $this->_device = 'iphone';
            }
            if($this->MobileDetect->detect('version', 'Android')){
                $this->_device = $this->MobileDetect->detect('version', 'Android');
            }
            //debug($this->_device);
            //exit;
        }
        $this->set("_device",  $this->_device);
        $this->_setGlobalConfig();

//        $this->Auth->allow();
        $this->rqWriter();
//        $this->Auth->logout();
//        if ($this->request->param('prefix') == false) {
//            $this->Auth->loginAction = "/";
//            $this->Auth->authenticate = array(
//                'Direct'
//            );
//            $this->set("authUser", $this->Auth->user());
//        } else {
//            $this->Auth->authenticate = array(
//                'Form'
//            );
//        }
        if ($this->request->param('prefix')) {
            if ($this->request->param('prefix') == "api") {
                $this->Auth->allow();
            } else {
                $this->Auth->loginAction = "/admin/login";
            }
        } else {
            $this->Auth->authenticate = array(
                "Form" => array(
                    'userModel' => 'Customer',
                    'fields' => array(
                        'username' => 'mobile_number',
                        'password' => 'password'
                    )
                ),
            );
            $this->Auth->loginAction = "/?_act=login";
        }
        

        $this->set("c_user", AuthComponent::user());
        $this->updateRatings();
         if (AuthComponent::user('is_admin') != 1) {
            $r = $this->request->params;
            $actions = array(               
                'index',
                'add',
                'generate',
                'today',
                'delete',
                'view',
                'edit',
            );
            $controllers = array(
                'vendors',
                'customers',
                'recipies',
                'dishfilters',
                'combinations',
                'addresses',
//                'devices'
            );
            if (in_array(strtolower($r['controller']), $controllers) && in_array(strtolower($r['action']), $actions) && !isset($r['ext'])) {
                throw new NotFoundException("Sorry admin access is limited to few users...");
            }elseif(in_array(strtolower($r['controller']), $controllers) && in_array(strtolower($r['action']), $actions) && $r['prefix'] == "admin") {
                throw new NotFoundException("Sorry admin access is limited to few users...");
            }
        }
        
    }

    private function rqWriter($clean = false) {
        if (!file_exists("files/rq.txt")) {
            $fp = fopen("files/rq.txt", "w+");
            fwrite($fp, "");
            fclose($fp);
        }
        if ($clean) {
            file_put_contents("files/rq.txt", "");
        }
        $old_data = file_get_contents("files/rq.txt");
        $fp = fopen("files/rq.txt", "w+");
        ob_start();
        echo "===================================================" . date("Y-m-d h:i:s a") . "=======================================================\n";
        echo "<-----Params------>\n";
        print_r($this->request->params);
        echo "\n<-----Data------>\n";
        print_r($this->request->data);
        echo "\n<-----Query------>\n";
        print_r($this->request->query);
        echo "\n<-----Location------>\n";
        print_r($this->request->here);
        echo "\n============================================================Over=================================================================\n";
        $data = ob_get_clean();
        fwrite($fp, $data . $old_data);
        fclose($fp);
        return $data;
    }

    public function logout() {
        $this->autoRender = FALSE;
        $this->Auth->logout();
        $this->redirect("/");
    }

    public function api_appFirstStart() {
        $this->set(array(
            'data' => $this->request->data,
            '_serialize' => array('data')
        ));
    }

    public function sendSms($to_mobileNo = null, $text = "", $priority = "ndnd", $smstype = "normal") {
        Configure::write('debug', 2);
        //$priority = ndnd/dnd
        //$smstype = normal/flash/unicode
        $api_user = "9988337074";
        $api_pass = "a589cb4";
        $api_senderID = urlencode("PMeals");
        $text = urlencode($text);
        $url = "http://bhashsms.com/api/sendmsg.php?user=$api_user&pass=$api_pass&sender=$api_senderID&phone=$to_mobileNo&text=$text&priority=$priority&stype=$smstype&dtype=1";

        $response = file_get_contents($url);
        return array("api_response" => $response, "api_url" => $url);
    }

    public function randomString($length) {
        return substr(str_pad(
                        base_convert(md5(mt_rand() . microtime(true)), 16, 36), 25, '0'), 0, $length);
    }

    public function updateRatings() {
        Configure::write('debug', 0);
        $this->loadModel("Combination");
        $c = $this->Combination->find("all", array(
            "conditions" => array(
                "DATE(Combination.date)" => date("Y-m-d")
            ),
            "group" => "reviewkey",
            "contain" => array("Review.ratings")
        ));
        foreach ($c as $v) {
            $cnt = 0;
            foreach ($v['Review'] as $rv) {
                $cnt += $rv['ratings'];
            }
            $totalRev = 0;
            if (count($v['Review']) != 0) {
                $totalRev = $cnt / count($v['Review']);
            }
            $this->Combination->updateAll(array(
                "Combination.ratings" => $totalRev
                    ), array(
                "Combination.reviewkey" => $v['Combination']['reviewkey']
            ));
        }
    }
    protected function generatePromoAll(){
        $this->loadModel('Customer');
        $x = $this->Customer->find("all");
        foreach($x as $v){
                if(strlen($v['Customer']['name']) < 6){
                    $code = strtoupper($this->randomString(4)).$v['Customer']['id'];
                }else{
                    $t2 = str_replace(" ", "", $v['Customer']['name']);
                    $code = strtoupper(substr($t2, 0,4)).$v['Customer']['id'];
                }
                
                $this->Customer->updateAll(array(
                    "Customer.my_promo_code" => "'".$code."'"
                ), array(
                    "Customer.id" => $v['Customer']['id']
                ));
        }
    }
    protected function generatePromo($id){
        $this->loadModel('Customer');
        $x = $this->Customer->find("all",array(
            "conditions" =>array(
                "Customer.id" => $id
            )
        ));
        foreach($x as $v){
                if(strlen($v['Customer']['name']) < 6){
                    $code = strtoupper($this->randomString(4)).$v['Customer']['id'];
                }else{
                    $t2 = str_replace(" ", "", $v['Customer']['name']);
                    $code = strtoupper(substr($t2, 0,4)).$v['Customer']['id'];
                }
                
                $this->Customer->updateAll(array(
                    "Customer.my_promo_code" => "'".$code."'"
                ), array(
                    "Customer.id" => $v['Customer']['id']
                ));
        }
    }

}
