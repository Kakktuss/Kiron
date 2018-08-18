<?php

$config = Kiron\Config\Config::getInstance();

define('FRAMEWORK_PATH', $config->getPathInformations()['FrameworkPath']);
define('APPLICATION_PATH', $config->getPathInformations()['ApplicationPath']);