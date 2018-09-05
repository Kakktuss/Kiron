<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 28/08/2018
 * Time: 11:23
 */

namespace Kiron\MVC;

use Kiron\MVC\Interfaces\ControllerInterface;

abstract class AbstractController implements ControllerInterface
{
    protected $model;

    protected $emitter;

    protected $emitterListener;

    protected $part;

    protected $params = [];

    protected $baseView;

    protected $defaultLayout = 'default';

    protected $baseTpl = 'default';

    abstract public function setBaseTpl(string $tpl);

    abstract public function setBaseLayout(string $layout);

    abstract public function setBaseView(string $view);

    abstract public function addParam(string $name, mixed $value);

    abstract public function addParams(array $names, array $values);

    abstract public function render(string $layout, string $tpl, string $view = null, string $part = null);

    abstract public function loadModel(string $modelName);
}