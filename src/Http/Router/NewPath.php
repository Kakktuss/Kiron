<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22/09/2018
 * Time: 10:24
 */

namespace Kiron\Http\Router;


use Kiron\Html\Renderer;

class NewPath
{

    private $path;

    private $callable;

    private $functionName = null;

    private $matches = [];

    private $params = [];

    public function __construct($path, $callable, string $function = null)
    {
        $this->path = trim($path, '/');
        $this->callable = $callable;
        $this->functionName = $function;
    }

    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#^:([\w])$#', [$this, 'matchParams'], $this->path);
        if(!preg_match("#^$path$#i", $url, $matches))
            return false;
        array_shift($matches);
        $this->matches = $matches;
    }

    public function getMatches()
    {
        return $this->matches;
    }

    public function call()
    {
        if((is_object($this->callable) || (is_string($this->callable) && class_exists($this->callable))) && isset($this->functionName))
            $callable = [$this->callable, $this->functionName];
        else
            $callable = $this->callable;
        return call_user_func_array($callable, $this->matches);
    }

    public function with($param, $regex)
    {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this;
    }

    private function matchParams($match)
    {
        if(isset($this->params[$match[1]])){
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)';
    }

}