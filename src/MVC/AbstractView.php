<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/09/2018
 * Time: 14:04
 */

namespace Kiron\MVC;

use Kiron\MVC\Interfaces\ViewInterface;

abstract class AbstractView implements ViewInterface
{

    abstract public function render(string $layout, string $tpl);

    abstract public function useCache(bool $use = true);

    abstract public function setupParams(array $params);

}