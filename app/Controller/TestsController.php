<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property Customer $Customer Description
 * @property Combination $Combination Description
 */
class TestsController extends AppController {

	public $components = array('Paginator', 'Session');
        public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('index','mail','genpass','updatereviewkey'));
	}
	public function index() {
		$indexInfo['description'] = "App User Registration(post method)(2-d array) ";
		$indexInfo['url'] = FULL_BASE_URL.$this->webroot."api/users/registration";
		$indexInfo['parameters'] = 
                '<b>data[User][username] - </b>Username<br>
		<b>data[User][email] - </b> User email<br>
                <b>data[User][name] - </b>Name<br>
		<b>data[User][password] - </b>Password<br>
                <b>data[User][image] - </b>Image<br>
                <b>data[User][phone] - </b>Contact-No<br>
		<b>data[User][device_token] - </b>device token<br>
                <b>data[User][latitude] - </b>Latitude<br>
                <b>data[User][longitude] - </b>Longitude<br>';
                $indexarr[] = $indexInfo;
                
                
                $indexInfo['description'] = "App User Login(post method)(2-d array) ";
		$indexInfo['url'] = FULL_BASE_URL.$this->webroot."api/users/login";
		$indexInfo['parameters'] = 
                '<b>data[User][username] - </b>Username<br>
		<b>data[User][password] - </b>Password<br
		<b>data[User][device_token] - </b>device token<br>';
                $indexarr[] = $indexInfo;
                
                
                $indexInfo['description'] = "App User Update(post method)(2-d array) ";
		$indexInfo['url'] = FULL_BASE_URL.$this->webroot."api/users/edit/(user_id)";
		$indexInfo['parameters'] = 
                '<b>data[User][username] - </b>Username<br>
		<b>data[User][email] - </b> User email<br>
                <b>data[User][name] - </b>Name<br>
		<b>data[User][password] - </b>Password<br>
                <b>data[User][image] - </b>Image<br>
                <b>data[User][phone] - </b>Contact-No<br>';
                $indexarr[] = $indexInfo;
                
                $indexInfo['description'] = "App Single User Record";
		$indexInfo['url'] = FULL_BASE_URL.$this->webroot."api/users/user/(user_id)";
		$indexInfo['parameters'] = 
                '';
                $indexarr[] = $indexInfo;
                
                $indexInfo['description'] = "App All User Record";
		$indexInfo['url'] = FULL_BASE_URL.$this->webroot."api/users/alluser";
		$indexInfo['parameters'] = 
                '';
                $indexarr[] = $indexInfo;
                
                $indexInfo['description'] = "App User Forget Password(post method)(2-d array) ";
		$indexInfo['url'] = FULL_BASE_URL.$this->webroot."api/users/forgetpwd";
		$indexInfo['parameters'] = 
                '<b>data[User][email] - </b> User email<br>';
                $indexarr[] = $indexInfo;
                
                
                $indexInfo['description'] = "App User Logout";
		$indexInfo['url'] = FULL_BASE_URL.$this->webroot."api/users/logout";
		$indexInfo['parameters'] = 
                '';
                $indexarr[] = $indexInfo;
                
                $indexInfo['description'] = "App Post Add Method(Post) ";
		$indexInfo['url'] = FULL_BASE_URL.$this->webroot."api/posts/add";
		$indexInfo['parameters'] = 
                '<b>data[Post][user_id] - </b> LoggedIn user id<br>
                 <b>data[Post][shareid] - </b> 0<br>
                 <b>data[Post][posts] - </b> Post<br>
                 <b>data[Post][img] - </b> image/video<br>
                 <b>data[Post][thumbnail_video] - </b> thumbnail_video<br>
                 <b>data[Post][status] - </b> 1<br>';
                $indexarr[] = $indexInfo;
                
                $indexInfo['description'] = "App View Single Post ";
		$indexInfo['url'] = FULL_BASE_URL.$this->webroot."api/posts/view/(post_id)";
		$indexInfo['parameters'] = 
                '';
                $indexarr[] = $indexInfo;
                
                $indexInfo['description'] = "App View All Post ";
		$indexInfo['url'] = FULL_BASE_URL.$this->webroot."api/posts";
		$indexInfo['parameters'] = 
                '';
                $indexarr[] = $indexInfo;
                $indexInfo['description'] = "App Delete Post ";
		$indexInfo['url'] = FULL_BASE_URL.$this->webroot."api/posts/delete/(post_id)";
		$indexInfo['parameters'] = 
                '';
                $indexarr[] = $indexInfo;
                
                
                $this->set('IndexDetail',$indexarr);
	}
        
        public function mail(){
            App::uses("CakeEmail", "Network/Email");
            $fm = new CakeEmail('smtp');
                    $viewVars = array(
//                        "name" => $refer['User']['first_name'] . " " . $refer['User']['last_name'],
//                        "username" => $this->request->data['User']['username'],
//                        "email" => $this->request->data['User']['email'],
//                        "max_positions_limit" => $this->siteConfig['max_positions_limit']
//                      
                    );
                    $fm->to("himan.verma@live.com")
                            ->viewVars($viewVars)
                            ->from("no-reply@pickmeals.com", "PickMeals.com")
                            ->replyTo("support@pickmeals.com", "PickMeals.com")
                            ->subject("Thanks for providing us a chance to PickMeals.com")
                            //->template("referal")
                            ->emailFormat('html');
                    try {
                        $x = $fm->send();
                    } catch (SocketException $e) {
                        debug($e);
                    }
                    exit;
        }
        public function genpass(){
            //debug(AuthComponent::user());
            //exit;
            
            $this->loadModel('Customer');
            $x = $this->Customer->find('all',array('recursive' => -1));
            foreach($x as $v){
                $this->Customer->updateAll(array(
                    //'Customer.password' => "'".Security::hash($v['Customer']['id'].$v['Customer']['email'])."'"
                    'Customer.password' => "'".  AuthComponent::password('pickm')."'"
                ), array(
                    'Customer.id' => $v['Customer']['id'] 
                ));
            }
            exit;
        }
        
        public function updatereviewkey(){
            //combination_reviewkey	
            $this->loadModel('Combination');
            $x = $this->Combination->find("all");
            foreach($x as $v){
                $this->Combination->updateAll(array(
                    'Combination.reviewkey' => "'".$v['Combination']['vendor_id']."_".$v['Combination']['display_name']."'"
                ), array(
                    'Combination.id' => $v['Combination']['id']
                ));
            }
            exit;
        }
}