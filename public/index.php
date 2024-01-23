<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', dirname(__DIR__));

require_once APPLICATION_PATH . '/src/BootUp.php';

(new Application\BootUp())
    ->initAutoloader()
    ->initRouter()
    ->run();
