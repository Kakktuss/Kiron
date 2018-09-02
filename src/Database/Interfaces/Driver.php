<?php

namespace Kiron\Database\Interfaces;

use Kiron\Database\Builder\Builder as BaseBuilder;

interface Driver {
        
    public function getDatabase() : \PDO;
    
    public function getBuilder();
    
}

?>