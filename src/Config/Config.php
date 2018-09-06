<?php

namespace Kiron\Config;

use Kiron\File\Driver\Ini;

/**
 * Class Config
 * @package Kiron\Config
 */
class Config
{

    /**
     * @var Ini
     */
    private $configFile;

    /**
     * @var
     */
    public static $_instance;

    /**
     * @return Config
     */
    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }

    /**
     * Config constructor.
     */
    protected function __construct()
    {
        $this->configFile = new Ini(__DIR__.'/config.ini');
    }

    /*
     *
     * Super methods
     *
     */
    /*
     * Seters
     */
    /**
     * @param $type
     * @param $db
     * @param $user
     * @param $host
     * @param $password
     */
    public function setDbInformations($type, $db, $user, $host, $password)
    {
        $this->configFile->alterKey('DB_TYPE', $type);
        $this->configFile->alterKey('DB_NAME', $db);
        $this->configFile->alterKey('DB_USER', $user);
        $this->configFile->alterKey('DB_HOST', $host);
        $this->configFile->alterKey('DB_USER_PASSWORD', $password);
    }

    /**
     * @param $root
     * @param $app
     * @param $model
     * @param $controller
     * @param $view
     * @param $lang
     * @param $html
     * @param $cache
     */
    public function setPathInformations($root, $app, $model, $controller, $view, $lang, $html, $cache)
    {
        $this->configFile->alterKey('ROOT', $root);
        $this->configFile->alterKey( 'APPLICATION_PATH', $app);
        $this->configFile->alterKey('LANG_PATH', $lang);
        $this->configFile->alterKey('MODEL_PATH', $model);
        $this->configFile->alterKey('CONTROLLER_PATH', $controller);
        $this->configFile->alterKey('VIEW_PATH', $view);
        $this->configFile->alterKey('DEFAULT_HTML_FILE', $html);
        $this->configFile->alterKey('CACHE_PATH', $cache);
    }
    /*
     * Geters
     */
    /**
     * @return array
     */
    public function getPathInformations()
    {
        return ['ApplicationPath' => $this->configFile->getKey('APPLICATION_PATH'), 'RootPath' => $this->configFile->getKey('ROOT'), 'ControllerPath' => $this->configFile->getKey('CONTROLLER_PATH'), 'ModelPath' => $this->configFile->getKey('MODEL_PATH'), 'ViewPath' => $this->configFile->getKey('VIEW_PATH'), 'LangPath' => $this->configFile->getKey('LANG_PATH'), 'DefaultHtmlFile' => $this->configFile->getKey('DEFAULT_HTML_FILE'), 'CachePath' => $this->configFile->getKey('CACHE_PATH')];
    }

    /**
     * @return array
     */
    public function getDbInformations()
    {
        return ['type' => $this->configFile->getKey('DB_TYPE'), 'name' => $this->configFile->getKey('DB_NAME'), 'host' => $this->configFile->getKey('DB_HOST'), 'user' => $this->configFile->getKey('DB_USER'), 'userPassword' => $this->configFile->getKey('DB_USER_PASSWORD')];
    }

    /*
     *
     * Methods
     *
     */
    /*
     * Seters
     */
    /*
     * Db
     */
    /**
     * @param $type
     */
    public function alterDbType($type)
    {
        $this->configFile->alterKey('DB_TYPE', $type);
    }

    /**
     * @param $name
     */
    public function alterDbName($name)
    {
        $this->configFile->alterKey('DB_NAME', $name);
    }

    /**
     * @param $user
     */
    public function alterDbUser($user)
    {
        $this->configFile->alterKey('DB_USER', $user);
    }

    /**
     * @param $host
     */
    public function alterDbHost($host)
    {
        $this->configFile->alterKey('DB_HOST', $host);
    }

    /**
     * @param $password
     */
    public function alterDbPassword($password)
    {
        $this->configFile->alterKey('DB_USER_PASSWORD', $password);
    }
    /*
     * Cache
     */
    /**
     * @param $expirationTime
     */
    public function alterCacheExpirationTime($expirationTime)
    {
        $this->configFile->alterKey('CACHE_EXPIRATION_TIME', $expirationTime);
    }
    /*
     * Cookies
     */
    /**
     * @param $expirationTime
     */
    public function alterCookieExpirationTime($expirationTime)
    {
        $this->configFile->alterKey('COOKIE_EXPIRATION_TIME', $expirationTime);
    }
    /*
     * Paths
     */
    /**
     * @param $root
     */
    public function alterRootPath($root)
    {
        $this->configFile->alterKey('ROOT', $root);
    }

    /**
     * @param $application
     */
    public function alterApplicationPath($application)
    {
        $this->configFile->alterKey('APPLICATION_PATH', $application);
    }

    /**
     * @param $lang
     */
    public function alterLangPath($lang)
    {
        $this->configFile->alterKey('LANG_PATH', $lang);
    }

    /**
     * @param $model
     */
    public function alterModelPath($model)
    {
        $this->configFile->alterKey('MODEL_PATH', $model);
    }

    /**
     * @param $controller
     */
    public function alterControllerPath($controller)
    {
        $this->configFile->alterKey('CONTROLLER_PATH', $controller);
    }

    /**
     * @param $view
     */
    public function alterViewPath($view)
    {
        $this->configFile->alterKey('VIEW_PATH', $view);
    }

    /**
     * @param $html
     */
    public function alterDefaultHtmlFile($html)
    {
        $this->configFile->alterKey('DEFAULT_HTML_FILE', $html);
    }

    /**
     * @param $application
     */
    public function alterCachePath($application)
    {
        $this->configFile->alterKey('CACHE_PATH', $cache);
    }
    /*
     * Geters
     */
    /*
     * Db
     */
    /**
     * @return bool
     */
    public function getDbType()
    {
        return $this->configFile->getKey('DB_TYPE');
    }

    /**
     * @return bool
     */
    public function getDbHost()
    {
        return $this->configFile->getKey('DB_HOST');
    }

    /**
     * @return bool
     */
    public function getDbUser()
    {
        return $this->configFile->getKey('DB_USER');
    }

    /**
     * @return bool
     */
    public function getDbPassword()
    {
        return $this->configFile->getKey('DB_USER_PASSWORD');
    }
    /*
     * Cache
     */
    /**
     * @return int
     */
    public function getCacheExpirationTime()
    {
        return intval($this->configFile->getKey('CACHE_EXPIRATION_TIME'));
    }
    /*
     * Cookies
     */
    /**
     * @return int
     */
    public function getCookieExpirationTime()
    {
        return intval($this->configFile->getKey('COOKIE_EXPIRATION_TIME'));
    }
    /*
     * Paths
     */
    /**
     * @return bool
     */
    public function getRootPath()
    {
        return $this->configFile->getKey('ROOT');
    }

    /**
     * @return bool
     */
    public function getApplicationPath()
    {
        return $this->configFile->getKey('APPLICATION_PATH');
    }

    /**
     * @return bool
     */
    public function getLangPath()
    {
        return $this->configFile->getKey('LANG_PATH');
    }

    /**
     * @return bool
     */
    public function getModelPath()
    {
        return $this->configFile->getKey('MODEL_PATH');
    }

    /**
     * @return bool
     */
    public function getCachePath()
    {
        return $this->configFile->getKey('CACHE_PATH');
    }

    /**
     * @return bool
     */
    public function getControllerPath()
    {
        return $this->configFile->getKey('CONTROLLER_PATH');
    }

    /**
     * @return bool
     */
    public function getViewPath()
    {
        return $this->configFile->getKey('VIEW_PATH');
    }

    /**
     * @return bool
     */
    public function getDefaultHtmlFile()
    {
        return $this->configFile->getKey('DEFAULT_HTML_FILE');
    }
}