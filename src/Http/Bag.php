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
    
    public function __construct()
    {
        $this->header = new Header();
        $this->input = new Input();
        $this->request = new Request();
        $this->router = new Router();
    }
    
}

?>