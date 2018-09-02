<?php

namespace Kiron\Database\Interfaces;

interface Builder {
    
    public function select(string $table, $columns = null);
    
    public function insert(string $table, $columns);
    
    public function delete(string $delete);
    
    public function update(string $update);
    
    public function join(string $join, string $table, $on);
    
    public function set($columns, $values);
    
    public function from(string $table);
    
    public function value(string $name, $value);
    
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