<?php

use Kiron\Mvc\Config\Parser as MvcConfig;
use Kiron\File\Config\Parser as FileConfig;

$config = Kiron\Config\Config::getInstance();
$mvcconfig = MvcConfig::getInstance();
$fileconfig = FileConfig::getInstance();

$GLOBALS['http'] = Kiron\Utils\HttpBag::getInstance();

/**
 * Root & utils (DS)
 */
define('ROOT', $fileconfig->getRootPath());
define('APPLICATION_PATH', $fileconfig->getApplicationPath());
define('LANG_PATH', $fileconfig->getLangPath());
define('CACHE_PATH', $fileconfig->getCachePath());
define('DS', DIRECTORY_SEPARATOR);
/**
 * MVC
 */
define('MODEL_PATH', $mvcconfig->getModelPath());
define('CONTROLLER_PATH', $mvcconfig->getControllerPath());
define('VIEW_PATH', $mvcconfig->getViewPath());
define('DEFAULT_HTML_FILE', $mvcconfig->getDefaultView());