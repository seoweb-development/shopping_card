<?php
/**
 * Created by PhpStorm.
 * User: genady
 * Date: 6/6/17
 * Time: 8:43 PM
 */

namespace Applications\Modules;



use system\MainModel;

class HomeModel extends MainModel
{
 function getPageData()
{

     // TODO: Change the autogenerated stub
    $page_data = array('page'=> 'home_page');
    return $page_data;
}
}