<?php
App::uses('AppController', 'Controller');
/**
 * Devices Controller
 *
 * @property Device $Device
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DevicesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
        
        
        
        private function sendGoogleCloudMessage($data = array('title' => '', 'message' => ''), $diviceid = null) {
            $apiKey = "AIzaSyCdLDDJ1iT1L1x1txV8eVtY_BPWFcJ3lSc";
            $registrationIDs[] = $diviceid;
            $message = $data;
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
            return $result;
        }
        
        
        public function notify(){
            $x = $this->sendGoogleCloudMessage(array(
                'title' => "Pickmeals.com",
                'message' => 'Got it...'
            ), 'APA91bFQm2KmABW1CZPENY1K5FMl0GhRXroh6IQ8dTvsHIRe0oCpK1nksIYNUWm1JKz0gv_eDAny7XtWb3hbVl2DeYQIvqYgy-Fg6R4xBTtAu6tsdpN6kAGjWsY8ihfYM-W9AlwFXw7u');
            $this->set("result", $x);
            //$devices = $this->Device
            $d = $this->Device->find('all');
            $this->set('devices',$d);
            if($this->request->is(array('post'))){
                $d = $this->request->data;
                
            }
        }



        /**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Device->recursive = 0;
		$this->set('devices', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Device->exists($id)) {
			throw new NotFoundException(__('Invalid device'));
		}
		$options = array('conditions' => array('Device.' . $this->Device->primaryKey => $id));
		$this->set('device', $this->Device->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Device->create();
			if ($this->Device->save($this->request->data)) {
				$this->Session->setFlash(__('The device has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The device could not be saved. Please, try again.'));
			}
		}
		$customers = $this->Device->Customer->find('list');
		$this->set(compact('customers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Device->exists($id)) {
			throw new NotFoundException(__('Invalid device'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Device->save($this->request->data)) {
				$this->Session->setFlash(__('The device has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The device could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Device.' . $this->Device->primaryKey => $id));
			$this->request->data = $this->Device->find('first', $options);
		}
		$customers = $this->Device->Customer->find('list');
		$this->set(compact('customers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Device->id = $id;
		if (!$this->Device->exists()) {
			throw new NotFoundException(__('Invalid device'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Device->delete()) {
			$this->Session->setFlash(__('The device has been deleted.'));
		} else {
			$this->Session->setFlash(__('The device could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
