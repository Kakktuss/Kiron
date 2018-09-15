<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/09/2018
 * Time: 18:12
 */

namespace Kiron\Http\Interfaces;


/**
 * Interface Cookie
 * @package Kiron\Http\Interfaces
 */
interface Cookie
{

    /**
     * @param string $name
     * @param $value
     * @param string $path
     * @param int|null $expiration
     * @param string|null $domain
     * @return bool
     */
    public function add(string $name, $value, string $path, int $expiration = null, string $domain = null) : bool;

    /**
     * @param string $name
     * @return bool
     */
    public function delete(string $name) : bool;

    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name);

}