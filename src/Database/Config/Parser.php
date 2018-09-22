<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18/09/2018
 * Time: 19:14
 */

namespace Kiron\Database\Config;

use Kiron\File\Driver\Ini;

class Parser
{

    private $file;

    public static $_instance;

    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new Parser();
        }
        return self::$_instance;
    }

    protected function __construct()
    {
        $this->file = new Ini(__DIR__.'/config.ini');
    }

    public function getDbType()
    {
        return $this->file->getKey('DB_TYPE');
    }

    public function setDbType($type)
    {
        $this->file->alterKey('DB_TYPE', $type);
    }

    public function getDbUser()
    {
        return $this->file->getKey('DB_USER');
    }

    public function setDbUser($user)
    {
        $this->file->alterKey('DB_USER', $user);
    }

    public function getDbHost()
    {
        return $this->file->getKey('DB_HOST');
    }

    public function setDbHost($host)
    {
        $this->file->alterKey('DB_HOST', $host);
    }

    public function getDbUserPassword()
    {
        return $this->file->getKey('DB_USER_PASSWORD');
    }

    public function setDbUserPassword($password)
    {
        $this->file->alterKey('DB_USER_PASSWORD', $password);
    }

    public function getDbName()
    {
        return $this->file->getKey('DB_NAME');
    }

    public function setDbName($name)
    {
        $this->file->alterKey('DB_NAME', $name);
    }

}