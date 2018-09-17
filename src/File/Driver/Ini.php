<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15/07/2018
 * Time: 22:28
 */

namespace Kiron\File\Driver;

use Kiron\File\Exception;
use Kiron\File\File;

class Ini extends File
{
    private $keys;

    public function __construct(string $path)
    {
        parent::__construct($path);
        $this->keys = parse_ini_file($this->filePath);
    }

    public function getKey($keyName)
    {
        if($this->fileExists())
        {
            if($this->keyExists($keyName))
            {
                return $this->keys[$keyName];
            } else {
                return false;
            }
        } else {
            $this->createFile();
            return false;
        }
    }

    public function addKey($keyName, $value, $quoted = true)
    {
        if($this->fileExists())
        {
            if(!$this->keyExists($keyName))
            {
                $this->keys[$keyName] = $value;
                $content = '';
                foreach ($this->keys as $key => $value)
                {
                    $content .= $key.'='.$value."\n";
                }
                file_put_contents($this->filePath, $content);
                return true;
            } else {
                throw new Exception('[Kiron:File => File\Ini: addKey] Error while adding a new key: '.$keyName.' already exists');
            }
        } else {
            $this->createFile();
            $this->addKey($keyName, $value, $quoted);
            return true;
        }
    }

    public function alterKey($keyName, $value, $quoted = true)
    {
        if($this->fileExists())
        {
            if($this->keyExists($keyName))
            {
                $this->keys[$keyName] = $value;
                $content = '';
                foreach ($this->keys as $key => $value)
                {
                    $content .= $key.'='.$value."\n";
                }
                file_put_contents($this->filePath, $content);
                return true;
            } else {
                throw new Exception('[Kiron:File => File\ini: alterKey] Error while altering key: '.$keyName.' doesn\'t exists');
            }
        } else {
            $this->createFile();
            $this->addKey($keyName, $value, $quoted);
            return true;
        }
        return false;
    }

    public function deleteKey($keyName)
    {
        if($this->fileExists())
        {
            if(isset($this->keys))
            {
                 if($this->keyExists($keyName))
                {
                    unset($this->keys[$keyName]);
                    $content = '';
                    foreach ($this->keys as $key => $value)
                    {
                        $content .= $key.'='.$value."\n";
                    }
                    file_put_contents($this->filePath, $content);
                } else {
                    throw new Exception('[File: ini] => deleteKey: key '.$keyName.' don\'t exist');
                }
            } else {
                $this->init();
                return;
            }
        } else {
            $this->createFile();
            return;
        }
    }

    protected function keyExists($keyName)
    {
        return isset($this->keys[$keyName]);
    }
}