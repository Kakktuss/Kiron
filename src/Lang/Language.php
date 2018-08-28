<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/05/2018
 * Time: 17:54
 */

namespace Kiron\Lang;

use Kiron\File\Ini;
use Kiron\Lang\Config as LangConfig;

class Language
{
    /**
     * @var LangConfig
     */
    public $config;
    /**
     * @var string
     */
    private $lang;
    /**
     * @var null|string
     */
    private $basePart = null;
    /**
     * @var array
     */
    private $files = [];

    /**
     * Lang constructor.
     * @param string $lang
     * @param string|null $part
     */
    public function __construct(string $lang, string $part = null)
    {
        $this->lang = $lang;

        $this->basePart = $part;

        $this->config = new LangConfig();
    }

    /**
     * @param string $lang
     */
    public function setLang(string $lang)
    {
        if($this->lang !== $lang) {
            $this->lang = $lang;
            return true;
        }
        return false;
    }

    public function addFile(string $fileName, string $part = null)
    {
        if(!$this->fileExists($fileName))
        {
            $filePath = ROOT.DS.APPLICATION_PATH.DS.$part ?? $this->basePart.DS.LANG_PATH.DS.$fileName.'.php';

            if(file_exists($filePath)) {
                $this->files[$fileName] = ['file' => new Ini($filePath), 'use' => true];
                return true;
            }
        }
        return false;
    }

    public function useFile(string $fileName, bool $use)
    {
        if($this->fileExists($fileName))
        {
            $this->files[$fileName]['use'] = $use;
        }
    }

    public function deleteFile(string $fileName)
    {
        if($this->fileExists($fileName))
        {
            unset($this->files[$fileName]);
            return true;
        }
        return false;
    }

    public function getKey(string $keyName)
    {
        foreach ($this->files as $key => $file)
        {
            if($file['use'] === true)
            {
                $value = $file['file']->getKey($keyName);
                if($value !== false)
                    return $value;
            }
        }
        return false;
    }

    private function fileExists(string $fileName)
    {
        return isset($this->files[$fileName]);
    }
}