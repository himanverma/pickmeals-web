<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppExceptionHandler
 *
 * @author admin
 */
class AppExceptionHandler {
    public static function handle($error) {
        echo 'Oh noes! ' . $error->getMessage();
        exit;
    }
}
