<?php

use Application\Logger;
use Application\Config;
use Application\Router;

return [
    Router::class => APPLICATION_PATH . '/src/Router.php',
    Config::class => APPLICATION_PATH . '/src/Config.php',
    Logger::class => APPLICATION_PATH . '/src/Logger.php',
];
