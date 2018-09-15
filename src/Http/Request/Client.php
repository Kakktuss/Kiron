<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/09/2018
 * Time: 15:30
 */

namespace Kiron\Http\Request;

use \HttpRequest;

class Client
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_DELETE = 'DELETE';
    const METHOD_PATCH = 'PATCH';
    const METHOD_PUT = 'PUT';

    public $url;

    public $method;

    public $dates = [];

    public static $_instance;

    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new Bag();
        }
        return self::$_instance;
    }

    protected function __construct(string $url = null, string $method = METHOD_GET)
    {
        $this->url = $url;
        $this->method = $method;
    }
}