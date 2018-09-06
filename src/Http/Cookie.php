<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07/07/2018
 * Time: 17:52
 */

namespace Kiron\Http;

use Kiron\Config\Config;

class Cookie
{
    public static function addCookie($name, $value, $path, $expiration = null)
    {
        if(!self::cookieExists($name))
        {
            $expTime = $expiration ?? Config::getInstance()->getCookieExpirationTime();
            echo $expTime;
            var_dump(setcookie($name, $value, time()+$expTime, $path));
        }
    }

    public static function deleteCookie($name)
    {
        unset($_COOKIE[$name]);
    }

    public static function getCookie($name)
    {
        if(self::cookieExists($name))
        {
            return $_COOKIE[$name];
        }
    }

    public static function cookieExists($name)
    {
        if(key_exists($name, $_COOKIE))
            return true;
        return false;
    }
}