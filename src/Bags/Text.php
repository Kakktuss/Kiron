<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15/09/2018
 * Time: 10:07
 */

namespace Kiron\Bags;


class Text extends BaseBag
{

    public function set(string $key, $value)
    {
        if(is_string($value))
        {
            return $this->setKey($key, $value);
        }
        return false;
    }

    public function sets(array $keys)
    {
        foreach ($keys as $key => $value) {
            if(is_string($value))
                $this->setKey($key, $value);
            else
                return false;
        }
        return true;
    }

}