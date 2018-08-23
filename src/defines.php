<?php

$config = Kiron\Config\Config::getInstance();

define('FRAMEWORK_PATH', $config->getPathInformations()['FrameworkPath']);
define('APPLICATION_PATH', $config->getPathInformations()['ApplicationPath']);
define('VIEW_PATH', $config->getPathInformations()['ROOT']);
define('LANG_PATH', $config->getPathInformations()['ROOT']);
define('ROOT', $config->getPathInformations()['ROOT']);
define('DS', DIRECTORY_SEPARATOR);