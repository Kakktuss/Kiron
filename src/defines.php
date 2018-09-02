<?php

$config = Kiron\Config\Config::getInstance();

$GLOBALS['http'] = new Kiron\Http\Bag();
$GLOBALS['config'] = Kiron\Config\Config::getInstance();

/**
 * Root & utils (DS)
 */
define('ROOT', $config->getPathInformations()['RootPath']);
define('APPLICATION_PATH', $config->getPathInformations()['ApplicationPath']);
define('LANG_PATH', $config->getPathInformations()['LangPath']);
define('DS', DIRECTORY_SEPARATOR);
/**
 * MVC
 */
define('MODEL_PATH', $config->getPathInformations()['ModelPath']);
define('CONTROLLER_PATH', $config->getPathInformations()['ControllerPath']);
define('VIEW_PATH', $config->getPathInformations()['ViewPath']);
define('DEFAULT_HTML_FILE', $config->getPathInformations()['DefaultHtmlFile']);