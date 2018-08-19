<?php

namespace Kiron\Mvc;

use Kiron\Mvc\BaseController;
use Kiron\Http\Request;

abstract class RestController extends BaseController {
    
    public function __construct($type)
    {
        if(Request::isJson())
        {
            parent::__construct($type);
        } else {

        }
    }
    
    abstract function get($data);
    
    abstract function add();
    
    abstract function edit($data);
    
    abstract function delete($data);
}

?>