<?php
///**
// * Created by PhpStorm.
// * User: genady
// * Date: 6/28/15
// * Time: 10:45 PM
// */
//phpinfo();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
//Genady commit check =================================
set_include_path(get_include_path().
    PATH_SEPARATOR.'applications'.
    PATH_SEPARATOR.'../modules/home/src'.
    PATH_SEPARATOR.'applications/modules/forms/src'.
    PATH_SEPARATOR.'applications/modules/users/src'.
    PATH_SEPARATOR.'applications/modules/accounts/src'.
    PATH_SEPARATOR.'applications/modules/orders/src'.
    PATH_SEPARATOR.'applications/modules/files/src'.
    PATH_SEPARATOR.'../public_html/templates'.
    PATH_SEPARATOR.'../public_html'.
    PATH_SEPARATOR.'../public_html/styles'.
    PATH_SEPARATOR.'../system'.
    PATH_SEPARATOR.'../public_html/layouts'.
    PATH_SEPARATOR.'../public_html/layouts/layouts_templates'.
    PATH_SEPARATOR.'../public_html/layouts/layouts_templates/general'.
    PATH_SEPARATOR.'applications/modules/templates');


function __autoload($class_name){
    $pattern = '/([a-z]+)$/i';
     preg_match($pattern,$class_name, $matches);

    $class_name = $matches[count($matches)-1];
//return var_dump($matches);
//    $class_name = substr($class_name, strrpos(NAMESPACE_SEPARATOR ));
//    if($class_name != "FrontController") {
        require_once $class_name.'.php';
//    }else{
//        require_once 'system/FrontController.php';
//    }
}


//
//require_once 'system/FrontController.php';
$front = \system\FrontController::getInstance();

//echo( $front->getAddressString());
echo( $front->route());

