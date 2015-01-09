<?php
App::uses('AppController', 'Controller');
/**
 * Feedbacks Controller
 *
 * @property Feedback $Feedback
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FeedbacksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow('api_add');
        }
        
        
        public function api_add(){
            if ($this->request->is('post')) {
                    $this->Feedback->create();
                    if ($this->Feedback->save($this->request->data)) {
                            $this->set(array(
                                    'data' => array(
                                                    "error" => 0,
                                                    "msg" => "success"
                                                ),
                                    '_serialize' => array('data')
                                ));
                    } else {
                            $this->set(array(
                                    'data' => array(
                                                    "error" => 1,
                                                    "msg" => "sorry"
                                                ),
                                    '_serialize' => array('data')
                                ));
                    }
            }
        }

}
