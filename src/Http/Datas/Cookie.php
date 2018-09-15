<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07/07/2018
 * Time: 17:52
 */

namespace Kiron\Http\Datas;

use Kiron\Config\Config;
use Kiron\Http\Interfaces\Cookie as CookieInterface;

/**
 * Class Cookie
 * @package Kiron\Http
 */
class Cookie implements CookieInterface
{
    /**
     * @param string $name
     * @param $value
     * @param string $path
     * @param int|null $expiration
     * @param string|null $domain
     * @return bool
     */
    public static function add(string $name, $value, string $path, int $expiration = null, string $domain = null) : bool
    {
        if(!self::cookieExists($name))
        {
            setcookie($name, $value, $expiration ?? Config::getInstance()->getCookieExpirationTime(), $path, $domain);
            return true;
        }
        return false;
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function delete(string $name) : bool
    {
        if(self::cookieExists($name))
        {
            unset($_COOKIE[$name]);
            return true;
        }
        return false;
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function get(string $name)
    {
        if(self::cookieExists($name))
        {
            return $_COOKIE[$name];
        }
        return false;
    }

    /**
     * @param $name
     * @return bool
     */
    public static function cookieExists($name)
    {
        return isset($_COOKIE[$name]);
    }
}