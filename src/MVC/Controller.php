<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/05/2018
 * Time: 10:13
 */

namespace Kiron\Mvc;

use Kiron\Bags\Mixed as MixedBag;
use Kiron\Cache\Cache;
use Kiron\Config\Config;
use Kiron\Emitter\Emitter;
use Kiron\Html\Renderer;
use Kiron\Http\Request;
use Kiron\Html\Document;
use Kiron\Mvc\Config\Parser;
use Kiron\MVC\Exception\Controller as ControllerException;
use \Kiron\MVC\Interfaces\Controller as ControllerInterface;
use Kiron\Utils\ServerBag;

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
     * @var Emitter
     */
    protected $emitter;

    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * @var string
     */
    protected $part;

    /**
     * @var MixedBag
     */
    protected $params;

    /**
     * @var string
     */
    public $renderMethod = 'html';

    /**
     * Controller constructor.
     * @param string|null $basePart
     */
    public function __construct()
    {
        $this->emitter = new Emitter();
        $this->renderer = Renderer::getInstance();
        $this->params = new MixedBag();
        $this->setPart();
    }

    /**
     * @param string $rendering
     */
    public function renderAs(string $rendering)
    {
        $this->renderMethod = $rendering;
    }

    /**
     * @param string|null $part
     */
    public function setPart(string $part = null)
    {
        $self = new \ReflectionClass($this);
        $this->part = $part ?? substr(dirname(dirname($self->getFileName())), (strrpos(dirname(dirname($self->getFileName())), DS))+1, strlen(dirname(dirname($self->getFileName()))));
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
     * @param $modelName
     */
    public function loadModel(string $modelName)
    {
        $modelPath = APPLICATION_PATH.DS.$this->part.DS.MODEL_PATH.DS.$modelName;

        $this->$modelName = new $modelPath;
    }

    /**
     * @param $name
     */
    private function paramExists(string $name)
    {
        return isset($this->params[$name]);
    }

    /**
     * @param string|null $view
     * @param string $layout
     * @param string $tpl
     */
    public function render(string $view = null, array $params = null)
    {
        $path = ServerBag::getInstance()['root'].DS.ROOT.DS.APPLICATION_PATH.DS.$this->part.DS.VIEW_PATH.DS.($view ?? $this->defaultView).'.php';
        if(file_exists($path))
        {
            ob_start();
            !empty($this->params) ? $this->params : $params;
            require_once $path;
            $content = ob_get_contents();
            ob_end_clean();
            ob_start();
            require_once ServerBag::getInstance()['root'].DS.ROOT.DS.APPLICATION_PATH.DS.$this->part.DS.VIEW_PATH.DS.DEFAULT_HTML_FILE.'.php';
            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }
        return false;
    }
}