<?php

namespace Kiron\Database\Builder;

use Kiron\Database\Interfaces\Builder as BuilderInterface;

abstract class AbstractBuilder implements BuilderInterface {
    
    protected $database;
        
    abstract public function select($table, $columns = null) : self;

    abstract public function insert($table, $columns) : self;
    
    abstract public function delete(string $table, $columns);

    abstract public function update($update) : self;
    
    abstract public function join($join, $table, $on) : self;

    abstract public function value(string $name, string $value) : self;
    
    abstract public function values(array $names, array $values) : self;

    abstract public function set($columns, $values) : self;

    abstract public function sets(array $columns, array $values) : self;

    abstract public function appendParameters(array $names, array $values) : self;

    abstract public function appendParameter(string $name, $value) : self;

    abstract public function fullJoin(string $table, $firstCond, $secondCond) : self;

    abstract public function innerJoin(string $table, $firstCond, $secondCond) : self;

    abstract public function leftJoin(string $table, $firstCond, $secondCond) : self;

    abstract public function rightJoin(string $table, $firstCond, $secondCond) : self;
    
    abstract public function where($table, $equal) : self;
    
    abstract public function execute() : self;
    
    abstract public function loadObjectList() : array;
    
    abstract public function loadAssocs() : array;
    
    abstract public function loadColumns() : array;
    
    abstract public function loadAssoc() : array;
    
    abstract public function loadObject() : \stdclass;
    
    abstract public function loadColumn() : array;
}

?>