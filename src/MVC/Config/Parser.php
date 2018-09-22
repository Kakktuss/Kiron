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
            self::$_instance = new Parser();
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

    public function setModelPath($path)
    {
        $this->file->alterKey('MODEL_PATH', $path);
    }

    public function getControllerPath()
    {
        return $this->file->getKey('CONTROLLER_PATH');
    }

    public function setControllerPath($path)
    {
        $this->file->alterKey('CONTROLLER_PATH', $path);
    }

    public function getViewPath()
    {
        return $this->file->getKey('VIEW_PATH');
    }

    public function setViewPath($path)
    {
        $this->file->alterKey('VIEW_PATH', $path);
    }

    public function getDefaultView()
    {
        return $this->file->getKey('DEFAULT_VIEW');
    }

    public function setDefaultView($view)
    {
        $this->file->alterKey('DEFAULT_VIEW', $view);
    }

}