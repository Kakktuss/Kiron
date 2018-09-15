<?php

namespace Kiron\Database\Builder;

use Kiron\Database\Builder\Builder as BaseBuilder;
use Kiron\Database\Exception\Builder as BuilderException;

class MySql extends BaseBuilder {

    protected $querys = [];

    protected $executedQuery = '';

    public function select(string $table, $columns = null): self
    {
        $this->currentQuery .= 'SELECT ';
        if(is_array($columns))
        {
            $this->currentQuery .= '(';
            foreach ($columns as $key => $column) {
                $this->currentQuery .= $column;
                if(++$key !== count($columns))
                    $this->currentQuery .= ', ';
            }
            $this->currentQuery .= ')';
        }
        else
            $this->currentQuery .= $columns;
        $this->currentQuery .= ' FROM '.$table;
        return $this;
    }

    public function insert(string $table, $columns): self
    {
        $this->currentQuery .= 'INSERT INTO '.$table.' (';
        if(is_array($columns))
            foreach ($columns as $key => $column)
            {
                $this->currentQuery .= $column;
                if(++$key !== count($columns))
                    $this->currentQuery .= ', ';
            }
        else
            $this->currentQuery .= $columns;
        $this->currentQuery .= ')';
        return $this;
    }

    public function update(string $table): self
    {
        $this->currentQuery .= 'UPDATE '.$table;
        return $this;
    }

    public function delete(string $table): self
    {
        $this->currentQuery .= 'DELETE FROM '.$table;
        return $this;
    }

    public function value(string $name, $value): self
    {
        $this->currentQuery .= ' VALUE '.$name.' = '.intval($value) ?? "'".$value."'";
        return $this;
    }

    public function values(array $names, array $values): self
    {
        if(count($names) === count($values))
        {
            $this->currentQuery .= ' VALUES (';
            foreach ($names as $key => $name)
            {
                $this->currentQuery .= $name.' = '.("'".$values[$key]."'" ?? "''");
                if(++$key !== count($names))
                    $this->currentQuery .= ', ';
            }
            $this->currentQuery .= ')';
            return $this;
        }
    }

    public function innerJoin(string $table, $firstCond, $secondCond) : self
    {
        $this->currentQuery .= ' INNER JOIN '.$table.' ON '.$firstCond.'='.$secondCond;
        return $this;
    }

    public function leftJoin(string $table, $firstCond, $secondCond) : self
    {
        $this->currentQuery .= ' LEFT JOIN '.$table.' ON '.$firstCond.'='.$secondCond;
        return $this;
    }

    public function rightJoin(string $table, $firstCond, $secondCond) : self
    {
        $this->currentQuery .= ' RIGHT JOIN '.$table.' ON '.$firstCond.'='.$secondCond;
        return $this;
    }

    public function fullJoin(string $table, $firstCond, $secondCond) : self
    {
        $this->currentQuery .= ' FULL JOIN '.$table.' ON '.$firstCond.'='.$secondCond;
        return $this;
    }

    public function where(string $table, $equal): self
    {
        $this->currentQuery .= ' WHERE '.$table.' = '.((is_int($equal)) ? $equal : "'".$equal."'");
        return $this;
    }

    public function set(string $column, $value) : self
    {
        $this->currentQuery .= ' SET '.$column.'='.(is_int($value)) ? $value : "'".$value."'";
        return $this;
    }

    public function sets(array $columns, array $values) : self
    {
        if(count($columns) === count($values))
        {
            $this->currentQuery .= ' SET ';
            foreach ($columns as $key => $column)
            {
                $this->currentQuery .= $column.'='.(is_int($values[$key])) ? $values[$key] : "'".$values[$key]."'";
                if(++$key !== count($columns))
                    $this->currentQuery .= ', ';
            }
            return $this;
        } else {
            throw new BuilderException('[[Kiron:Database => Builder\MySql: sets] Error while checking the equality of $columns and $values, the number of both array\'s items are not equal');
        }
    }
}

?>