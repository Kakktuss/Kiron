<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14/09/2018
 * Time: 18:02
 */

namespace Kiron\Bags;

use \ArrayAccess;
use Kiron\Bags\Interfaces\Bag;

class Number extends BaseBag
{

    public function set(string $key, $value)
    {
        if(is_int($value) || is_float($value))
        {
            return $this->setKey($key, $value);
        }
        return false;
    }

    public function sets(array $keys)
    {
        foreach ($keys as $key => $value) {
            if(is_int($value) || is_float($value))
                $this->setKey($key, $value);
            else
                return false;
        }
        return true;
    }

}