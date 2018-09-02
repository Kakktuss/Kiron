<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 16/07/2018
 * Time: 17:55
 */

namespace Kiron\Config;

use Kiron\File\Ini;

class Config
{

    private $configFile;

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
        $this->configFile = new Ini(__DIR__.'/config.ini');
    }

    public function setDbInformations($type, $db, $user, $host, $password)
    {
        $this->configFile->alterKey('DB_TYPE', $type);
        $this->configFile->alterKey('DB_NAME', $db);
        $this->configFile->alterKey('DB_USER', $user);
        $this->configFile->alterKey('DB_HOST', $host);
        $this->configFile->alterKey('DB_USER_PASSWORD', $password);
    }

    public function getDbInformations()
    {
        return ['type' => $this->configFile->getKey('DB_TYPE'), 'name' => $this->configFile->getKey('DB_NAME'), 'host' => $this->configFile->getKey('DB_HOST'), 'user' => $this->configFile->getKey('DB_USER'), 'userPassword' => $this->configFile->getKey('DB_USER_PASSWORD')];
    }

    public function setCacheExpirationTime($expirationTime)
    {
        $this->configFile->alterKey('CACHE_EXPIRATION_TIME', $expirationTime);
    }

    public function getCacheExpirationTime()
    {
        return intval($this->configFile->getKey('CACHE_EXPIRATION_TIME'));
    }

    public function setCookieExpirationTime($expirationTime)
    {
        $this->configFile->alterKey('COOKIE_EXPIRATION_TIME', $expirationTime);
    }

    public function getCookieExpirationTime()
    {
        return intval($this->configFile->getKey('COOKIE_EXPIRATION_TIME'));
    }

    public function setPathInformations($root, $app, $model, $controller, $view, $lang, $html)
    {
        $this->configFile->alterKey('ROOT', $root);
        $this->configFile->alterKey( 'APPLICATION_PATH', $app);
        $this->configFile->alterKey('LANG_PATH', $lang);
        $this->configFile->alterKey('MODEL_PATH', $model);
        $this->configFile->alterKey('CONTROLLER_PATH', $controller);
        $this->configFile->alterKey('VIEW_PATH', $view);
        $this->configFile->alterKey('DEFAULT_HTML_FILE', $html);
    }

    public function getPathInformations()
    {
        return ['ApplicationPath' => $this->configFile->getKey('APPLICATION_PATH'), 'RootPath' => $this->configFile->getKey('ROOT'), 'ControllerPath' => $this->configFile->getKey('CONTROLLER_PATH'), 'ModelPath' => $this->configFile->getKey('MODEL_PATH'), 'ViewPath' => $this->configFile->getKey('VIEW_PATH'), 'LangPath' => $this->configFile->getKey('LANG_PATH'), 'DefaultHtmlFile' => $this->configFile->getKey('DEFAULT_HTML_FILE')];
    }
}