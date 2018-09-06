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
use Kiron\Html\Document;
use Kiron\MVC\Exception\Controller as ControllerException;
use Kiron\MVC\Interfaces\ControllerInterface;

/**
 * Class Controller
 * @package Kiron\Mvc
 */
abstract class Controller implements ControllerInterface
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
     * @var Emitter
     */
    protected $emitter;

    /**
     * @var string
     */
    protected $part;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var string
     */
    protected $baseView;

    /**
     * @var string
     */
    protected $defaultLayout = 'default';

    /**
     * @var string
     */
    protected $baseTpl = 'default';

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
        $this->emitter = new Emitter();
        $this->self = new \ReflectionClass($this);
        $this->setPart();
        $this->setBaseView();
    }

    /**
     * @param string|null $part
     */
    public function setPart(string $part = null)
    {
        $this->part = $part ?? substr(dirname(dirname($this->self->getFileName())), (strrpos(dirname(dirname($this->self->getFileName())), DS))+1, strlen(dirname(dirname($this->self->getFileName()))));
    }

    /**
     * @param string|null $view
     */
    public function setBaseView(string $view = null)
    {
        $this->defaultView = $view ??
            ((strpos($this->self->getShortName(), 'Controller') !== false)
                ? substr($this->self->getShortName(), 0, strpos($this->self->getShortName(), 'Controller'))
                : $this->self->getShortName());
    }

    /**
     * @param string $layout
     */
    public function setBaseLayout(string $layout = 'default')
    {
        $this->baseLayout = $layout;
    }

    /**
     * @param string $tpl
     */
    public function setBaseTpl(string $tpl = 'default')
    {
        $this->baseTpl = $tpl;
    }


    /**
     * @param string $name
     * @param mixed $value
     */
    public function addParam(string $name, $value)
    {
        $this->params[$name] = $value;
    }

    /**
     * @param array $names
     * @param array $values
     */
    public function addParams(array $names, array $values)
    {
        if(count($names) === count($values))
        {
            foreach ($names as $key => $name)
            {
                if(!$this->paramExists($name))
                    $this->params[$name] = $values[$key];
                else
                    throw new ControllerException('[Kiron:Mvc => Controller\BaseController: addParams] Error while adding parameter, parameter '.$name.' already exists');
            }
        } else {
            throw new ControllerException('[Kiron:Mvc => Controller\BaseController: addParams] Error while testing equality of $names && $values');
        }
    }

    /**
     * @param string|null $view
     * @param string $layout
     * @param string $tpl
     */
    public function render(string $layout = 'default', string $tpl = 'default', string $view = null)
    {
        $path = $_SERVER['DOCUMENT_ROOT'].DS.ROOT.DS.APPLICATION_PATH.DS.$this->part.DS.VIEW_PATH.DS.$this->defaultView;
        if(is_dir($path))
        {
            $dir = scandir($path);
            foreach ($dir as $file)
            {
                if(strpos($file, '.php'))
                {
                    include $path.DS.$file;
                    $class = get_declared_classes()[count(get_declared_classes())-1];
                    $class = new $class();
                    $class->setupParams($this->params);
                    $class->render($layout ?? $this->defaultLayout, $tpl ?? $this->defaultTpl);
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param $modelName
     */
    public function loadModel(string $modelName)
    {
        $this->$modelName = $this->getModel($modelName);
    }

    /**
     * @param string $modelName
     * @param string $type
     *
     * @return mixed
     */
    private function getModel(string $modelName)
    {
        $modelPath = APPLICATION_PATH.DS.$this->part.DS.MODEL_PATH.DS.$modelName;

        return new $modelPath();
    }

    /**
     * @param $name
     */
    private function paramExists(string $name)
    {
        return isset($this->params[$name]);
    }
}