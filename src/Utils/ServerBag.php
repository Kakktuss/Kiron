<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14/09/2018
 * Time: 18:00
 */

namespace Kiron\Utils;

use Kiron\Bags\String as StringBag;

class ServerBag extends StringBag
{
    public static $_instance;

    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new Bag();
        }
        return self::$_instance;
    }

    protected function __construct()
    {
        $this->sets([
            'root' => $_SERVER['DOCUMENT_ROOT'],
            'uri' => $_SERVER['REQUEST_URI'],
            'protocol' => $_SERVER['SERVER_PROTOCOL']
        ]);
    }

}