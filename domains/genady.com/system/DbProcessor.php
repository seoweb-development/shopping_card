<?php
/**
 * Created by PhpStorm.
 * User: owner
 * Date: 05/06/2017
 * Time: 12:47
 */

namespace System;


class DbProcessor
{
    private static $_instance;
    public $db_connect;
    private function __construct()
    {
//
    }
    public function __get($name)
    {
        // TODO: Implement __get() method.
    }
    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
    }

    private function getDb(){
         return new \PDO(
             "mysql:host=localhost;dbname=genady_db",
             'genady_db',
             'genady'

             );
    }
    public static function getInstance(){
        if((self::$_instance  instanceof self)!= true){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}