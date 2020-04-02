<?php


ini_set('max_execution_time', 3000000);
require_once (ROOT . DS .'vendor/autoload.php');
require_once (ROOT . DS . 'configs' . DS . 'Configs.php');
require_once (dirname(dirname(__FILE__)).DS.'Core' . DS . 'Helpers.php');
App::startSession();
