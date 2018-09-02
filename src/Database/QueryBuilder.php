<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/05/2018
 * Time: 17:16
 */

namespace Kiron\Database;

class QueryBuilder
{
	private $preparedQuery = '';
	private $connectorInstance;
	private $db;
	private $queryExecuted;
	private $queryType;
	private $params = [];

	public function __construct()
	{
		$this->connectorInstance = Connector::getInstance();
//		$this->getDb();
	}

	private function getDb()
	{
		 $this->connectorInstance->getDriver();
	}

	public function select($argument)
	{
		$this->preparedQuery .= 'SELECT '.$argument;
		$this->queryType = 'SELECT';
		return $this;
	}

	public function from($table)
	{
		if($this->queryType === 'SELECT')
		{
			$this->preparedQuery .= ' FROM '.$table;
			return $this;
		}
	}

	public function where($condition)
	{
		if($this->queryType === 'SELECT' || $this->queryType === 'UPDATE' || $this->queryType = 'DELETE')
		{
			$this->preparedQuery .= ' WHERE '.$condition;
			return $this;
		}
	}

	public function insert($table)
	{
		$this->preparedQuery .= 'INSERT INTO '.$table;
		$this->queryType = 'INSERT';
		return $this;
	}

	public function update($table)
    {
        $this->preparedQuery = 'UPDATE '.$table;
        $this->queryType = 'UPDATE';
        return $this;
    }

    public function delete($table)
    {
        $this->preparedQuery = 'DELETE FROM '.$table;
        $this->queryType = 'DELETE';
        return $this;
    }

    public function set(array $columns, array $values)
    {
        if($this->queryType === 'UPDATE')
        {
            $setStr = '';
            foreach ($columns as $key => $col)
            {
                $setStr .= $col.' = '.("'".$values[$key]."'" ?? "''");
                if(++$key !== count($columns))
                    $setStr .= ', ';
            }
            $this->preparedQuery .= ' SET '.$setStr;
            return $this;
        }
    }

	public function column($columns)
	{
		if($this->queryType === 'INSERT')
		{
			if(is_array($columns))
				$columns = implode(', ', $columns);
			$this->preparedQuery .= ' ('.$columns.')';
			return $this;
		}
		return null;
	}

	public function values(array $columns, array $values)
	{
		if($this->queryType === 'INSERT')
		{
		    $insertStr = '';
		    foreach ($columns as $key => $col)
            {
                $insertStr .= $col.' = '.("'".$values[$key]."'" ?? "''");
                if(++$key !== count($columns))
                    $insertStr .= ', ';
            }
			$this->preparedQuery .= ' VALUES ('.$insertStr.')';
			return $this;
		}
		return null;
	}

	public function join($joinType, $table, $on = null)
	{
		switch ($joinType)
		{
			case 'inner':
				$this->preparedQuery .= ' INNER JOIN '.$table.' ON '.$on;
				break;
			case 'cross':
				$this->preparedQuery .= ' CROSS JOIN '.$table;
				break;
			case 'full':
				$this->preparedQuery .= ' FULL JOIN '.$table.' ON '.$on;
				break;
			case 'left':
				$this->preparedQuery .= ' LEFT JOIN '.$table.' ON '.$on;
				break;
		}
		return $this;
	}

	public function appendParameters(array $params)
	{
		$this->params = $params;
		return $this;
	}

	public function execute()
	{
		try {
			$query = $this->db->prepare($this->preparedQuery);
			$query->execute($this->params);
			$this->queryExecuted = $query;
			$this->preparedQuery = '';
		} catch (\PDOException $e)
		{
			echo $e;
		}
		return $this;
	}

	public function loadObjectList()
	{
		return $this->queryExecuted->fetchAll(\PDO::FETCH_OBJ);
	}

	public function loadAssocs()
	{
		return $this->queryExecuted->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function loadColumns()
	{
		return $this->queryExecuted->fetchAll(\PDO::FETCH_COLUMN);
	}

	public function loadObject()
    {
        return $this->queryExecuted->fetch(\PDO::FETCH_OBJ);
    }

    public function loadAssoc()
    {
        return $this->queryExecuted->fetch(\PDO::FETCH_ASSOC);
    }

	public function loadColumn()
    {
        return $this->queryExecuted->fetch(\PDO::FETCH_COLUMN);
    }

	public function getCurrentQuery()
	{
		return $this->preparedQuery;
	}
}