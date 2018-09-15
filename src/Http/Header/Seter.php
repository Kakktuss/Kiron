<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 20/08/2018
 * Time: 21:19
 */

namespace Kiron\Http\Header;

class Seter
{
    /**
     * @param string $location
     */
    public static function setLocation(string $location)
    {
        header('Location: '.$location);
    }

    /**
     * @param string $state
     */
    public static function setHttpState(string $state)
    {
        header($_SERVER['SERVER_PROTOCOL'].' '.$state);
    }

    /**
     * @param string $contentType
     */
    public static function setContentType(string $contentType)
    {
        header('Content-type: '.$contentType);
    }

    /**
     * @param string $disposition
     */
    public function setContentDisposition(string $disposition)
    {
        header('Content-Disposition: '.$disposition.';');
    }

    /**
     * @param string $control
     */
    public static function setCacheControl(string $control)
    {
        header('Cache-Control: '.$control);
    }

    /**
     * @param string $time
     */
    public static function setExpireTime(string $time)
    {
        header('Expires: '.$time);
    }

    /**
     * @return bool
     */
    public static function isAlreadySent()
    {
        return headers_sent();
    }

    /**
     * @return int
     */
    public static function getResponseCode()
    {
        return http_response_code();
    }

    /**
     * @param int $response_code
     */
    public static function setResponseCode(int $response_code)
    {
        http_response_code($response_code);
    }
}