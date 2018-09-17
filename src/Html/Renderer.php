<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15/09/2018
 * Time: 21:33
 */

namespace Kiron\Html;


use Kiron\Bags\Text as TextBag;
use Kiron\Http\Header\Seter;

class Renderer
{

    /**
     * @var TextBag
     */
    public $methods;

    /**
     * @var
     */
    public static $_instance;

    /**
     * @return Renderer
     */
    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new Renderer();
        }

        return self::$_instance;
    }

    /**
     * Renderer constructor.
     */
    protected function __construct()
    {
        $this->methods = new TextBag();
        $this->methods->sets([
            'json' => 'application/json',
            'html' => 'text/html'
        ]);
    }

    /**
     * @param string $name
     * @param string $method
     * @return bool
     */
    public function setMethod(string $name, string $method)
    {
        if(!$this->methodExists($name))
        {
            $this->methods[$name] = $method;
            return true;
        }
        return false;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function deleteMethod(string $name)
    {
        if($this->methodExists($name))
        {
            unset($this->methods[$name]);
            return true;
        }
        return false;
    }

    /**
     * @param string $methodName
     */
    public function renderAs(string $methodName)
    {
        if($this->methodExists($methodName))
        {
            Seter::setContentType($this->methods[$methodName]);
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function methodExists(string $name)
    {
        return isset($this->methods[$name]);
    }

}