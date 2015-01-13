<?php
App::uses('AppController', 'Controller');
/**
 * Dishfilters Controller
 *
 * @property Dishfilter $Dishfilter
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DishfiltersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        public function api_index(){
            $this->loadModel('Combination');
            $combination= $this->Combination->find('all', array(
                "conditions" => array(
//                    "DATE(Combination.date)" => date("Y-m-d")
                ),
                //"fields" => array("CombinationItem.recipe_id"),
                //"order" => 'distance ASC',
                //'limit' => 8,
                //'page' => $count
            ));
            //$str = implode("|", $combination);
            $recipes = $this->Dishfilter->find('all',array(
                'recursive'=>-1,
                'conditions' => array(
//                        'Dishfilter.recipe_name REGEXP' => $str
                    )
                )
            );
            $this->set(array(
                'data' => $recipes,
                '_serialize' => array('data')
            ));
        }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Dishfilter->recursive = 0;
		$this->set('recipes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Dishfilter->exists($id)) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		$options = array('conditions' => array('Dishfilter.' . $this->Dishfilter->primaryKey => $id));
		$this->set('recipe', $this->Dishfilter->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Dishfilter->create();
			if ($this->Dishfilter->save($this->request->data)) {
				$this->Session->setFlash(__('The recipe has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recipe could not be saved. Please, try again.'));
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
		if (!$this->Dishfilter->exists($id)) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Dishfilter->save($this->request->data)) {
				$this->Session->setFlash(__('The recipe has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recipe could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dishfilter.' . $this->Dishfilter->primaryKey => $id));
			$this->request->data = $this->Dishfilter->find('first', $options);
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
		$this->Dishfilter->id = $id;
		if (!$this->Dishfilter->exists()) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Dishfilter->delete()) {
			$this->Session->setFlash(__('The recipe has been deleted.'));
		} else {
			$this->Session->setFlash(__('The recipe could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Dishfilter->recursive = 0;
		$this->set('recipes', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Dishfilter->exists($id)) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		$options = array('conditions' => array('Dishfilter.' . $this->Dishfilter->primaryKey => $id));
		$this->set('recipe', $this->Dishfilter->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Dishfilter->create();
			if ($this->Dishfilter->save($this->request->data)) {
				$this->Session->setFlash(__('The recipe has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recipe could not be saved. Please, try again.'));
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
		if (!$this->Dishfilter->exists($id)) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Dishfilter->save($this->request->data)) {
				$this->Session->setFlash(__('The recipe has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recipe could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dishfilter.' . $this->Dishfilter->primaryKey => $id));
			$this->request->data = $this->Dishfilter->find('first', $options);
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
		$this->Dishfilter->id = $id;
		if (!$this->Dishfilter->exists()) {
			throw new NotFoundException(__('Invalid recipe'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Dishfilter->delete()) {
			$this->Session->setFlash(__('The recipe has been deleted.'));
		} else {
			$this->Session->setFlash(__('The recipe could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
