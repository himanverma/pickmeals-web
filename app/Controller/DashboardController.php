<?php

App::uses("AppController", "Controller");

class DashboardController extends AppController {

    public $_since = "2015-2-19";
    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {
        
    }

    public function neworder() {
        $this->loadModel("Combination");
        $this->loadModel("Customer");
        $cnd = array(
            "Combination.type" => "MAIN",
            //"Combination.visible" => 1,
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
    

}
