<?php

namespace Kiron\Mvc;

use Kiron\Mvc\BaseController;

abstract class RestController extends BaseController {
    
    public function __construct($type)
    {
        parent::__construct($type);
    }
    
    abstract function get($data);
    
    abstract function add();
    
    abstract function edit($data);
    
    abstract function delete($data);
}

?>