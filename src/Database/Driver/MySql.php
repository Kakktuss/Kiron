<?php

namespace Kiron\Database\Driver;

use Kiron\Config\Config;
use Kiron\Database\Driver\Driver as BaseDriver;
use Kiron\Database\Builder\MySql as MySqlBuilder;

class MySql extends BaseDriver {
    
    protected $builder;
    
    public function __construct()
    {   
        parent::__construct('mysql', Config::getInstance()->getDbInformations()['host'], Config::getInstance()->getDbInformations()['name'], Config::getInstance()->getDbInformations()['user'], Config::getInstance()->getDbInformations()['userPassword']);
    }
    
    public function pushBuilderToGlobal()
    {
        $GLOBALS['mySqlDbBuilder'] = $this->getBuilder();
    }
    
    public function pushDatabaseToGlobal()
    {
        $GLOBALS['mySqlDatabase'] = $this->getDatabase();
    }
    
    public function getBuilder() : MySqlBuilder {
        
        if(!isset($this->builder))
        {
            $this->builder = new MySqlBuilder($this->getDatabase());
        }
        
        return $this->builder;
    }

}
?>

