<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14/09/2018
 * Time: 07:02
 */

namespace Kiron\Bags;

use Kiron\Bags\Interfaces\Parameter as ParameterInterface;

class Mixed extends BaseBag
{

    public function set(string $key, $value)
    {
        $this->setKey($key, $value);
    }

    public function sets(array $keys)
    {
        foreach ($keys as $key => $value)
        {
            $this->setKey($key, $value);
        }
        return true;
    }
}