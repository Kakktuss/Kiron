<?php

namespace Kiron\Database\Builder;

use Kiron\Database\Interfaces\Builder as BuilderInterface;

abstract class AbstractBuilder implements BuilderInterface {
    
    abstract protected $database;
        
    abstract public function select($table, $columns = null) : self;
    
    abstract public function insert($table, $columns) : self;
    
    abstract public function delete($delete) : self;
        
    abstract public function update($update) : self;
    
    abstract public function join($join, $table, $on) : self;
    
    abstract public function from($table) : self;
    
    abstract public function value(string $name, string $value) : self;
    
    abstract public function values(string $names, string $values) : self;
    
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