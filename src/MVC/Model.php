<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/05/2018
 * Time: 10:13
 */

namespace Kiron\Mvc;

use Kiron\Database\Database;
use Kiron\MVC\Interfaces\Model as ModelInterface;

abstract class Model implements ModelInterface
{
    protected $dbDriver;

    /**
     * Model constructor.
     */
    public function __construct()
	{
		$this->dbDriver = Database::getInstance()->getDriver();
    }
    
    public function getDatabase()
    {
        return $this->dbDriver->getDatabase();
    }
    
    public function getBuilder()
    {
        return $this->dbDriver->getBuilder();
    }
}