<?php

namespace Kiron\Database\Driver;

use \PDO;
use Kiron\Config\Config;
use Kiron\Database\Builder\Builder as BaseBuilder;
use Kiron\Database\Interfaces\Driver as DriverInterface;
use Kiron\Database\Exception\Driver as DriverException;

abstract class Driver implements DriverInterface {
    
    protected $database;
    
    protected $dbConfigParams;
    
    private $dbType;
    
    private $host;
    
    private $dbName;
    
    private $dbUser;
    
    private $dbUserPassword;
    
    public function __construct(string $dbType, string $host, string $dbName, string $dbUser, string $dbUserPassword)
    {
        $this->dbConfigParams = Config::getInstance()->getDbInformations();
        $this->dbType = $dbType;
        $this->host = $host;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbUserPassword = $dbUserPassword;
    }
    
    public function getDatabase() : PDO {
        if(!isset($this->database))
        {
            try {
                $this->database = new PDO($this->dbType.':host='.$this->host.';dbname='.$this->dbName, $this->dbUser, $this->dbUserPassword);
            } catch(\PDOException $e)
            {
                throw new DriverException('[Kiron:Database => Driver\BaseDriver: getDatabase] Error while connecting to '.$this->dbType.' database'."\n".'More information from PDOException: '.$e, 500);
            }
        }
        return $this->database;
    }
    
    abstract public function getBuilder();    
}

?>