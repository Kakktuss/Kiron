<?php

namespace Kiron\Database\Builder;

use \PDO;
use \PDOException;
use Kiron\Database\Exception\Builder as BuilderException;
use Kiron\Database\Interfaces\Builder as BuilderInterface;

abstract class Builder implements BuilderInterface {
    
    protected $database;
    
    protected $parameters = [];
    
    protected oldQuerys = [];
    
    private $currentQuery = '';
    
    private $executedQuery;
    
    public function __construct(PDO $database) {
        $this->database = $database;
    }
    
    abstract public function select($table, $columns = null) : self;
    
    abstract public function insert($table, $columns) : self;
    
    abstract public function delete($delete) : self;
        
    abstract public function update($update) : self;
    
    abstract public function join($join, $table, $on) : self;
    
    abstract public function from($table) : self;
    
    abstract public function value(string $name, string $value) : self;
    
    abstract public function values(string $names, string $values) : self;
    
    abstract public function where($table, $equal) : self;
    
    public function appendParameter(string $name, $value) {
        if(!$this->parameterExists($name))
        {
            $this->parameters[$name] = $value;
            return true;
        }
        throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: appendParameter] Error while appening a parameter, parameter \''.$name.'\' already exists', 500);
        return false;
    }
    
    public function appendParameters(array $names, array $values)
    {
        if(count($names) === count($values))
        {
            foreach($names as $key => $name)
            {
                $this->appendParamater($name, $values[$key]);
            }
        } else {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: appendParameters] Error while checking the equality between $names and $values, the count of the arrays values is different', 500);
        }
        return false;
    }
    
    public function execute() : self 
    {
        try {
            
            $query = $this->database->execute($this->currentQuery);
            $query->execute($this->parameters);
            $this->executedQuery = $query;
            
            return true;
        } catch (\PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: execute] Error while executing the current pdo query'."\n".'More informations from PDOException: '.$e, 500);
        }
        return false;
    }
    
    public function loadObjectList() : array 
    {
        try {
            return $this->executedQuery->fetchAll(\PDO::FETCH_OBJ);
        } catch (PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: loadObjectList] Error while fetching the datas of current pdo query'."\n".'More informations from PDOException'.$e, 500);
        }
        return false;
    }
    
    public function loadAssocs() : array 
    {
        try {
            return $this->executedQuery->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: loadAssocs] Error while fetching the datas of current pdo query'."\n".'More informations from PDOException'.$e, 500);
        }
        return false;
    }
    
    public function loadColumns() : array 
    {
        try {
            return $this->executedQuery->fetchAll(\PDO::FETCH_COLUMN);
        } catch (PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: loadColumns] Error while fetching the datas of current pdo query'."\n".'More informations from PDOException'.$e, 500);
        }
        return false;
    }
    
    public function loadAssoc() : array 
    {
        try {
            return $this->executedQuery->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: loadAssoc] Error while fetching the datas of current pdo query'."\n".'More informations from PDOException'.$e, 500);
        }
        return false;
    }
    
    public function loadObject() : \stdclass 
    {
        try {
            return $this->executedQuery->fetch(\PDO::FETCH_OBJ);
        } catch (PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: loadObject] Error while fetching the datas of current pdo query'."\n".'More informations from PDOException'.$e, 500);
        }
        return false;
    }
    
    public function loadColumn() : array 
    {
        try {
            return $this->executedQuery->fetch(\PDO::FETCH_COLUMN);
        } catch (PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: loadColumn] Error while fetching the datas of current pdo query'."\n".'More informations from PDOException'.$e, 500);
        }
        return false;
    }
    
    private function parameterExists(string $name)
    {
        return isset($this->parameters[$name]);
    }
    
}

?>