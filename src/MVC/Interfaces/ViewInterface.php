<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/09/2018
 * Time: 10:22
 */

namespace Kiron\MVC\Interfaces;

/**
 * Interface ViewInterface
 * @package Kiron\MVC\Interfaces
 */
interface ViewInterface
{
    /**
     * @param bool $use
     * @return mixed
     */
    public function useCache(bool $use = true);

    /**
     * @param array $params
     * @return mixed
     */
    public function setupParams(array $params);

    /**
     * @param string $layout
     * @param string $tpl
     * @return mixed
     */
    public function render(string $layout, string $tpl);
}