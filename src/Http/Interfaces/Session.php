<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/09/2018
 * Time: 17:56
 */

namespace Kiron\Http\Interfaces;


/**
 * Interface Session
 * @package Kiron\Http\Interfaces
 */
interface Session
{

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key);

    /**
     * @param string $key
     * @param $value
     * @return bool
     */
    public function set(string $key, $value) : bool;

    /**
     * @param string $key
     * @return bool
     */
    public function delete(string $key) : bool;

    /**
     * @param string $name
     * @return bool
     */
    public function exists(string $name) : bool;

    /**
     * @return bool
     */
    public function connect() : bool;

    /**
     * @return bool
     */
    public function isConnected() : bool;

    /**
     * @return bool
     */
    public function disconnect() : bool;

    /**
     * @return bool
     */
    public function sessionActive() : bool;

}