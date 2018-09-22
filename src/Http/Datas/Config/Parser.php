<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19/09/2018
 * Time: 13:48
 */

namespace Kiron\Http\Datas\Config;

use Kiron\File\Driver\Ini;

class Parser
{

    private $file;

    public function __construct()
    {
        $this->file = new Ini(__DIR__.'/config.ini');
    }

    public function getSessionExpirationTime()
    {
        return $this->file->getKey('SESSION_EXPIRATION_TIME');
    }

    public function setSessionExpirationTime(int $expiration)
    {
        $this->file->alterKey('SESSION_EXPIRATION_TIME', $expiration);
    }

    public function getCookieExpirationTime()
    {
        return $this->file->getKey('COOKIE_EXPIRATION_TIME');
    }

    public function setCookieExpirationTime(int $expiration)
    {
        $this->file->alterKey('COOKIE_EXPIRATION_TIME', $expiration);
    }

}