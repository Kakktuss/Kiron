<?php

namespace Kiron\Http;

use Kiron\Http\Header;
use Kiron\Http\Input;
use Kiron\Http\Request;
use Kiron\Http\Router;

class Bag {
    
    public $header;
    public $input;
    public $request;
    public $router;

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
        $this->header = Header::class;
        $this->input = Input::class;
        $this->request = Request::class;
        $this->router = Router::getInstance();
    }
}
?>