<?php
/**
 * Created by PhpStorm.
 * User: genady
 * Date: 6/28/15
 * Time: 11:10 PM
 */

namespace system;


//use application\controllers\static_controllers\HomeController;
//
//use \applications\controllers\static_controllers ;



class FrontController {

    private static $instance;

    private $controller;
    private $action;
    private $_db;
    private $_session_data = array();

    private function __construct(){

        $_SESSION['session_data']= &$this->_session_data;
       $this->getAddressString();

    }

    public static function getInstance(){
        self::$instance = new self;
        return self::$instance;
    }

    public function getAddressString()
    {
        $address_string = trim($_SERVER['REQUEST_URI'], '/');
        $parametres_array = explode('/', $address_string);
        if(count($parametres_array)>1){
            if( ($_SERVER['REQUEST_URI'] != "/") && preg_match('{/$}',$_SERVER['REQUEST_URI']) ) {
                header ('Location: '.preg_replace('{/$}', '', $_SERVER['REQUEST_URI']));
            }
        }

//return var_dump($parametres_array);
        $this->controller = 'home';
        if (isset($parametres_array[0]) && $parametres_array[0]!='' ) {
            $this->controller = $parametres_array[0];
        }
//
        $this->action = 'index';
        if (isset($parametres_array[1])&& $parametres_array[1]!='') {
            $this->action = $parametres_array[1];
        }
//        setcookie('User','ghfgfgh',time()+3600);
//        if($this->controller!='home' && !isset($_COOKIE['User'])){
//            header('Location:./home');
//        }
    }
//    private function getAjaxController($controller_name){
//
//        require_once "ajax_controllers/$controller_name.php";
//
//        $class_name = "\application\controllers\ajax_controllers\\$controller_name";
//
//        return $class_name;
//    }

    private function getStaticController($controller_name)
    {

//return $controller_name;
//        if (class_exists("Applications\Modules\\".$controller_name,false)) { /*if file with class exists*/

            $class_name = "Applications\Modules\\".$controller_name; /*Controller name*/

//        } else {
//
//            $class_name = "Applications\Modules\HomeController"; /* Default controller name */
//
//
//        }
        return $class_name;
    }
//===========================================
   private function login(){

      return true;
    }
//
//========================================================

        public function route(){


if(!$this->controller|| !is_dir("../modules/$this->controller"))
     {
         $this->controller='home';
//    header ('Location: http://genady.com/home ');
     };
//            return var_dump($this->controller);
            $controller_name = ucfirst($this->controller) . 'Controller';     /*get Controller Name for make Object*/

            $action_name = $this->action . 'Action';  /*get Method Name for call it*/

  $this->_session_data['controller'] = $this->controller;

$class_name = $this->getStaticController($controller_name);
//return var_dump($class_name);
//    require_once $controller_name.'.php';
    $contr = new $class_name();


if(method_exists($contr, $action_name)) {
//    return  var_dump($action_name);
    return $contr->$action_name();
}else {

//    return $contr->indexAction();
    header ('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$this->controller/*.'/index'*/);
}


    }



}