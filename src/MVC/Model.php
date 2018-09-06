<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/05/2018
 * Time: 10:13
 */

namespace Kiron\Mvc;

use Kiron\Database\Database;

abstract class Model
{
    protected $dbDriver;

    /**
     * Model constructor.
     */
    public function __construct()
	{
		$this->dbDriver = Database::getInstance()->getDriver();
    }
    
    public function getDb()
    {
        return $this->dbDriver->getDatabase();
    }
    
    public function getBuilder()
    {
        return $this->dbDriver->getBuilder();
    }
}