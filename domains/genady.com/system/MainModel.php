<?php
/**
 * Created by PhpStorm.
 * User: genady
 * Date: 6/7/17
 * Time: 12:20 AM
 */

namespace system;


 abstract class MainModel
{
    protected $_db;
    protected $_controller;
    protected $_model;
    protected $_template;
    protected $_styles;
    protected $_scripts;
    protected $_points;
    protected static $stat_db;

    function __construct(){


        $this->_db = DbProcessor::getInstance()->db_connect;
//        self::$stat_db = $this->_db;
//
        @$this->getModuleName();


        /*ajax flags */
        $headers = apache_request_headers();
        $is_ajax = (isset($headers['X-Requested-With']) && $headers['X-Requested-With'] == 'XMLHttpRequest');
        /*--------------*/
////Check if AJAX and  create Objects by the check result
            if (!$is_ajax && $this->_controller !='forms' && $this->_controller !='files') {
                $this->getPoints();
                $this->getStyles();
                $this->getScripts();
                $this->pageBuilder();
            }
    }
    protected abstract  function getPageData();


    private function getModuleName(){
        $this->_controller = $_SESSION['session_data']['controller'];
    }
    private function getTemplate(){
//        Get from DB Active Template Name ================

        /*Example*/ $template = "default";
        $this->_template = $template;

    }
    private function getPoints(){
        $url_counter = count(explode('/',trim($_SERVER['REQUEST_URI'], '/')));

        $this->_points = $url_counter==1?'..':'.';

    }

    private function getStyles(){

        $points = $this->_points;

        $styles_dir = realpath($points.'/public_html/styles/'.$this->_controller.'/');

        $dir = scandir($styles_dir);


        $general_style ='./styles/general.css';
         $styles = '';
         $styles .=  '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> ';


        $styles .= '<link rel="stylesheet" type="text/css" href="'.$general_style.'"> ';


        foreach($dir as $style){

            $inc_style_file = './styles/'.$this->_controller.'/'.$style;
            if(!strpos($style, '.css.map') && strpos($style, '.css')){

                    $styles .= '<link rel="stylesheet" type="text/css" href="' . $inc_style_file . '">';
            }
        }
        $this->_styles = $styles;
    }


    private function getScripts(){

         $points = $this->_points;


        $scripts_dir = realpath($points.'/public_html/js/'.$this->_controller);


        $dir = scandir($scripts_dir);

        $general_script = './js/general.js';

        $scripts = '<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
        $scripts.=  '<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>';
//        $scripts.=  '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
        $scripts.=  '<script src="'.$general_script.'"></script>';

//
        foreach($dir as $script){
            $inc_script_file = './js/'.$this->_controller.'/'.$script;
            if(strpos($script, '.js')){
                $scripts.= '<script src="'.$inc_script_file.'"></script>';
            }
        }
        $this->_scripts = $scripts;
    }
//    private function getUniq(){
//        $this->uniq = md5(microtime());
//    }


    private function pageBuilder(){
        $page_data = $this->getPageData();

        $layouts_templates = require_once $this->_points.'/public_html/layouts/layouts.ini.php';
        $layouts_dir = $this->_points.'/public_html/layouts/layouts_templates';
        $module_name = $this->_controller;
        $included_templates = array();
        if(isset($layouts_templates[$module_name]['header']) && is_file(realpath( $layouts_dir.$layouts_templates[$module_name]['header']) )){
            $included_templates[0] = $layouts_templates[$module_name]['header'];
            }
            else{
                $included_templates[0] = $layouts_templates['general']['header'];
            }
        if(isset($layouts_templates[$module_name]['content']) && is_file(realpath( $layouts_dir.$layouts_templates[$module_name]['content']) )){
            $included_templates[1] = $layouts_templates[$module_name]['content'];
        }
        else{
            $included_templates[1] = $layouts_templates['general']['content'];
        }
        if(isset($layouts_templates[$module_name]['footer']) && is_file(realpath( $layouts_dir.$layouts_templates[$module_name]['futer']) )){
            $included_templates[2] = $layouts_templates[$module_name]['footer'];
        }
        else{
            $included_templates[2] = $layouts_templates['general']['footer'];
        }

        ob_start('ob_gzhandler');
for($f=0;$f<count($included_templates);$f++) {
    require $included_templates[$f];
}


        return ob_flush();
    }

    public function SetCookiesModel($cookie_name, $cookie_val, $expired/*sec*/){
        /*this method giv us set cookies from javascript (ajax)*/

        if(!$cookie_name || !$cookie_val || !$expired) return 'error';

       if( setcookie($cookie_name, $cookie_val, time()+$expired, '/')) return 'aaaa';
//      return  setcookie('ddddd', '256', time()+120,'/');


    }
}