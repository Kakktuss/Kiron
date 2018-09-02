<?php

namespace Kiron\Database\Driver;

use Kiron\Config\Config;

abstract class AbstractDriver {
    
    protected $database;
    
    protected $dbConfigParams;
    
    public function __construct()
    {
        $this->dbConfigParams = Config::getInstance()->getDbInformations();
    }
    
    abstract public function getDatabase() : \PDO;
    
    abstract public function getBuilder();
    
}

?>