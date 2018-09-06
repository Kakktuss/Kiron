<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/09/2018
 * Time: 14:03
 */

namespace Kiron\MVC;

use Kiron\MVC\Interfaces\ModelInterface;

abstract  class AbstractModel implements ModelInterface
{

    protected $dbDriver;

    protected $dbBuilder;

    abstract public function getDatabase();

    abstract public function getDb();

    abstract public function getBuilder();

}