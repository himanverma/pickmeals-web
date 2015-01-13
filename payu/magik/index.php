<?php

/**
 * @author Himanshu Verma
 * @param type $dishUrl
 * @return string
 */

ini_set("max_execution_time", -1);


function createBowl($dishUrl = null, $w = 140, $h = 0) {
    $du = explode("/", $dishUrl);
    $du = explode(".", $du[count($du)-1]);
    $uri = $du[count($du)-2];
    
    $bowl = new Imagick("img/bowl.png");
    $mask = new Imagick("img/mask.png");
    $dish = new Imagick($dishUrl);
    $dish->scaleimage($bowl->getimagewidth(), $bowl->getimageheight()); // Set As per bowl image
    
    $dish->compositeimage(new Imagick("img/mask.png"), \Imagick::COMPOSITE_COPYOPACITY, 0, 0, Imagick::CHANNEL_ALPHA);
    $dish->mergeimagelayers(Imagick::LAYERMETHOD_COALESCE);

    $bowl->compositeimage($dish, \Imagick::COMPOSITE_ATOP, 0, 0, Imagick::CHANNEL_ALPHA);
    $bowl->mergeimagelayers(Imagick::LAYERMETHOD_COALESCE);

    $bowl->setimageformat("jpg");
    $bowl->setImageFileName($url = "gen/" . $uri . ".jpg");
//    $bowl->setinterlacescheme(\Imagick::INTERLACE_PNG);
    $bowl->scaleimage($w, $h);
    $bowl->writeimage();
    $bowl->destroy();
    return $url;
}

$dishes = array(
    "paneer-makhanwala.jpg",
    "paneer.jpg",
    "paneer-do-pyaza.jpg",
    "bhindi-fried.jpg",
    "dal-makhani.jpg"
);
foreach ($dishes as $v) {
    $d = createBowl("dishes/" . $v );
    //echo $d;
    echo '<img align="left" src="' . $d . '" />';
}
?>