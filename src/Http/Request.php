<?php

namespace Kiron\Http;

class Request {

    /**
     * @return mixed
     */
    public static function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return bool
     */
    public static function isPostRequest()
    {
        return self::getRequestMethod() === 'POST';
    }


    /**
     * @return bool
     */
    public static function isDeleteRequest()
    {
        return self::getRequestMethod() === 'DELETE';
    }

    /**
     * @return bool
     */
    public static function isGetRequest()
    {
        return self::getRequestMethod() === 'GET';
    }

    /**
     * @return bool
     */
    public static function isPatchRequest()
    {
        return self::getRequestMethod() === 'PATCH' || self::getRequestMethod() === 'PUT';
    }

    public static function getRoot()
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    /**
     * @return mixed
     */
    public static function getHost()
    {
        return $_SERVER['HTTP_HOST'];
    }

    /**
     * @return mixed
     */
    public static function getConnection()
    {
        return $_SERVER['HTTP_CONNECTION'];
    }

    /**
     * @return mixed
     */
    public static function getAccept()
    {
        return $_SERVER['HTTP_ACCEPT'];
    }

    /**
     * @return mixed
     */
    public static function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @param $keyName
     * @return bool
     */
    public static function getHeaderKey($keyName)
    {
        return $_SERVER['HTTP_'.$keyName] ?? null;
    }

    /**
     * @return mixed
     */
    public static function getLanguage()
    {
        return $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    }

    /**
     * @return mixed
     */
    public static function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * @return bool
     */
    public static function isJson()
    {
        return strpos('application/json', $_SERVER['HTTP_ACCEPT']) !== false;
    }

    /**
     * @return bool
     */
    public static function isHtml()
    {
        return strpos('text/html', $_SERVER['HTTP_ACCEPT']) !== false;
    }

    /**
     * @return bool
     */
    public static function isPdf()
    {
        return strpos('application/pdf', $_SERVER['HTTP_ACCEPT']) !== false;
    }
}
?>