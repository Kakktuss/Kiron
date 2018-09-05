<?php

namespace Kiron\Database\Builder;

use \PDO;
use \PDOException;
use Kiron\Database\Exception\Builder as BuilderException;
use Kiron\Database\Interfaces\Builder as BuilderInterface;

abstract class Builder implements BuilderInterface {
    
    protected $database;
    
    protected $parameters = [];
    
    protected $oldQuery = [];
    
    private $currentQuery = '';
    
    private $executedQuery;
    
    public function __construct(PDO $database) {
        $this->database = $database;
    }

    abstract public function select($table, $columns = null) : self;

    abstract public function insert($table, $columns) : self;

    abstract public function delete($table, $columns) : self;

    abstract public function update($table) : self;

    abstract public function innerJoin(string $table, $firstCond, $secondCond);

    abstract public function leftJoint(string $table, $firstCond, $secondCond);

    abstract public function rightJoin(string $table, $firstCond, $secondCond);

    abstract public function fullJoin(string $table, $firstCond, $secondCond);

    abstract public function from($table) : self;

    abstract public function value(string $name, string $value) : self;

    abstract public function values(array $names, array $values) : self;

    abstract public function where($table, $equal) : self;

    abstract public function set($columns, $values);

    public function appendParameter(string $name, $value) : self
    {
        if(!$this->parameterExists($name))
        {
            $this->parameters[$name] = $value;
            return $this;
        }
        throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: appendParameter] Error while appening a parameter, parameter \''.$name.'\' already exists', 500);
    }
    
    public function appendParameters(array $names, array $values) : self
    {
        if(count($names) === count($values))
        {
            foreach($names as $key => $name)
            {
                if(!$this->parameterExists($name))
                    $this->parameters[$name] = $values[$key];
                else
                    throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: appendParameters] Error while appening a parameter, parameter\''.$name.'\' already exists', 500);
            }
            return $this;
        }
        throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: appendParameters] Error while checking the equality between $names and $values, the count of the arrays values is different', 500);
    }
    
    public function execute() : self 
    {
        try {
            
            $query = $this->database->prepare($this->currentQuery);
            $query->execute($this->parameters);
            $this->executedQuery = $query;
            
            return true;
        } catch (\PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: execute] Error while executing the current pdo query'."\n".'More informations from PDOException: '.$e, 500);
        }
    }
    
    public function loadObjectList() : array 
    {
        try {
            return $this->executedQuery->fetchAll(\PDO::FETCH_OBJ);
        } catch (PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: loadObjectList] Error while fetching the datas of current pdo query'."\n".'More informations from PDOException'.$e, 500);
        }
    }
    
    public function loadAssocs() : array 
    {
        try {
            return $this->executedQuery->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: loadAssocs] Error while fetching the datas of current pdo query'."\n".'More informations from PDOException'.$e, 500);
        }
    }
    
    public function loadColumns() : array 
    {
        try {
            return $this->executedQuery->fetchAll(\PDO::FETCH_COLUMN);
        } catch (PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: loadColumns] Error while fetching the datas of current pdo query'."\n".'More informations from PDOException'.$e, 500);
        }
    }
    
    public function loadAssoc() : array 
    {
        try {
            return $this->executedQuery->fetch(\PDO::FETCH_ASSOC);
        } catch (PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: loadAssoc] Error while fetching the datas of current pdo query'."\n".'More informations from PDOException'.$e, 500);
        }
    }
    
    public function loadObject() : \stdclass 
    {
        try {
            return $this->executedQuery->fetch(\PDO::FETCH_OBJ);
        } catch (PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: loadObject] Error while fetching the datas of current pdo query'."\n".'More informations from PDOException'.$e, 500);
        }
    }
    
    public function loadColumn() : array 
    {
        try {
            return $this->executedQuery->fetch(\PDO::FETCH_COLUMN);
        } catch (PDOException $e)
        {
            throw new BuilderException('[Kiron:Database => Builder\BaseBuilder: loadColumn] Error while fetching the datas of current pdo query'."\n".'More informations from PDOException'.$e, 500);
        }
    }
    
    private function parameterExists(string $name)
    {
        return isset($this->parameters[$name]);
    }
    
}

?>