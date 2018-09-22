<?php

namespace Kiron\Database\Driver;

use Kiron\Config\Config;
use Kiron\Database\Config\Parser;
use Kiron\Database\Driver\Driver as BaseDriver;
use Kiron\Database\Builder\MySql as MySqlBuilder;

class MySql extends BaseDriver {
    
    protected $builder;
    
    public function __construct()
    {
        $config = Parser::getInstance();
        parent::__construct('mysql', $config->getDbHost(), $config->getDbName(), $config->getDbUser(), $config->getDbUserPassword());
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

