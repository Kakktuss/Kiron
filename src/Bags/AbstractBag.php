<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14/09/2018
 * Time: 21:39
 */

namespace Kiron\Bags;

use Kiron\Bags\Interfaces\Bag;

abstract class AbstractBag implements \ArrayAccess, Bag
{

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

    abstract public function get(string $key);

    abstract public function exists(string $key);

    abstract public function remove(string $key);

    abstract public function sets(array $keys);
}