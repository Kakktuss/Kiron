<?php

namespace Kiron\Database\Driver;

use Kiron\Database\Driver\Driver as BaseDriver;

class Register {
    
    public static $_instance;
    
    private $drivers = [];
    
    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new Register();
        }
        
        return self::$_instance;
    }
    
    public function registerDriver(string $name, BaseDriver $driver)
    {
        if(!$this->driverExists($name))
        {
            $this->drivers[$name] = $driver;
        }
    }
    
    public function unregisterDriver(string $name) {
        if($this->driverExists($name))
        {
            unset($this->drivers[$name]);
        }
    }
    
    public function getDriver($name)
    {
        if($this->driverExists($name))
        {
            return $this->drivers[$name];
        }
        return false;
    }
    
    private function driverExists(string $name)
    {
        return isset($this->drivers[$name]);
    }
    
}

?>