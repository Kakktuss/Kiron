<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22/08/2018
 * Time: 18:46
 */

namespace Kiron\Lang;

use Kiron\File\Ini;

class Config
{

    private $config;

    private $supports = [];

    private $baseLang;

    public function __construct()
    {
        $this->config = new Ini(__DIR__.DS.'config.ini');
    }

    public function getSupports()
    {
        if(!isset($this->supports))
        {
            $this->supports = explode(', ', $this->config->getKey('LANGUAGE_SUPPORT'));
        }
        return $this->supports;
    }

    public function getBaseLanguage()
    {
        if(!isset($this->baseLang))
        {
            $this->baseLang = $this->config->getKey('BASE_LANGUAGE');
        }
        return $this->baseLang;
    }

    public function setBaseLanguage($lang)
    {
        if($lang !== $this->getBaseLanguage())
        {
            $this->config->alterKey('BASE_LANGUAGE', $lang);
            return true;
        }
        return false;
    }

    public function addSupport($lang)
    {
        if(!$this->supportExists($lang))
        {
            $this->supports[] = $lang;
            $this->putSupports();
            return true;
        }
        return false;
    }

    public function deleteSupport($lang)
    {
        if($this->supportExists($lang))
        {
            unset($this->supports[array_search($lang, $this->supports)]);
            $this->putSupports();
            return true;
        }
        return false;
    }

    private function supportExists($lang)
    {
        $this->getSupports();
        return array_key_exists($lang, $this->supports);
    }

    private function putSupports()
    {
        $this->config->alterKey('LANGUAGE_SUPPORT', implode(', ', $this->supports));
    }

}