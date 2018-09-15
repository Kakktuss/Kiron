<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07/07/2018
 * Time: 18:01
 */

namespace Kiron\Http\Datas;

use Kiron\Http\Interfaces\Session as SessionInterface;

/**
 * Class Session
 * @package Kiron\Http
 */
class Session implements SessionInterface
{

    /**
     * @param string $name
     * @return bool
     */
    public static function get($name)
    {
        if(self::isConnected() && self::paramExists())
        {
            return $_SESSION[$name];
        }
        return false;
    }

    /**
     * @param string $name
     * @param $value
     * @return bool
     */
    public static function set($name, $value) : bool
    {
        if(self::sessionActive())
        {
            $_SESSION[$name] = $value;
            return true;
        }
        return false;
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function delete($name) : bool
    {
        if(self::isConnected() && self::paramExists($name))
        {
            unset($_SESSION[$name]);
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public static function connect() : bool
    {
        if(self::sessionActive())
        {
            $_SESSION['isConnected'] = true;
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public static function disconnect() : bool
    {
        if(self::isConnected()){
            session_destroy();
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public static function sessionActive() : bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    /**
     * @return bool
     */
    public static function isConnected() : bool
    {
        if(self::sessionActive())
            return self::exists('isConnected');
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function exists($name) : bool
    {
        return key_exists($_SESSION, $name);
    }

}