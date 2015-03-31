<?php

App::uses('AppController', 'Controller');

/**
 * AppVersions Controller
 *
 * @property AppVersion $AppVersion
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property Device $Device Description
 */
class AppVersionsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('api_index'));
    }

    public function api_index() {
        $d = $this->request->data;
        $this->loadModel("Device");
        if (isset($d['device_token'])) {
            $dt = $this->Device->find('first', array(
                "conditions" => array(
                    "Device.device_token" => $d['device_token']
                )
            ));
            if (empty($dt)) {
                $this->Device->create();
                $t = $this->Device->save(array(
                    "Device" => array(
                        "device_token" => $d['device_token'],
                        "customer_id" => $d['customer_id'],
                        "created_on" => time()
                    )
                ));
            } else {
                $this->Device->updateAll(array(
                    "Device.device_token" => "'" . $d['device_token'] . "'",
                    "Device.customer_id" => "'" . $d['customer_id'] . "'",
//                    "Device.created_on" => time()
                        ), array(
                    'Device.device_token' => $d['device_token']
                ));
            }
        }

        $AppVersion = $this->AppVersion->find('first');
        $this->set(array(
            'data' => $AppVersion,
            '_serialize' => array('data')
        ));
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->AppVersion->recursive = 0;
        $this->set('appVersions', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->AppVersion->exists($id)) {
            throw new NotFoundException(__('Invalid app version'));
        }
        $options = array('conditions' => array('AppVersion.' . $this->AppVersion->primaryKey => $id));
        $this->set('appVersion', $this->AppVersion->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->AppVersion->create();
            if ($this->AppVersion->save($this->request->data)) {
                $this->Session->setFlash(__('The app version has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The app version could not be saved. Please, try again.'));
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
        if (!$this->AppVersion->exists($id)) {
            throw new NotFoundException(__('Invalid app version'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->AppVersion->save($this->request->data)) {
                $this->Session->setFlash(__('The app version has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The app version could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('AppVersion.' . $this->AppVersion->primaryKey => $id));
            $this->request->data = $this->AppVersion->find('first', $options);
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
        $this->AppVersion->id = $id;
        if (!$this->AppVersion->exists()) {
            throw new NotFoundException(__('Invalid app version'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->AppVersion->delete()) {
            $this->Session->setFlash(__('The app version has been deleted.'));
        } else {
            $this->Session->setFlash(__('The app version could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->AppVersion->recursive = 0;
        $this->set('appVersions', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->AppVersion->exists($id)) {
            throw new NotFoundException(__('Invalid app version'));
        }
        $options = array('conditions' => array('AppVersion.' . $this->AppVersion->primaryKey => $id));
        $this->set('appVersion', $this->AppVersion->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('post')) {
            $this->AppVersion->create();
            if ($this->AppVersion->save($this->request->data)) {
                $this->Session->setFlash(__('The app version has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The app version could not be saved. Please, try again.'));
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
        if (!$this->AppVersion->exists($id)) {
            throw new NotFoundException(__('Invalid app version'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->AppVersion->save($this->request->data)) {
                $this->Session->setFlash(__('The app version has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The app version could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('AppVersion.' . $this->AppVersion->primaryKey => $id));
            $this->request->data = $this->AppVersion->find('first', $options);
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
        $this->AppVersion->id = $id;
        if (!$this->AppVersion->exists()) {
            throw new NotFoundException(__('Invalid app version'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->AppVersion->delete()) {
            $this->Session->setFlash(__('The app version has been deleted.'));
        } else {
            $this->Session->setFlash(__('The app version could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
