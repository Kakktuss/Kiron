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
     * @var
     */
    protected $basePart;

    /**
     * Controller constructor.
     * @param string|null $basePart
     */
    public function __construct(string $basePart = null)
    {
        $this->basePart = $basePart;
    }

    /**
     * @param string|null $part
     */
    public function setPart(string $part = null)
    {
        $this->basePart = $part;
    }

    /**
     * @param $modelName
     */
    public function loadModel($modelName)
    {
        $this->$modelName = $this->getModel($modelName);
        $this->config = Config::getInstance();
    }

	/**
	 * @param string $modelName
	 * @param string $type
	 *
	 * @return mixed
	 */
	private function getModel(string $modelName, string $part = null)
	{
        $modelPath = ($this->config->isLocalhost()) ? Request::getRoot().DS.APPLICATION_PATH.$part ?? $this->basePart.DS.'Model'.DS.$modelName : '';

        return new $modelPath();
	}
}