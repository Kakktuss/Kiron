<?php

namespace Kiron\Http;

class Request {
    
    public static function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    
    public static function isPostRequest()
    {
        return self::getRequestMethod() === 'POST';
    }
    

    public static function isDeleteRequest()
    {
        return self::getRequestMethod() === 'DELETE';
    }
    
    public static function isGetRequest()
    {
        return self::getRequestMethod() === 'GET';
    }
    
    public static function isPatchRequest()
    {
        return self::getRequestMethod() === 'PATCH' || self::getRequestMethod() === 'PUT';
    }

    public static function getHost()
    {
        return $_SERVER['HTTP_HOST'];
    }

    public static function getConnection()
    {
        return $_SERVER['HTTP_CONNECTION'];
    }

    public static function getOrigin()
    {
        return $_SERVER['HTTP_ORIGIN'];
    }

    public static function getAccept()
    {
        return $_SERVER['HTTP_ACCEPT'];
    }

    public static function getHeaderKey($keyName)
    {
        return (isset($_SERVER['HTTP_'.$keyName])) ? $_SERVER['HTTP_'.$keyName] : false;
    }
    
    public static function getLanguage()
    {
        return $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    }
    
    public static function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
    
    public static function isJson()
    {
        return strpos('application/json', $_SERVER['HTTP_ACCEPT']) !== false;
    }
    
    public static function isHtml()
    {
        return strpos('text/html', $_SERVER['HTTP_ACCEPT']) !== false;
    }
    
}

?>