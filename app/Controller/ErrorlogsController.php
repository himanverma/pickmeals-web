<?php
App::uses('AppController', 'Controller');
/**
 * Errorlogs Controller
 *
 * @property Errorlog $Errorlog
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ErrorlogsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow(array('api_add'));
        }

        public function api_add() {
		if ($this->request->is('post')) {
			$this->Errorlog->create();
			if ($this->Errorlog->save($this->request->data)) {
				$response['error'] = 0;
				$response['msg'] = 'success';
			} else {;
				$response['error'] = 1;
				$response['error'] = 'sorry';
			}
		}
                $this->set(array(
                    'data' => $response,
                    '_serialize' => array('data')
                ));
	}
        /**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Errorlog->recursive = 0;
		$this->set('errorlogs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Errorlog->exists($id)) {
			throw new NotFoundException(__('Invalid errorlog'));
		}
		$options = array('conditions' => array('Errorlog.' . $this->Errorlog->primaryKey => $id));
		$this->set('errorlog', $this->Errorlog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Errorlog->create();
			if ($this->Errorlog->save($this->request->data)) {
				$this->Session->setFlash(__('The errorlog has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The errorlog could not be saved. Please, try again.'));
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
		if (!$this->Errorlog->exists($id)) {
			throw new NotFoundException(__('Invalid errorlog'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Errorlog->save($this->request->data)) {
				$this->Session->setFlash(__('The errorlog has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The errorlog could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Errorlog.' . $this->Errorlog->primaryKey => $id));
			$this->request->data = $this->Errorlog->find('first', $options);
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
		$this->Errorlog->id = $id;
		if (!$this->Errorlog->exists()) {
			throw new NotFoundException(__('Invalid errorlog'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Errorlog->delete()) {
			$this->Session->setFlash(__('The errorlog has been deleted.'));
		} else {
			$this->Session->setFlash(__('The errorlog could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
