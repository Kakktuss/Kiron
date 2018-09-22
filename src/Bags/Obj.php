<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15/09/2018
 * Time: 09:58
 */

namespace Kiron\Bags;


class Obj extends BaseBag
{
    public function set(string $key, $value)
    {
        if(is_object($value)) {
            return $this->setKey($key, $value);
        }
        return false;
    }

    public function sets(array $keys)
    {
        foreach ($keys as $key => $value)
        {
            if(is_object($value))
            {
                $this->setKey($key, $value);
            }
        }
        return true;
    }
}