<?php
/**
 * Created by PhpStorm.
 * User: genady
 * Date: 6/6/17
 * Time: 10:28 PM
 */

namespace System\MainController;


 abstract class MainController
{
    protected $_db;
    protected $_model;
    protected static $stat_model;
    protected $_action;
    protected $_settings;
    protected $_user_data;


    function __construct(){
//        return var_dump($_SESSION['session_data']['controller']);
        /*ajax flags */
        $headers = apache_request_headers();
        $is_ajax = (isset($headers['X-Requested-With']) && $headers['X-Requested-With'] == 'XMLHttpRequest');
        if(!$is_ajax) {
            if (!isset($_COOKIE['__feer']) && $_SESSION['session_data']['controller'] != 'home'/*&& $_SESSION['session_data']['controller'] != 'forms'*/) {
                header('Location: http:'.$_SERVER['HTTP_HOST']);
            }
        }
        $this->getDb();
        $this->getModel();

    }
//     function indexAction();

    private function getSettings(){
//        require_once "settings.php";
    }

    private function getDb(){
//        require_once "MySqlHelper.php";
//    $helper = \application\libraries\my_sql\MySqlHelper::getInstance();
//
//        $this->_db = $helper->PDO_get();
    }
    private function getModel(){
        $mod = ucfirst($_SESSION['session_data']['controller']).'Model';
//return var_dump($mod);
        $file = 'applications/modules/'.$_SESSION['session_data']['controller'].'/src/'.$mod.'.php';

//        return var_dump($file);
        if(!is_file($file)){
            $mod = 'HomeModel';

        }

//        require_once $mod.'.php';

        $called_model = "Applications\Modules\\$mod";
//        return var_dump($called_model);
        require_once $mod.'.php';
        $this->_model = new $called_model();
    }
}