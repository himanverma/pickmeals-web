<?php

App::uses('AppController', 'Controller');

/**
 * SendNotifications Controller
 *
 * @property SendNotification $SendNotification
 * @property Customer $Customer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SendNotificationsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('sendGoogleCloudMessage'));
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->SendNotification->recursive = 0;
        $this->set('sendNotifications', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->SendNotification->exists($id)) {
            throw new NotFoundException(__('Invalid send notification'));
        }
        $options = array('conditions' => array('SendNotification.' . $this->SendNotification->primaryKey => $id));
        $this->set('sendNotification', $this->SendNotification->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        Configure::write('debug', 2);
        if ($this->request->is('post')) {
            $this->SendNotification->create();
            if ($this->SendNotification->save($this->request->data)) {
                $this->loadModel('Customer');
                $devicetoken = $this->Customer->find('list', array(
                    'recursive' => -1,
                    'fields' => array('device_token')
                        )
                );
//                                debug($devicetoken);exit;
                $devicetoken = "APA91bGEDtBFip-NXxDiIge6INYRflZJj-4M02IRFB1u9dfmde-tRi4RlK_WkNaN6Ybh2WYtwzU96dGENKQbmADwOZAVW5ouZOlQ7HWMiaKEj0iEqkGZ6Zc2wyIqgYLR5rX6IxzRK85T3eeGzKvpCA54rUmOCbAwuw";
                $record = $this->sendGoogleCloudMessage(
                        $this->request->data['SendNotification']['message'], $devicetoken
                );

                $this->Session->setFlash(__('The send notification has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The send notification could not be saved. Please, try again.'));
            }
        }
    }

    public function sendGoogleCloudMessage($message = null, $diviceid = null) {
        $apiKey = "AIzaSyC6wrulbEusWoqm5m4e4siK8Gzw_YNDZFY";
        configure::write('debug', 2);
        $registrationIDs[] = $diviceid;

        $message = array("price" => $message);
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registrationIDs,
            'data' => $message,
        );
        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        debug($result);

        return $result;
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->SendNotification->exists($id)) {
            throw new NotFoundException(__('Invalid send notification'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->SendNotification->save($this->request->data)) {
                $this->Session->setFlash(__('The send notification has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The send notification could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('SendNotification.' . $this->SendNotification->primaryKey => $id));
            $this->request->data = $this->SendNotification->find('first', $options);
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
        $this->SendNotification->id = $id;
        if (!$this->SendNotification->exists()) {
            throw new NotFoundException(__('Invalid send notification'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->SendNotification->delete()) {
            $this->Session->setFlash(__('The send notification has been deleted.'));
        } else {
            $this->Session->setFlash(__('The send notification could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
