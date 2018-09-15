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

    protected $keys = [];

    /**
     * @return array
     */
    public function getKeys(): array
    {
        return $this->keys;
    }

    public function offsetGet($offset) {
        $this->get($offset);
    }

    public function offsetUnset($offset) {
        $this->remove($offset);
    }

    public function offsetSet($offset, $value) {
        $this->set($offset, $value);
    }

    public function offsetExists($offset) {
        $this->exists($offset);
    }

    abstract public function set(string $key, $value);

    abstract public function sets(array $keys);

    public function get(string $key) {
        return ($this->exists($key)) ? $this->keys[$key] : null;
    }

    public function exists(string $key)
    {
        return isset($this->keys[$key]);
    }

    public function remove(string $key)
    {
        if($this->exists($key)){
            unset($this->keys[$key]);
            return true;
        }
        return false;
    }

    protected function setKey(string $key, $value)
    {
        $this->keys[$key] = $value;
        return true;
    }

}