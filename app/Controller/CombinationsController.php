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

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('api_index', 'api_view', 'api_search', 'api_feedback'));
        $this->updateRatings();
    }

    /* ------------------------------------------ Web-Services-Start---------------------------------------- */

    public function api_index() {
//        Configure::write('debug', 2);
//        $lat = $this->request->data['User']['latitude'] = 30.7238504;
//        $long = $this->request->data['User']['longitude'] = 76.8465098;
//        $count = $this->request->data['User']['count'] = 1;
        $lat = $this->request->data['User']['latitude'];
        $long = $this->request->data['User']['longitude'];
        $count = $this->request->data['User']['count'];
        $combination1 = $this->Combination->find('count', array(
            "conditions" => array(
                "DATE(Combination.date)" => date("Y-m-d")
            ),
            "fields" => array("get_distance_in_miles_between_geo_locations($lat,$long,Vendor.lat,Vendor.long) as distance", "Vendor.*", "Combination.*"),
            "order" => 'distance ASC',
        ));

        $combination['items'] = $this->Combination->find('all', array(
            "conditions" => array(
                "DATE(Combination.date)" => date("Y-m-d")
            ),
            "fields" => array("get_distance_in_miles_between_geo_locations($lat,$long,Vendor.lat,Vendor.long) as distance", "Vendor.*", "Combination.*"),
            "order" => 'distance ASC',
            'limit' => 8,
            'offset' => ($count - 1) * 8,
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

    public function api_feedback($id = NULL) {
        $combinationInfo = $this->Combination->find('first', array('conditions' => array(
                'Combination.id' => $id
            ),
            'fields' => array('id', 'vendor_id', 'display_name', 'image', 'day', 'date', 'price','reviewkey'),
            'recursive' => 1,
            'contain' => false
        ));
        $this->loadModel('Review');
        $x = $this->Review->find("all",array(
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
        foreach($x as $v){
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
                    "Combination.display_name LIKE" => "%$like%",
                    "DATE(Combination.date)" => date("Y-m-d")
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
        $this->Paginator->settings['limit'] = 10;
        $this->set('combinations', $this->Paginator->paginate());
    }

    public function today() {
        $this->Combination->recursive = 0;
        $this->Paginator->settings['limit'] = 10;
        $this->set('combinations', $this->Paginator->paginate(
                        "Combination", array(
                    "DATE(Combination.date)" => date("Y-m-d")
                        )
        ));
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
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The combination could not be saved. Please, try again.'));
            }
        } else {
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

    public function generate() {
        $this->loadModel('Recipe');
        $this->Recipe->recursive = 0;
        $recipes = $this->Recipe->find('all');
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
            foreach ($this->request->data as $data) {
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

}
