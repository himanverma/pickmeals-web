<?php
App::uses('AppController', 'Controller');
/**
 * Reviews Controller
 *
 * @property Review $Review
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property Combination $Combination Description
 */
class ReviewsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function api_index() {
		$this->Review->recursive = 1;
                $this->set(array(
                    'data' => $this->Paginator->paginate(),
                    '_serialize' => array('data')
                ));
	}
        
        public function index() {
		$this->Review->recursive = 0;
		$this->set('reviews', $this->Paginator->paginate());
	}
        
        
        public function api_view($id = null) {
            if (!$this->Review->exists($id)) {
                throw new NotFoundException(__('Invalid Review'));
            }
            $options = array('conditions' => array('Combination.' . $this->Review->primaryKey => $id));
            $this->set(array(
                'data' => $this->Review->find('first', $options),
                '_serialize' => array('data')
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
		if (!$this->Review->exists($id)) {
			throw new NotFoundException(__('Invalid review'));
		}
		$options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
		$this->set('review', $this->Review->find('first', $options));
	}

        
        public function api_add() {
		if ($this->request->is('post')) {
			$this->Review->create();
                        
                        $this->loadModel('Combination');
                        $rt = $this->Combination->read(array("reviewkey"), $this->request->data['Combination']['Combination'][0]);
                        $this->request->data['Review']['combination_reviewkey'] = $rt['Combination']['reviewkey'];

                        
			if ($this->Review->save($this->request->data)) {
				$res['msg'] = __('The review has been saved.');
                                $res['error'] = 0;
			} else {
                                $res['msg'] = __('The review could not be saved. Please, try again.');
                                $res['error'] = 0;
			}
		}else{
                    throw new NotFoundException("Improper Method Call...");
                }
                $this->set(array(
                    'data' => $res,
                    '_serialize' => array('data')
                ));
	}
        
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Review->create();
                        
                        $this->loadModel('Combination');
                        $rt = $this->Combination->read(array("reviewkey"), $this->request->data['Combination']['Combination'][0]);
                        $this->request->data['Review']['combination_reviewkey'] = $rt['Combination']['reviewkey'];
                        
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
			}
		}
		$customers = $this->Review->Customer->find('list');
		$vendors = $this->Review->Vendor->find('list');
		$combinations = $this->Review->Combination->find('list');
		$this->set(compact('customers', 'vendors', 'combinations')); 
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Review->exists($id)) {
			throw new NotFoundException(__('Invalid review'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
			$this->request->data = $this->Review->find('first', $options);
		}
		$customers = $this->Review->Customer->find('list');
		$vendors = $this->Review->Vendor->find('list');
		$combinations = $this->Review->Combination->find('list');
		$this->set(compact('customers', 'vendors', 'combinations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Review->delete()) {
			$this->Session->setFlash(__('The review has been deleted.'));
		} else {
			$this->Session->setFlash(__('The review could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Review->recursive = 0;
		$this->set('reviews', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Review->exists($id)) {
			throw new NotFoundException(__('Invalid review'));
		}
		$options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
		$this->set('review', $this->Review->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Review->create();
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
			}
		}
		$customers = $this->Review->Customer->find('list');
		$vendors = $this->Review->Vendor->find('list');
		$combinations = $this->Review->Combination->find('list');
		$this->set(compact('customers', 'vendors', 'combinations'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Review->exists($id)) {
			throw new NotFoundException(__('Invalid review'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('The review has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
			$this->request->data = $this->Review->find('first', $options);
		}
		$customers = $this->Review->Customer->find('list');
		$vendors = $this->Review->Vendor->find('list');
		$combinations = $this->Review->Combination->find('list');
		$this->set(compact('customers', 'vendors', 'combinations'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Review->delete()) {
			$this->Session->setFlash(__('The review has been deleted.'));
		} else {
			$this->Session->setFlash(__('The review could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
