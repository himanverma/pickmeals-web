<?php

App::uses('AppController', 'Controller');

/**
 * Combinations Controller
 *
 * @property Combination $Combination
 * @property Feedback $Feedback
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CombinationsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $_since = "2015-2-19";

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('api_index', 'api_view', 'api_search', 'api_feedback'));
        $this->updateRatings();
    }

    /* ------------------------------------------ Web-Services-Start---------------------------------------- */

    public function api_indexweb() {
//        Configure::write('debug', 2);
//        $lat = $this->request->data['User']['latitude'] = 30.7238504;
//        $long = $this->request->data['User']['longitude'] = 76.8465098;
//        $count = $this->request->data['User']['count'] = 1;
        $lat = $this->request->data['User']['latitude'];
        $long = $this->request->data['User']['longitude'];
        $count = $this->request->data['User']['count'];
        $cnd = array(
            "Combination.stock_count > " => 0,
            "Combination.visible" => 1,
            "Combination.type" => "MAIN",
            "DATE(Combination.date) >= " => $this->_since, // date("Y-m-d"),
            "get_distance_in_miles_between_geo_locations($lat,$long,Vendor.lat,Vendor.long) <=" => 13.73
        );
        if ($lat == 0 || $long == 0) {
            $cnd = array(
                "Combination.stock_count > " => 0,
                "Combination.type" => "MAIN",
                "Combination.visible" => 1,
                "DATE(Combination.date) >= " => $this->_since // date("Y-m-d"),
                    //"get_distance_in_miles_between_geo_locations($lat,$long,Vendor.lat,Vendor.long) <=" => 3.73
            );
        }

        $combination1 = $this->Combination->find('count', array(
            "fields" => array("get_distance_in_miles_between_geo_locations($lat,$long,Vendor.lat,Vendor.long) as distance", "Vendor.*", "Combination.*"),
            //"order" => 'Combination.id DESC',
            "conditions" => $cnd
        ));
        $combination['items'] = $this->Combination->find('all', array(
            "conditions" => $cnd,
            "fields" => array("get_distance_in_miles_between_geo_locations($lat,$long,Vendor.lat,Vendor.long) as distance", "Vendor.*", "Combination.*"),
            //"order" => 'distance ASC',
            "order" => 'Combination.id DESC',
            'limit' => 40,
            'offset' => ($count - 1) * 40,
            'page' => $count
        ));
//        foreach($combination['items'] as &$ar){
//            $totalRatings = 0;
//            foreach($ar['Review'] as $rv){
//                $totalRatings += $rv['ratings'];
//            }
//            if(count($ar['Review']) != 0){
//                $ar['Combination']['ratings'] = $totalRatings/count($ar['Review']);
//            }else{
//                $ar['Combination']['ratings'] = 0;
//            }
//            
//        }
        $combination['list'] = $combination1;
        $this->set(array(
            'data' => $combination,
            '_serialize' => array('data')
        ));
    }

    public function api_get() {
        Configure::write('debug', 0);
//        Configure::write('debug', 2);
        $lat = $this->request->data['User']['latitude'] = 0.0; //30.7238504;
        $long = $this->request->data['User']['longitude'] = 0.0; //76.8465098;
//        $count = $this->request->data['User']['count'] = 1;
        $lat = $this->request->data['User']['latitude'];
        $long = $this->request->data['User']['longitude'];
        if ($lat == 0.0 || $long == 0.0) {
            $cnd = array(
                "Combination.stock_count > " => 0,
                "Combination.type" => "MAIN",
                "Combination.visible" => 1,
                "DATE(Combination.date) >= " => $this->_since//date("Y-m-d"),
            );
        } else {
            $cnd = array(
                "Combination.stock_count > " => 0,
                "Combination.type" => "MAIN",
                "Combination.visible" => 1,
                "DATE(Combination.date) >= " => $this->_since, //date("Y-m-d"),
                "get_distance_in_miles_between_geo_locations($lat,$long,Vendor.lat,Vendor.long) <=" => 3.73
            );
        }
        $count = $this->request->data['User']['count'];
        $combination1 = $this->Combination->find('count', array(
            "fields" => array("get_distance_in_miles_between_geo_locations($lat,$long,Vendor.lat,Vendor.long) as distance", "Vendor.*", "Combination.*"),
            "order" => 'distance ASC',
            "conditions" => $cnd,
        ));

        $combination['items'] = $this->Combination->find('all', array(
            "fields" => array("get_distance_in_miles_between_geo_locations($lat,$long,Vendor.lat,Vendor.long) as distance", "Vendor.*", "Combination.*"),
            "conditions" => $cnd,
            "order" => 'RAND()',
        ));

        file_put_contents("files/apiget.txt", print_r($combination, true));

        $combination['list'] = $combination1;
        $this->set(array(
            'data' => $combination,
            '_serialize' => array('data')
        ));
    }

    public function api_feedback($id = NULL) {
        $combinationInfo = $this->Combination->find('first', array('conditions' => array(
                'Combination.id' => $id
            ),
            'fields' => array('id', 'vendor_id', 'display_name', 'image', 'day', 'date', 'price', 'reviewkey'),
            'recursive' => 1,
            'contain' => false
        ));
        $this->loadModel('Review');
        $x = $this->Review->find("all", array(
            'recursive' => 1,
            "conditions" => array(
                "Review.combination_reviewkey" => $combinationInfo['Combination']['reviewkey']
            ),
            "contain" => array(
                'Customer' => array(
                    'id',
                    'name',
                    'image',
                )
            )
        ));
        $reviews = array();
        foreach ($x as $v) {
            $reviews[] = $v;
        }

        $combinationInfo['Combination']['Review'] = $reviews;
        $this->set(array(
            'data' => $combinationInfo,
            '_serialize' => array('data')
        ));
    }

    public function api_view($id = null) {
        if (!$this->Combination->exists($id)) {
            throw new NotFoundException(__('Invalid Combination'));
        }
        $options = array('conditions' => array('Combination.' . $this->Combination->primaryKey => $id));
        $this->set(array(
            'data' => $this->Combination->find('first', $options),
            '_serialize' => array('data')
        ));
    }

    public function api_search($like = NULL) {
        $like = $this->request->data['Combination']['search'];
        $searchRecords = $this->Combination->find('all', array('conditions' => array(
                "AND" => array(
                    "Combination.type" => "MAIN",
                    "Combination.visible" => 1,
                    "Combination.display_name LIKE" => "%$like%",
                    "DATE(Combination.date) >= " => $this->_since // date("Y-m-d")
                )
        )));
        $this->set(array(
            'data' => $searchRecords,
            '_serialize' => array('data')
        ));
    }

    /* ------------------------------------------ Web-Services-End---------------------------------------- */

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Combination->recursive = 0;
        $this->Paginator->settings['limit'] = 20;
        $this->set('combinations', $this->Paginator->paginate());
    }

    public function today() {
        $this->Combination->recursive = 0;
        $this->Paginator->settings['limit'] = 20;
        $this->Paginator->settings['order'] = "Combination.id DESC";
        if($this->request->is(array('post'))){
            $dt = $this->Paginator->paginate(
                    "Combination", array(
                        "DATE(Combination.date) >= " => $this->_since, //date("Y-m-d"),
                        "" . $this->request->data['field'] . " LIKE" => "%".$this->request->data['keyword']."%"
                    )
            );
        }else{
            $dt = $this->Paginator->paginate(
                    "Combination", array(
                        "DATE(Combination.date) >= " => $this->_since//date("Y-m-d")
                    )
            );
        }
        $this->set('combinations', $dt);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Combination->exists($id)) {
            throw new NotFoundException(__('Invalid combination'));
        }
        $options = array('conditions' => array('Combination.' . $this->Combination->primaryKey => $id));
        $this->set('combination', $this->Combination->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Combination->create();
            $this->request->data['Combination']['date'] = time();
            if ($this->Combination->save($this->request->data)) {
                $this->Session->setFlash(__('The combination has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The combination could not be saved. Please, try again.'));
            }
        }
        $vendors = $this->Combination->Vendor->find('list');
        $this->set(compact('vendors'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Combination->exists($id)) {
            throw new NotFoundException(__('Invalid combination'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Combination->save($this->request->data)) {
                $this->Session->setFlash(__('The combination has been saved.'));
                //return $this->redirect(array('action' => 'index'));
                return $this->redirect($this->Session->read("ref.url"));
            } else {
                $this->Session->setFlash(__('The combination could not be saved. Please, try again.'));
            }
        } else {
            $this->Session->write("ref.url", $this->request->referer());
            $options = array('conditions' => array('Combination.' . $this->Combination->primaryKey => $id));
            $this->request->data = $this->Combination->find('first', $options);
        }
        $vendors = $this->Combination->Vendor->find('list');
        $this->set(compact('vendors'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Combination->id = $id;
        if (!$this->Combination->exists()) {
            throw new NotFoundException(__('Invalid combination'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Combination->delete()) {
            $this->Session->setFlash(__('The combination has been deleted.'));
        } else {
            $this->Session->setFlash(__('The combination could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function deleteSelected() {
        if ($this->request->is(array('ajax', 'post'))) {

            $this->Combination->deleteAll(array(
                "Combination.id" => $this->request->data['ids']
                    ), true);
            echo 'done';
        }
        exit;
    }

    public function hideSelected() {
        if ($this->request->is(array('ajax', 'post'))) {
            $this->Combination->updateAll(array(
                "Combination.visible" => 0
                    ), array(
                "Combination.id" => $this->request->data['ids']
            ));
            echo 'done';
        }
        exit;
    }

    public function showSelected() {
        if ($this->request->is(array('ajax', 'post'))) {
            $this->Combination->updateAll(array(
                "Combination.visible" => 1
                    ), array(
                "Combination.id" => $this->request->data['ids']
            ));
            echo 'done';
        }
        exit;
    }

    private function roundUpToAny($n, $x = 5) {
        return (round($n) % $x === 0) ? round($n) : round(($n + $x / 2) / $x) * $x;
    }

    public function generate() {
        Configure::write('debug', 2);
        $this->loadModel('Recipe');
        $this->Recipe->recursive = 0;
        $recipes = $this->Recipe->find('all', array(
            "order" => "Recipe.recipe_name ASC"
        ));
        $r = array();
        foreach ($recipes as $d) {
            $r[] = $d['Recipe'];
        }
        $this->set("recipes", $r);
        $this->loadModel('Vendor');
        $this->Vendor->recursive = 0;
        $vendors = $this->Vendor->find('all');
        $r = array();
        foreach ($vendors as $d) {
            $r[] = $d['Vendor'];
        }
        $this->set("vendors", $r);
        if ($this->request->is('post')) {
            App::uses("HtmlHelper", "View/Helper");
            $html = new HtmlHelper(new View());
            foreach ($this->request->data as $data) {
                ///-------------Create Thali image start
                $is_thali = true;
                $dishArr = array();
                foreach ($data['Combination']['CombinationItem'] as $v) {
                    $dishArr[] = ltrim($v['image'], 'https://www.pickmeals.com/');
                    if ($v['is_thali'] == 'false') {
                        $is_thali = false;
                    }
                }

                if (count($dishArr) == 1) {      //for same dish in both 2 bowls
                    $dishArr[] = $dishArr[0];
                }

                $thali_pngs = $this->createThali($dishArr, $is_thali, 150);
                $data['Combination']['image'] = $html->url("/" . $thali_pngs[2], true);
                ///-------------Create Thali image end
                //------------Vendor Cost and Price Logic starts
                //vendor_cost
                //------------Vendor Cost and Price Logic ends

                $this->Combination->saveAssociated($data, array('deep' => true));
                $this->loadModel('Review');
                debug($this->Combination->getLastInsertID());
                $x = $this->Combination->find("first", array("conditions" => array("Combination.id" => $this->Combination->getLastInsertID())));
                $x2 = $this->Review->find("all", array("contain" => false, "conditions" => array("Review.combination_reviewkey" => $x['Combination']['reviewkey']), "fields" => array("id")));

                foreach ($x2 as $v) {
                    App::uses("CombinationsReview", "Model");
                    $a = new CombinationsReview();
                    //$a->create();
                    if (!$a->hasAny(array("CombinationsReview.combination_id" => $this->Combination->getLastInsertID(), "CombinationsReview.review_id" => $v['Review']['id']))) {
                        $a->save(array(
                            "CombinationsReview" => array(
                                'combination_id' => $this->Combination->getLastInsertID(),
                                'review_id' => $v['Review']['id']
                            )
                        ));
                    }
                }
            }
        }
    }

    public function createThali($dishArray = array(), $is_thali, $w = 140, $h = 0) {
        Configure::write('debug', 2);
        ini_set("max_execution_time", -1);

        $thali1 = new Imagick("tmpl/img/thali-1.png");
        $thali2 = new Imagick("tmpl/img/thali-2.png");
        $thali3 = new Imagick("tmpl/img/thali-3.png");

        $mask_1 = new Imagick("tmpl/img/thali-mask2.png");
        $mask_2 = new Imagick("tmpl/img/thali-mask3.png");

        if (!is_array($dishArray)) {
            return false;
        }

        $mask_cnt = 0;
        foreach ($dishArray as $dish) {
            if ($mask_cnt > 1) {   // Mask Locking (Modify if masks will be increased or decreased)
                break;
            }
            $dish = new Imagick($dish);

            $dish->scaleimage($thali1->getimagewidth(), $thali1->getimageheight()); // Set As per bowl image


            if ($is_thali) {
                if ($mask_cnt == 1) {
                    $dish->rotateimage("#fff", 180);
                }
                $dish->compositeimage(new Imagick("tmpl/img/thali-mask" . ($mask_cnt + 2) . ".png"), \Imagick::COMPOSITE_COPYOPACITY, 0, 0, Imagick::CHANNEL_ALPHA);
                $dish->mergeimagelayers(Imagick::LAYERMETHOD_COALESCE);

                $thali1->compositeimage($dish, \Imagick::COMPOSITE_ATOP, 0, 0, Imagick::CHANNEL_ALPHA);
                $thali1->mergeimagelayers(Imagick::LAYERMETHOD_COALESCE);

                $thali2->compositeimage($dish, \Imagick::COMPOSITE_ATOP, 0, 0, Imagick::CHANNEL_ALPHA);
                $thali2->mergeimagelayers(Imagick::LAYERMETHOD_COALESCE);

                $thali3->compositeimage($dish, \Imagick::COMPOSITE_ATOP, 0, 0, Imagick::CHANNEL_ALPHA);
                $thali3->mergeimagelayers(Imagick::LAYERMETHOD_COALESCE);
            } else {
                $thali3 = $dish;
            }


            $mask_cnt++;
        }

        $url = "files/thali_images/" . $this->randomString(6);
        $url_end = "-Thali.jpg";
        $result_urls = array();
        $thali1->setimageformat("jpg");
        $thali1->setImageFileName($result_urls[] = $url . "-0" . $url_end);
        $thali1->scaleimage($w, $h);
        if ($is_thali) {
            $thali2->writeimage();
        }
        $thali1->destroy();

        $thali2->setimageformat("jpg");
        $thali2->setImageFileName($result_urls[] = $url . "-1" . $url_end);
        $thali2->scaleimage($w, $h);
        if ($is_thali) {
            $thali2->writeimage();
        }
        $thali2->destroy();

        $thali3->setimageformat("jpg");
        $thali3->setImageFileName($result_urls[] = $url . "-2" . $url_end);
        $thali3->scaleimage($w, $h);
        $thali3->writeimage();
        $thali3->destroy();


        return $result_urls;
    }

    public function upd() {
        $this->autoRender = false;
        if ($this->request->is(array('post'))) {
            $d = $this->request->data;
            $this->Combination->updateAll(array(
                "Combination.stock_count" => "'" . $d['val'] . "'"
                    ), array(
                "Combination.id" => $d['id']
            ));
            echo 'done';
            exit;
        }
    }

    public function api_availability() {
        $d = $this->request->data;

        ob_start();
//        print_r($d);
        file_put_contents("tdt.txt", ob_get_flush());


        $af = array();
        $flag = 0;
        foreach ($d as $er) {
            $x = $this->Combination->find("first", array(
                "conditions" => array(
                    "Combination.id" => $er['Order']['combination_id'],
                    "Combination.stock_count <" => $er['Order']['qty']
                ),
                "contain" => false
            ));
            if (!empty($x)) {
                $flag = 1;
                $af[] = array(
                    "Order" => $x['Combination']
                );
            }
        }


        $res = array(
            "error" => $flag,
            "Orders" => $af,
//            "msg" => "All Combinations are available..."
        );
        ob_start();
//        print_r($res);
        file_put_contents("tds.txt", ob_get_flush());

        $this->set(array(
            'data' => $res,
            '_serialize' => array('data')
        ));
    }

}
