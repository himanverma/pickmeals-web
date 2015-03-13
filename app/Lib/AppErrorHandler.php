<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppErrorHandler
 *
 * @author admin
 */
class AppErrorHandler {
    public static function handleException($error) {
        if ($error instanceof MissingWidgetException) {
            return self::handleMissingWidget($error);
        }
        // do other stuff.
    }
}