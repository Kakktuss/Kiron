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
	protected $db;

	public function __construct()
	{
		$this->db = $this->getDb();
	}

	public function getDb()
	{
		return new QueryBuilder();
	}
}