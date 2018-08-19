<?php

namespace Kiron\Http;

use Kiron\Http\Exception\Router as RouterException;
use Kiron\Http\Request;

class Router {

	private $url;
	private $routes = [];
	private $namedRoutes = [];

	public function __construct($url){
		$this->url = $url;
	}

	public function get($path, $callable, $name = null){
		return $this->add($path, $callable, $name, 'GET');
	}

	public function post($path, $callable, $name = null){
		return $this->add($path, $callable, $name, 'POST');
	}
    
    public function patch($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'PATCH');
    }
    
    public function put($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'PUT');
    }
    
    public function delete($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'DELETE');
    }
    
    public function rest($basePath, $class, $name = null)
    {
        $methods = get_class_methods($class);
        foreach($methods as $method)
        {
            $f = new \ReflectionMethod($class, $method);
            switch($method)
            {
                case 'get':
                    $this->get($basePath.'/:'.$f->getParameters()[0]->name, [$class, 'get']);
                    break;
                case 'add':
                    $this->post($basePath, [$class, 'add']);
                    break;
                case 'edit':
                    $this->patch($basePath.'/:'.$f->getParameters()[0]->name, [$class, 'edit']);
                    $this->put($basePath.'/:'.$f->getParameters()[0]->name, [$class, 'edit']);
                    break;
                case 'delete':
                    $this->delete($basePath.'/:'.$f->getParameters()[0]->name, [$class, 'delete']);
                    break;
            }
        }
    }

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

	public function getUrl($name, $params = []){
		if(!isset($this->namedRoutes[$name])){
			throw new RouterException('No route matches this name');
		}
		return $this->namedRoutes[$name]->getUrl($params);
	}

}