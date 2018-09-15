<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14/09/2018
 * Time: 07:04
 */

namespace Kiron\Bags\Interfaces;

interface Bag
{

    public function get(string $key);

    public function set(string $key, $value);

    public function sets(array $keys);

    public function remove(string $key);

    public function exists(string $key);

}