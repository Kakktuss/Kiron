<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/05/2018
 * Time: 11:07
 */

namespace Kiron\Http;

use Kiron\Http\Exception\Router as RouterException;

class Route
{

    /**
     * @var string
     */
    private $path;
    /**
     * @var
     */
    private $callable;
    /**
     * @var array
     */
    private $matches = [];
    /**
     * @var array
     */
    private $params = [];

    /**
     * Route constructor.
     * @param $path
     * @param $callable
     */
    public function __construct($path, $callable)
	{

		$this->path = trim($path, '/');
		$this->callable = $callable;

	}

    /**
     * @param $url
     * @return bool
     */
    public function match($url){
		$url = trim($url, '/');
		$path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
		$regex = "#^$path$#i";
		if(!preg_match($regex, $url, $matches)){
			return false;
		}
		array_shift($matches);
		$this->matches = $matches;
		return true;
	}

    /**
     * @param $match
     * @return string
     */
    private function paramMatch($match){
		if(isset($this->params[$match[1]])){
			return '(' . $this->params[$match[1]] . ')';
		}
		return '([^/]+)';
	}

    /**
     * @return mixed
     */
    public function call(){
		if(is_string($this->callable)){
			$params = explode('#', $this->callable);
			$controller = "App\\ControllerInterface\\" . $params[0] . "ControllerInterface";
			$controller = new $controller();
			return call_user_func_array([$controller, $params[1]], $this->matches);
		} else {
			return call_user_func_array($this->callable, $this->matches);
		}
	}

    /**
     * @param $param
     * @param $regex
     * @return $this
     */
    public function with($param, $regex){
		$this->params[$param] = str_replace('(', '(?:', $regex);
		return $this;
	}

    /**
     * @param $params
     * @return mixed|string
     */
    public function getUrl($params){
		$path = $this->path;
		foreach($params as $k => $v){
			$path = str_replace(":$k", $v, $path);
		}
		return $path;
	}

}