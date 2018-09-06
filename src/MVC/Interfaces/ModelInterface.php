<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/09/2018
 * Time: 10:22
 */

namespace Kiron\MVC\Interfaces;

/**
 * Interface ModelInterface
 * @package Kiron\MVC\Interfaces
 */
interface ModelInterface
{
    /**
     * @return mixed
     */
    public function getDatabase();

    /**
     * @return mixed
     */
    public function getBuilder();
}