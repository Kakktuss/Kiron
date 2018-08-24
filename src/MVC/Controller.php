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
     * Controller constructor.
     * @param string|null $basePart
     */
    public function __construct()
    {
        $this->config = Config::getInstance();
        $class = new \ReflectionClass($this);
        $path = dirname(dirname(strrpos($class->getFileName(), '/')));
        echo $path;
    }

    /**
     * @param string|null $part
     */
    public function setCurrentPart(string $part = null)
    {
        $this->basePart = $part;
    }

    /**
     * @param $modelName
     */
    public function loadModel($modelName)
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
        $modelPath = ROOT.DS.APPLICATION_PATH.DS.CURRENT_PART.DS.'Model'.DS.$modelName;

        return new $modelPath();
	}
}