<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15/07/2018
 * Time: 22:23
 */

namespace Kiron\File;

use Kiron\File\Interfaces\File as BaseFile;
use Kiron\File\Exception\File as FileException;

abstract class File implements BaseFile
{
    protected $filePath;

    public function __construct(string $path)
    {
        $this->filePath = $path;
    }

    public function createFile()
    {
        if(!$this->fileExists())
        {
            file_put_contents($this->filePath, '');
            return true;
        } else {
            throw new FileException('[Kiron:File => BaseFile: createFile] File already exists');
        }
    }

    public function resetFileContent()
    {
        if($this->fileExists())
        {
             file_put_contents($this->filePath, '');
             return true;
        } else {
            throw new FileException('[Kiron:File => BaseFile: resetFile] File doesn\'t exists');
        }
    }

    public function deleteFile()
    {
        if($this->fileExists())
        {
            unlink($this->filePath);
            return true;
        } else {
            throw new FileException('[Kiron:File => BaseFile: deleteFile] File doesn\'t exists');
        }
    }

    protected function fileExists()
    {
        return file_exists($this->filePath);
    }
}