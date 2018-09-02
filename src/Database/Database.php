<?php

namespace Kiron\Database;

use Kiron\Config\Config;
use Kiron\Database\Driver\Register as DriverRegister;
use Kiron\Database\Driver\MySql as MySqlDriver;
use Kiron\Database\Driver\PgSql as PgSqlDriver;

class Database {
    
    protected $driver;
    
    public static $_instance;
    
    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new Database();
        }
        
        return self::$_instance;
    }
    
    protected function __construct()
    {
        $register = DriverRegister::getInstance();
        $register->registerDriver('mysql', new MySqlDriver());
        $register->registerDriver('pgsql', new PgSqlDriver());
        $this->driver = $register->getDriver(Config::getInstance()->getDbInformations()['type']);
    }
    
    public function getDriver()
    {
        return $this->driver;
    }
}

?>