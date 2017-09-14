<?php
/**
 * Created by PhpStorm.
 * User: owner
 * Date: 05/06/2017
 * Time: 12:46
 */

namespace system\DbSettings;


class DbSettings
{
    private static $instance;
    private static $_host ='localhost';
    private static $_dbName = 'helen';
    private static $_dbPass = '1234';
    private static $_userName = 'root';


    private function __construct(){

    }

    public function getDbSettings(){
        $db_settings = array(
            'HOST'=> self::$_host,
            'DB_NAME' => self::$_dbName,
            'DB_PASS' => self::$_dbPass,
            'DB_USER' => self::$_userName

        );
        return $db_settings;
    }

    public static function getInstance(){
        if(!is_object(self::$instance)){
            self::$instance = new self;
        }
        return self::$instance;
    }
}