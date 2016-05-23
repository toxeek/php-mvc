<?php
/*
 * shared.php -
 */

function setEnvr() {
if (DEVELOPMENT_ENVIRONMENT == true) {
        error_reporting(E_ALL|E_STRICT);
        ini_set('display_errors','On');
} else {
        error_reporting(E_ALL);
        ini_set('display_errors','Off');
        ini_set('log_errors', 'On');
        // ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
}
}
include_once(ROOT.DS."library".DS."uploader.class.php");

function init() {
    global $url;
    global $page_str;

    $urlArray = array();
    $urlArray = explode("/",$url);

    $controller = $urlArray[0];
    array_shift($urlArray);
    $action = $urlArray[0];
    if (isset($action) && !empty($action)) {
        if (trim($action) == 'insert') {
            $page_str = 'Add edges';
        }
        elseif (trim($action) == 'delete') {
            $page_str = 'Delete edges';
        }
        else {
            $page_str = htmlentities($action);
        }
    }
    array_shift($urlArray);
    if (isset($urlArray[0]))
        $queryString = $urlArray;

    $controllerName = $controller;
    $controller = ucwords($controller);

    $model = $controller;
    $controller .= 'Controller';
    $dispatch = new $controller($model,$controllerName,$action);

    if ((int)method_exists($controller, $action)) {
        if (isset($queryString)) {
            call_user_func_array(array($dispatch,$action),$queryString);
        }
        else {
            call_user_func(array($dispatch,$action));
        }
    } else {
            header('Location: http://nagios01.priv.yospace.net/add_edge/add');
    }


}

function __autoload($className) {
        if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
                require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
        } else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
                require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
        } else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
                require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
        }

        else {
            if (DEVELOPMENT_ENVIRONMENT === true) {
                header('Location: http://nagios01.priv.yospace.net/add_edge/autoload_class_error');
            }
            else {
                echo "HTTP/1.1 400 Bad Request";
            }
        }

} 

setEnvr();
init();
