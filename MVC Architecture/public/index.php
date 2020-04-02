<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('DS', DIRECTORY_SEPARATOR);
define('PUBLIC_PATH', dirname(realpath(__FILE__)));
define('BASE_PATH', dirname(PUBLIC_PATH));
define('ROOT', dirname(dirname(__FILE__)));
define('VIEWS_PATH', ROOT.DS.'views');
define('ASSETS_PATH', 'public');
require_once(ROOT.DS.'App'.DS.'lib'.DS.'init.php');


App::runs($_SERVER["REQUEST_URI"]);

?>