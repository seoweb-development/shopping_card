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
        $this->db_connect = $this->getDb();
    }
    private function getDb(){
         return new \PDO(
             "mysql:host=localhost;dbname=helen_new",
             'root',
             '1234'

             );
    }
    public static function getInstance(){
        if((self::$_instance  instanceof self)!= true){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}