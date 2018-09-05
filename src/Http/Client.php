<?php

namespace Kiron\Http;

class Client {

    public $httpBag;

    public function __construct()
    {
        $this->httpBag = Bag::getInstance();
    }

    

}

?>