<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/05/2018
 * Time: 10:13
 */

namespace Kiron\Mvc;

use Kiron\Cache\Cache;
use Kiron\Config\Config;
use Kiron\Emitter\Emitter;
use Kiron\Http\Request;
use Kiron\Language\Lang;
use Kiron\Html\Document;

abstract class Controller
{
    /**
     * @var Model mixed
     */
    protected $model;

    /**
     * @var Config mixed
     */
    protected $config;

    /**
     * @var string
     */
    protected $part;

    /**
     * @var array
     */
    protected $params = [
        'params' => [],
        'models' => []
    ];

    /**
     * @var string
     */
    protected $defaultView;

    /**
     * @var \ReflectionClass
     */
    protected $self;

    /**
     * Controller constructor.
     * @param string|null $basePart
     */
    public function __construct()
    {
        $this->config = Config::getInstance();
        $this->self = new \ReflectionClass($this);
        $this->setCurrentPart();
    }

    /**
     * @param string|null $part
     */
    public function setPart(string $part = null)
    {
        $this->part = $part ?? strrpos(dirname(dirname($this->self->getFileName())), DS);
    }

    /**
     * @param string|null $view
     */
    public function setDefaultView(string $view = null)
    {
        $this->defaultView = $view ?? ((strpos($this->self->getFileName(), 'Controller') !== false) ? substr($this->self->getFileName(), strpos($this->self->getFileName(), 'Controller')) : $this->self->getFileName());
    }

    /**
     * @param $name
     * @param $value
     */
    public function addParam($name, $value)
    {
        $this->params['params'][$name] = $value;
    }


    /**
     * @param string|null $path
     * @param string|null $view
     * @param string|null $part
     */
    public function render()
    {
        echo scandir(ROOT.DS.APPLICATION_PATH.DS.$this->part.DS.VIEW_PATH);
//        $viewPath = ROOT.DS.APPLICATION_PATH.DS.$this->part.DS.VIEW_PATH.DS.$view ?? $this->defaultView;
//        $viewClass = new $viewPath();
//        $viewClass->setupParams($this->params);
//        $viewClass->render($this->params);
    }

    /**
     * @param $modelName
     */
    public function loadModel($modelName)
    {
        $this->params['models'][$modelName] = $this->getModel($modelName);
    }

    /**
     * @param string $modelName
     * @param string $type
     *
     * @return mixed
     */
    private function getModel(string $modelName)
    {
        $modelPath = ROOT.DS.APPLICATION_PATH.DS.$this->part.DS.MODEL_PATH.DS.$modelName;

        return new $modelPath();
    }
}