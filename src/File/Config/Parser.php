<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18/09/2018
 * Time: 19:14
 */

namespace Kiron\File\Config;

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

    public function getRootPath()
    {
        return $this->file->getKey('ROOT_PATH');
    }

    public function setRootPath($path)
    {
        $this->file->alterKey('ROOT_PATH', $path);
    }

    public function getApplicationPath()
    {
        return $this->file->getKey('APPLICATION_PATH');
    }

    public function setApplicationPath($path)
    {
        $this->file->alterKey('APPLICATION_PATH', $path);
    }

    public function getLangPath()
    {
        return $this->file->getKey('LANG_PATH');
    }

    public function setLangPath($path)
    {
        $this->file->alterKey('LANG_PATH', $path);
    }

    public function getCachePath()
    {
        return $this->file->getKey('CACHE_PATH');
    }

    public function setCachePath($path)
    {
        $this->file->alterKey('CACHE_PATH', $path);
    }

}