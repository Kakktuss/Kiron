<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/09/2018
 * Time: 18:37
 */

namespace Kiron\Http\Interfaces;


interface Input
{

    public function get(string $name);

    public function add(string $name, $value) : bool;

    public function delete(string $name) : bool;

    public function alter(string $name, $value) : bool;

    public function redirect();

}