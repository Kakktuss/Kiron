<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15/09/2018
 * Time: 09:08
 */

namespace Kiron\Bags;

use Kiron\Bags\Interfaces\Bag;

abstract class BaseBag implements \ArrayAccess, Bag
{

    /**
     * @return array
     */
    public function getKeys(): array
    {
        return get_defined_vars();
    }

    public function offsetGet($offset) {
        return $this->get($offset);
    }

    public function offsetUnset($offset) {
        return $this->remove($offset);
    }

    public function offsetSet($offset, $value) {
        return $this->set($offset, $value);
    }

    public function offsetExists($offset) {
        return $this->exists($offset);
    }

    abstract public function set(string $key, $value);

    abstract public function sets(array $keys);

    public function get(string $key) {
        return ($this->exists($key)) ? $this->$key : null;
    }

    public function exists(string $key)
    {
        return isset($this->$key);
    }

    public function remove(string $key)
    {
        if($this->exists($key)){
            unset($this->$key);
            return true;
        }
        return false;
    }

    protected function setKey(string $key, $value)
    {
        $this->$key = $value;
        return true;
    }

}