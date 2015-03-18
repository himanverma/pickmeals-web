<?php
App::uses('AppController', 'Controller');
/**
 * DeliveryBoys Controller
 *
 * @property DeliveryBoy $DeliveryBoy
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DeliveryBoysController extends AppController {

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
	public function index() {
		$this->DeliveryBoy->recursive = 0;
		$this->set('deliveryBoys', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DeliveryBoy->exists($id)) {
			throw new NotFoundException(__('Invalid delivery boy'));
		}
		$options = array('conditions' => array('DeliveryBoy.' . $this->DeliveryBoy->primaryKey => $id));
		$this->set('deliveryBoy', $this->DeliveryBoy->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DeliveryBoy->create();
			if ($this->DeliveryBoy->save($this->request->data)) {
				$this->Session->setFlash(__('The delivery boy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The delivery boy could not be saved. Please, try again.'));
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
		if (!$this->DeliveryBoy->exists($id)) {
			throw new NotFoundException(__('Invalid delivery boy'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DeliveryBoy->save($this->request->data)) {
				$this->Session->setFlash(__('The delivery boy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The delivery boy could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DeliveryBoy.' . $this->DeliveryBoy->primaryKey => $id));
			$this->request->data = $this->DeliveryBoy->find('first', $options);
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
		$this->DeliveryBoy->id = $id;
		if (!$this->DeliveryBoy->exists()) {
			throw new NotFoundException(__('Invalid delivery boy'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->DeliveryBoy->delete()) {
			$this->Session->setFlash(__('The delivery boy has been deleted.'));
		} else {
			$this->Session->setFlash(__('The delivery boy could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->DeliveryBoy->recursive = 0;
		$this->set('deliveryBoys', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->DeliveryBoy->exists($id)) {
			throw new NotFoundException(__('Invalid delivery boy'));
		}
		$options = array('conditions' => array('DeliveryBoy.' . $this->DeliveryBoy->primaryKey => $id));
		$this->set('deliveryBoy', $this->DeliveryBoy->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->DeliveryBoy->create();
			if ($this->DeliveryBoy->save($this->request->data)) {
				$this->Session->setFlash(__('The delivery boy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The delivery boy could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->DeliveryBoy->exists($id)) {
			throw new NotFoundException(__('Invalid delivery boy'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DeliveryBoy->save($this->request->data)) {
				$this->Session->setFlash(__('The delivery boy has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The delivery boy could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DeliveryBoy.' . $this->DeliveryBoy->primaryKey => $id));
			$this->request->data = $this->DeliveryBoy->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->DeliveryBoy->id = $id;
		if (!$this->DeliveryBoy->exists()) {
			throw new NotFoundException(__('Invalid delivery boy'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->DeliveryBoy->delete()) {
			$this->Session->setFlash(__('The delivery boy has been deleted.'));
		} else {
			$this->Session->setFlash(__('The delivery boy could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
