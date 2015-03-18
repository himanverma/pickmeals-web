<?php

App::uses('AppController', 'Controller');
/**
 * Splash Controller
 *
 * @property Splash $Splash
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SplashsController extends AppController {
    
    public $components = array('RequestHandler','Paginator', 'Session');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('api_index'));
    }
    
    public function api_index(){
        Configure::write('debug',2);
        if($this->request->query('v') == '3'){
            $c = 'dfdf';
        }else{
            $c = 'active';
        }
        $records = $this->Splash->find('first',array(
            'conditions' => array(
                'Splash.status' => $c
            ),
            'order' => 'Splash.id DESC'
        ));
        if($records){
            $response['error'] = 0;
            $response['list'] = $records;
        }else{
            $response['error'] = 1;
            $response['msg'] = "no data found";
        }
        $this->set(array(
            'data' => $response,
            '_serialize' => array('data')
        ));
    }

    

    public function index() {
        Configure::write('debug',2);
//        debug('sdfvgasd');exit;
        $this->Splash->recursive = 0;
        $this->set('splashs', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Splash->exists($id)) {
            throw new NotFoundException(__('Invalid splash'));
        }
        $options = array('conditions' => array('Splash.' . $this->Splash->primaryKey => $id));
        $this->set('splash', $this->Splash->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        Configure::write('debug',2);
        if ($this->request->is('post')) {
            $this->Splash->create();
            $this->request->data['Splash']['status'] = 'active';
            if ($this->Splash->save($this->request->data)) {
                $this->Session->setFlash(__('The splash has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The splash could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->Splash->id = $id;
        if (!$this->Splash->exists($id)) {
            throw new NotFoundException(__('Invalid splash'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $one = $this->request->data['Splash']['file'];
            $x = $this->Splash->read('file',$id);
            if($one['error'] == 0){
                if($x['Splash']['file']){
                    $unlink = explode('files/', $x['Splash']['file']);
                    unlink('files/'.$unlink[1]);
                }
            }else{
                $this->request->data['Splash']['file'] = $x['Splash']['file'];
            }
            if ($this->Splash->save($this->request->data)) {
                $this->Session->setFlash(__('The splash has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The splash could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Splash.' . $this->Splash->primaryKey => $id));
            $this->request->data = $this->Splash->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Splash->id = $id;
        if (!$this->Splash->exists()) {
            throw new NotFoundException(__('Invalid splash'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Splash->delete()) {
            $this->Session->setFlash(__('The splash has been deleted.'));
        } else {
            $this->Session->setFlash(__('The splash could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}