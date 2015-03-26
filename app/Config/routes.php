<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
        Router::connect('/adminAuth', array('controller' => 'Dashboard', 'action' => 'sdkfix'));
        Router::connect('/chef/*', array('controller' => 'Webapp', 'action' => 'chef')); 
        Router::connect('/reviews/*', array('controller' => 'Webapp', 'action' => 'reviews'));
        Router::connect('/checkout', array('controller' => 'Webapp', 'action' => 'checkout')); 
        Router::connect('/myaccount', array('controller' => 'Webapp', 'action' => 'myaccount'));
        Router::connect('/logout', array('controller' => 'Webapp', 'action' => 'logout'));
        
        
        Router::connect('/about-us', array('controller' => 'Webapp', 'action' => 'aboutus')); 
        Router::connect('/contact-us', array('controller' => 'Webapp', 'action' => 'contactus'));
        Router::connect('/faq', array('controller' => 'Webapp', 'action' => 'faq'));
        Router::connect('/press', array('controller' => 'Webapp', 'action' => 'press'));
        Router::connect('/privacy-policy', array('controller' => 'Webapp', 'action' => 'privacy'));
        Router::connect('/terms-and-conditions', array('controller' => 'Webapp', 'action' => 'terms'));
        
        Router::connect('/forgot-password', array('controller' => 'Webapp', 'action' => 'forgot_password'));
//        Router::connect('/reset-password', array('controller' => 'Webapp', 'action' => 'reset_password'));
        Router::connect('/change-password', array('controller' => 'Webapp', 'action' => 'change_password'));
//        Router::connect('/pay-online', array('controller' => 'Webapp', 'action' => 'payments'));
        Router::connect('/feedback', array('controller' => 'Webapp', 'action' => 'feedback'));
        
        
        
	//Router::connect('/', array('controller' => 'pages', 'action' => 'login'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
        
        
        /**
         * Chef Router 
         */
        App::uses("Vendor", "Model");
        $vendorModel = new Vendor();
        $vendors = $vendorModel->find("all",array(
            "contain" => false
        ));
        foreach($vendors as $v){
            $slug = strtolower($v['Vendor']['name']);
            $slug = str_replace(" ", "-", $slug);
            Router::connect('/'.$slug, array('controller' => 'Webapp', 'action' => 'chef',$slug));
//            echo $slug."\n";
        }
//        exit;
        
        
        
       
        Router::connect('/', array('controller' => 'Webapp', 'action' => 'home'));
        Router::connect('/dev', array('controller' => 'Webapp', 'action' => 'dev'));
        
        Router::mapResources('vendors');
        Router::parseExtensions();
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
