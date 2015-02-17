<?php

App::uses('AppModel', 'Model');

/**
 * Recipe Model
 *
 * @property CombinationItem $CombinationItem
 * @property MealMenu $MealMenu
 */
class Recipe extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'recipe_name';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'recipe_name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'description' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'also_known_as' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'CombinationItem' => array(
            'className' => 'CombinationItem',
            'foreignKey' => 'recipe_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'MealMenu' => array(
            'className' => 'MealMenu',
            'foreignKey' => 'recipe_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public function delete($id = null, $cascade = true) {
        if ($id == null) {
            $id = $this->id;
        }
        $path = $this->read(array('image'), $id);
        $vale = explode('ofood/', $path['Recipe']['image']);
        unlink($vale[1]);
        parent::delete($id, $cascade);
    }

    public function beforeSave($options = array()) {
        Configure::write('debug', 2);
        App::uses("HtmlHelper", "View/Helper");
        $html = new HtmlHelper(new View());
        if ($this->data[$this->alias]['image']['name'] != "") {
            $ext = pathinfo($this->data[$this->alias]['image']['name'], PATHINFO_EXTENSION);
            $image_name = date('YmdHis') . rand(1, 999) . "." . $ext;
            $destination = "files/recipe_images/" . $image_name;
            if(move_uploaded_file($this->data[$this->alias]['image']['tmp_name'], $destination)){
                $bowl = $this->createBowl($destination);
                $tmp = explode("/", $bowl);
                $destination2 = "files/recipe_images/" . $tmp[1];
                //unlink($destination);
                rename($destination, $dt = "files/recipe_images/ori/" . $tmp[1]);
                rename($bowl, $destination2);
                
            }
            $this->data[$this->alias]['image'] = $html->url("/".$dt, true);
            $this->data[$this->alias]['image_bowl'] = $html->url("/".$destination2, true);
        }else{
            unset($this->data[$this->alias]['image']);
        }
        parent::beforeSave($options);
        return true;
    }

    /**
     * 
     * @param string $dishUrl
     * @param int $w Width of the Output Image
     * @param int $h Height of Output Image
     * @return string Path of genrated Image
     */
    public function createBowl($dishUrl = null, $w = 140, $h = 0) {

        $bowl = new Imagick("tmpl/img/bowl.png");
        $mask = new Imagick("tmpl/img/mask.png");
        $dish = new Imagick($dishUrl);
        $dish->scaleimage($bowl->getimagewidth(), $bowl->getimageheight()); // Set As per bowl image

        $dish->compositeimage(new Imagick("tmpl/img/mask.png"), \Imagick::COMPOSITE_COPYOPACITY, 0, 0, Imagick::CHANNEL_ALPHA);
        $dish->mergeimagelayers(Imagick::LAYERMETHOD_COALESCE);

        $bowl->compositeimage($dish, \Imagick::COMPOSITE_ATOP, 0, 0, Imagick::CHANNEL_ALPHA);
        $bowl->mergeimagelayers(Imagick::LAYERMETHOD_COALESCE);

        $bowl->setimageformat("jpg");
        $bowl->setImageFileName($url = "img_tmp/" . $this->randomString(10) . "-GE.jpg");
//    $bowl->setinterlacescheme(\Imagick::INTERLACE_PNG);
        $bowl->scaleimage($w, $h);
        $bowl->writeimage();
        $bowl->destroy();
        return $url;
    }

}
