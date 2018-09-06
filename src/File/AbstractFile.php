<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/09/2018
 * Time: 15:45
 */

namespace Kiron\File;

use Kiron\File\Interfaces\File;

abstract class AbstractFile implements File
{


    abstract public function createFile();
    
    abstract public function resetFileContent();

    abstract public function deleteFile();

}