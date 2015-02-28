<?php
App::uses('AppModel', 'Model');
/**
 * Splash Model
 */
class Splash extends AppModel {
    
    var $useTable = "splashs";
    
    
    public function beforeSave($options=array()){
            App::uses("HtmlHelper", "View/Helper");
            $html = new HtmlHelper(new View());
            if(!empty($this->data[$this->alias]['file']['name'])){
                
                $this->data[$this->alias]['type'] = $this->data[$this->alias]['file']['type'];
                $this->data[$this->alias]['movefile'] = $this->data[$this->alias]['file'];
                $ext=pathinfo($this->data[$this->alias]['file']['name'], PATHINFO_EXTENSION);
                $image_name = date('YmdHis').rand(1,999) . "." . $ext;
                $this->data[$this->alias]['file'] =$html->url("/files/splash/".$image_name,true);
                $this->data[$this->alias]['movefile']['name'] = $image_name;
            }
            parent::beforeSave($options);
            return true;
        }
        
        
        public function afterSave($created, $options = array()) {
            parent::afterSave($created, $options);
            if(!empty($this->data[$this->alias]['movefile'])){
                $path=$this->data[$this->alias]['movefile']['tmp_name'];
                $destination="files/splash/".$this->data[$this->alias]['movefile']['name'];
                move_uploaded_file($path,$destination);
            }
        }
        public function delete($id = null, $cascade = true) {
            if ($id == null) {
                $id = $this->id;
            }
            $path = $this->read(array('file'), $id);
            $unlink=explode('files/',$path[$this->alias]['file']);
            unlink('files/'.$unlink[1]);
            parent::delete($id, $cascade);
        }

}
