<?php
App::uses('AppController', 'Controller');
/**
 * CombinationItems Controller
 *
 * @property CombinationItem $CombinationItem
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CombinationItemsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow(array('api_index','api_view'));
        }
        
        
/*------------------------------------------ Web-Services-Start----------------------------------------*/
        public function api_index() {
            $combinationitem = $this->CombinationItem->find('all');
            $this->set(array(
                'data' => $combinationitem,
                '_serialize' => array('data')
            ));
        }
        
        public function api_view($id = null) {
		if (!$this->CombinationItem->exists($id)) {
			throw new NotFoundException(__('Invalid CombinationItem'));
		}
		$options = array('conditions' => array('CombinationItem.' . $this->CombinationItem->primaryKey => $id));
                $this->set(array(
                    'data' => $this->CombinationItem->find('first', $options),
                    '_serialize' => array('data')
                ));
	}
        
/*------------------------------------------ Web-Services-End----------------------------------------*/     
        
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CombinationItem->recursive = 0;
		$this->set('combinationItems', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CombinationItem->exists($id)) {
			throw new NotFoundException(__('Invalid combination item'));
		}
		$options = array('conditions' => array('CombinationItem.' . $this->CombinationItem->primaryKey => $id));
		$this->set('combinationItem', $this->CombinationItem->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CombinationItem->create();
			if ($this->CombinationItem->save($this->request->data)) {
				$this->Session->setFlash(__('The combination item has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The combination item could not be saved. Please, try again.'));
			}
		}
		$combinations = $this->CombinationItem->Combination->find('list');
		$recipes = $this->CombinationItem->Recipe->find('list');
		$this->set(compact('combinations', 'recipes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CombinationItem->exists($id)) {
			throw new NotFoundException(__('Invalid combination item'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CombinationItem->save($this->request->data)) {
				$this->Session->setFlash(__('The combination item has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The combination item could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CombinationItem.' . $this->CombinationItem->primaryKey => $id));
			$this->request->data = $this->CombinationItem->find('first', $options);
		}
		$combinations = $this->CombinationItem->Combination->find('list');
		$recipes = $this->CombinationItem->Recipe->find('list');
		$this->set(compact('combinations', 'recipes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CombinationItem->id = $id;
		if (!$this->CombinationItem->exists()) {
			throw new NotFoundException(__('Invalid combination item'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CombinationItem->delete()) {
			$this->Session->setFlash(__('The combination item has been deleted.'));
		} else {
			$this->Session->setFlash(__('The combination item could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
