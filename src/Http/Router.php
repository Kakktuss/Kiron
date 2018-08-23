<?php

namespace Kiron\Http;

use Kiron\Http\Exception\Router as RouterException;
use Kiron\Http\Request;

class Router {

    /**
     * @var
     */
    private $url;
    /**
     * @var array
     */
    private $routes = [];
    /**
     * @var array
     */
    private $namedRoutes = [];

    /**
     * Router constructor.
     * @param $url
     */
    public function __construct($url){
		$this->url = $url;
	}

    /**
     * @param $path
     * @param $callable
     * @param null $name
     * @return Route
     */
    public function get($path, $callable, $name = null){
		return $this->add($path, $callable, $name, 'GET');
	}

    /**
     * @param $path
     * @param $callable
     * @param null $name
     * @return Route
     */
    public function post($path, $callable, $name = null){
		return $this->add($path, $callable, $name, 'POST');
	}

    /**
     * @param $path
     * @param $callable
     * @param null $name
     * @return Route
     */
    public function patch($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'PATCH');
    }

    /**
     * @param $path
     * @param $callable
     * @param null $name
     * @return Route
     */
    public function put($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'PUT');
    }

    /**
     * @param $path
     * @param $callable
     * @param null $name
     * @return Route
     */
    public function delete($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'DELETE');
    }

    /**
     * @param $basePath
     * @param $class
     * @param null $name
     * @throws \ReflectionException
     */
    public function resource($basePath, $class, $name = null)
    {
        $methods = get_class_methods($class);
        foreach($methods as $method)
        {
            $f = new \ReflectionMethod($class, $method);
            switch($method)
            {
                case 'index':
                    $this->get($basePath.'/', [$class, 'index']);
                    break;
                case 'show':
                    $this->get($basePath.'/:'.$f->getParameters()[0]->name, [$class, 'show']);
                    break;
                case 'store':
                    $this->post($basePath, [$class, 'store']);
                    break;
                case 'update':
                    $this->patch($basePath.'/:'.$f->getParameters()[0]->name, [$class, 'update']);
                    $this->put($basePath.'/:'.$f->getParameters()[0]->name, [$class, 'update']);
                    break;
                case 'destroy':
                    $this->delete($basePath.'/:'.$f->getParameters()[0]->name, [$class, 'destroy']);
                    break;
            }
        }
    }

    /**
     * @param $path
     * @param $callable
     * @param $name
     * @param $method
     * @return Route
     */
    private function add($path, $callable, $name, $method){
		$route = new Route($path, $callable);
		$this->routes[$method][] = $route;
		if(is_string($callable) && $name === null){
			$name = $callable;
		}
		if($name){
			$this->namedRoutes[$name] = $route;
		}
		return $route;
	}

    /**
     * @return mixed
     * @throws RouterException
     */
    public function run(){
		if(!isset($this->routes[Request::getRequestMethod()])){
			throw new RouterException('REQUEST_METHOD does not exist');
		}
		foreach($this->routes[Request::getRequestMethod()] as $route){
			if($route->match($this->url)){
				return $route->call();
			}
		}
		throw new RouterException('No matching routes');
	}

    /**
     * @param $name
     * @param array $params
     * @return mixed
     * @throws RouterException
     */
    public function getUrl($name, $params = []){
		if(!isset($this->namedRoutes[$name])){
			throw new RouterException('No route matches this name');
		}
		return $this->namedRoutes[$name]->getUrl($params);
	}

}