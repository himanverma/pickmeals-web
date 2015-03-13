<?php
App::uses("AppController","Controller");
/**
 * Description of GlobalsettingsController
 * @property Globalsetting $Globalsetting Description
 * @author admin
 */
class GlobalsettingsController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
    }
    public function add(){
        
    }
    public function change(){
        
    }
    public function index(){
        
    }
    public function shoponline(){
        if(Configure::read('Global.shop_online') == "off"){
            $val = "on";
        }else{
            $val = "off";
        }
        $this->Globalsetting->updateAll(array(
            "Globalsetting.cvalue" => "'".$val."'"
        ), array(
            "Globalsetting.ckey" => "shop_online"
        ));
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->body(json_encode(array(
            "d" => $val
        )));
    }
}
