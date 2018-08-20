<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/05/2018
 * Time: 10:13
 */

namespace Kiron\Mvc;

use Kiron\Database\QueryBuilder;

abstract class Model
{
    /**
     * @var QueryBuilder
     */
    protected $db;

    /**
     * Model constructor.
     */
    public function __construct()
	{
		$this->db = $this->getDb();
	}

    /**
     * @return QueryBuilder
     */
    public function getDb()
	{
		return new QueryBuilder();
	}
}