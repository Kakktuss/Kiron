<?php

$config = Kiron\Config\Config::getInstance();

/**
 * Root & utils (DS)
 */
define('ROOT', $config->getPathInformations()['ROOT']);
define('APPLICATION_PATH', $config->getPathInformations()['ApplicationPath']);
define('LANG_PATH', $config->getPathInformations()['LANG']);
define('DS', DIRECTORY_SEPARATOR);
/**
 * MVC
 */
define('MODEL_PATH', $config->getPathInformations()['MODEL']);
define('CONTROLLER_PATH', $config->getPathInformations()['CONTROLLER']);
define('VIEW_PATH', $config->getPathInformations()['VIEW']);