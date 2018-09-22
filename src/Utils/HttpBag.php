<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14/09/2018
 * Time: 17:43
 */

namespace Kiron\Utils;

use Kiron\Bags\Obj as ObjectBag;
use Kiron\Http\Router\Rewriter as RouterRewriter;
use Kiron\Http\Header\Seter as HeaderSetter;
use Kiron\Http\Header\Response as HeaderResponse;
use Kiron\Http\Datas\Input as DataInput;
use Kiron\Http\Datas\Cookie as DataCookie;
use Kiron\Http\Datas\Session as DataSession;
use Kiron\Http\Request\Client as HttpClient;
use Kiron\Http\Request\Server as HttpServer;

class HttpBag extends ObjectBag
{
    public static $_instance;

    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new HttpBag();
        }
        return self::$_instance;
    }

    protected function __construct()
    {
        $this->sets([
            'headerSetter' => HeaderSetter::class,
            'headerGetter' => HeaderResponse::class,
            'input' => DataInput::class,
            'cookie' => DataCookie::class,
            'session' => DataSession::class,
            'client' => HttpClient::getInstance(),
            'server' => HttpServer::getInstance(),
            'router' => RouterRewriter::getInstance()
        ]);
    }
}