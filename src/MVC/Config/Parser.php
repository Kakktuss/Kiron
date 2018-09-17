<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17/09/2018
 * Time: 17:47
 */

namespace Kiron\Mvc\Config;

use Kiron\File\Driver\Ini;

class Parser
{

    private $file;

    public static $_instance;

    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }

    protected function __construct()
    {
        $this->file = new Ini(__DIR__.'/config.ini');
    }

    public function getModelPath()
    {
        return $this->file->getKey('MODEL_PATH');
    }

    public function getControllerPath()
    {
        return $this->file->getKey('CONTROLLER_PATH');
    }

    public function getViewPath()
    {
        return $this->file->getKey('VIEW_PATH');
    }

    public function getDefaultView()
    {
        return $this->file->getKey('DEFAULT_VIEW');
    }

}