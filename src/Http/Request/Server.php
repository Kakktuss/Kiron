<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 13/09/2018
 * Time: 07:11
 */

namespace Kiron\Http\Request;


class Server
{

    public static $_instance;

    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new Server();
        }
        return self::$_instance;
    }

    protected function __construct()
    {


        
    }

}