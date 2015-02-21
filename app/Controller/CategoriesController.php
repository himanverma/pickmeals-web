<?php

App::uses('AppController', 'Controller');

/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CategoriesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    
    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * index method
     *
     * @return void
     */
    

    public function index() {
        $this->Category->recursive = 0;
        $this->set('categories', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Invalid category'));
        }
        $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
        $this->set('category', $this->Category->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Category->create();
            $this->request->data['Category']['status'] = '1';
            
            if ($this->Category->save($this->request->data)) {
                    $this->Session->setFlash(__('The category has been saved.'));
                    return $this->redirect(array('controller'=>'categories','action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
            }
        }
        $parentCategories = $this->Category->ParentCategory->find('list');
        $parentCategories[0] = "Top Level";
        ksort($parentCategories);
        $this->set('parentCategories', $parentCategories);
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
       // Configure::write('debug', 2);
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->Category->id = $id;
        if ($this->request->is(array('post', 'put'))) {
            $this->Category->deleteAll(array('Category.id' => $id), false);
            $this->request->data['Category']['id'] = $id;
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('The category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
            $this->request->data = $this->Category->find('first', $options);
        }
        $parentCategories = $this->Category->ParentCategory->find('list');
        $parentCategories[0] = "Top Level";
        ksort($parentCategories);
        $this->set('parentCategories', $parentCategories);
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Category->id = $id;
        if (!$this->Category->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Category->delete()) {
            $this->Session->setFlash(__('The category has been deleted.'));
        } else {
            $this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    public function tree(){
        $x = $this->Category->find("threaded");
//        print_r($x);
//        Debugger::dump($x);
//        exit;
        $this->set("data", $x);
    }
}