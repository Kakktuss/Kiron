<?php

namespace Kiron\Http\Router;

use Kiron\Http\Exception\Router as RouterException;
use Kiron\Http\Header\Response as HeaderResponse;
use Kiron\Http\Router\Path;
use Kiron\Mvc\Controller;

class Rewriter {

    /**
     * @var
     */
    private $url;
    /**
     * @var array
     */
    private $routes = [];

    public static $_instance;

    /**
     * @return Rewriter
     */
    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new Rewriter();
        }
        return self::$_instance;
    }

    /**
     * Router constructor.
     * @param $url
     */
    protected function __construct()
    {
        $this->url = $_GET['url'] ?? '';
    }

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param $path
     * @param Controller $controller
     * @param string $funcName
     * @return Route
     */
    public function get($path, $callable, string $funcName = null){
        return $this->add($path, $callable, $funcName, 'GET');
    }

    /**
     * @param $path
     * @param Controller $controller
     * @param string $funcName
     * @return Route
     */
    public function post($path, $callable, string $funcName = null){
		return $this->add($path, $callable, $funcName, 'POST');
	}

    /**
     * @param $path
     * @param Controller $controller
     * @param string $funcName
     * @return Route
     */
    public function patch($path, $callable, string $funcName = null)
    {
        return $this->add($path, $callable, $funcName, 'PATCH');
    }

    /**
     * @param $path
     * @param Controller $controller
     * @param string $funcName
     * @return Route
     */
    public function put($path, $callable, string $funcName = null)
    {
        return $this->add($path, $callable, $funcName, 'PUT');
    }

    /**
     * @param $path
     * @param Controller $controller
     * @param string $funcName
     * @return Route
     */
    public function delete($path, $callable, string $funcName = null)
    {
        return $this->add($path, $callable, $funcName, 'DELETE');
    }

    /**
     * @param $basePath
     * @param $class
     * @throws \ReflectionException
     */
    public function resource($basePath, $class)
    {
        $methods = get_class_methods($class);
        foreach($methods as $method)
        {
            $f = new \ReflectionMethod($class, $method);
            switch($method)
            {
                case 'index':
                    $this->get($basePath.'/', $class, 'index');
                    break;
                case 'show':
                    $this->get($basePath.'/:'.$f->getParameters()[0]->name, $class, 'show');
                    break;
                case 'store':
                    $this->post($basePath, $class, 'store');
                    break;
                case 'update':
                    $this->patch($basePath.'/:'.$f->getParameters()[0]->name, $class, 'update');
                    $this->put($basePath.'/:'.$f->getParameters()[0]->name, $class, 'update');
                    break;
                case 'destroy':
                    $this->delete($basePath.'/:'.$f->getParameters()[0]->name, $class, 'update');
                    break;
            }
        }
    }


    /**
     * @param string $path
     * @param callable|Controller $callable
     * @param string|null $method
     * @param string $name
     * @return \Kiron\Http\Router\Path
     */
    private function add($path, $callable, string $method = null, string $name){
		$route = new Path($path, $callable, $method);
		$this->routes[$name][] = $route;
		return $route;
	}

    /**
     * @return mixed
     * @throws RouterException
     */
    public function run(){
		if(!isset($this->routes[HeaderResponse::getRequestMethod()])){
			throw new RouterException('REQUEST_METHOD does not exist');
		}
		foreach($this->routes[HeaderResponse::getRequestMethod()] as $route){
			if($route->match($this->url)){
				return $route->call();
			}
		}
		throw new RouterException('No matching routes');
	}

}