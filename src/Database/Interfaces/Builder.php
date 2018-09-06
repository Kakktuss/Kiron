<?php

namespace Kiron\Database\Interfaces;

interface Builder {
    
    public function select(string $table, $columns = null);
    
    public function insert(string $table, $columns);
    
    public function delete(string $table, $columns);
    
    public function update(string $table);
    
    public function innerJoin(string $table, $firstCond, $secondCond);

    public function leftJoin(string $table, $firstCond, $secondCond);

    public function rightJoin(string $table, $firstCond, $secondCond);

    public function fullJoin(string $table, $firstCond, $secondCond);

    public function set(string $column, $value);

    public function sets(array $columns, array $values);

    public function value(string $name, string $value);
    
    public function values(array $names, array $values);
    
    public function where(string $table, $equal);
    
    public function appendParameter(string $name, $value);
    
    public function appendParameters(array $names, array $values);
    
    public function execute();
    
    public function loadObjectList();
    
    public function loadAssocs();
    
    public function loadColumns();
    
    public function loadAssoc();
    
    public function loadObject();
    
    public function loadColumn();
    
}

?>