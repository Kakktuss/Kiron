<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/09/2018
 * Time: 10:22
 */

namespace Kiron\MVC\Interfaces;

/**
 * Interface ControllerInterface
 * @package Kiron\MVC\Interfaces
 */
interface Controller
{

    /**
     * @param string $view
     * @return mixed
     */
    public function setBaseView(string $view);

    /**
     * @param string $layout
     * @return mixed
     */
    public function setBaseLayout(string $layout);

    /**
     * @param string $tpl
     * @return mixed
     */
    public function setBaseTpl(string $tpl);

    /**
     * @param string $name
     * @param $value
     * @return mixed
     */
    public function addParam(string $name, $value);

    /**
     * @param array $names
     * @param array $values
     * @return mixed
     */
    public function addParams(array $names, array $values);

    /**
     * @param string $layout
     * @param string $tpl
     * @param string|null $view
     * @return mixed
     */
    public function render(string $view, array $params = null);

}