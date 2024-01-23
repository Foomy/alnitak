<?php

namespace Application;

class BootUp
{
    private array $route;

    public function initAutoloader(): BootUp
    {
        spl_autoload_register(static function ($class) {
            $autoloadCfg = require APPLICATION_PATH . '/config/autoloader.php';

            if (array_key_exists($class, $autoloadCfg) && file_exists($autoloadCfg[$class])) {
                require $autoloadCfg[$class];
                return true;
            }

            return false;
        });

        $controllerPath = APPLICATION_PATH . '/src/Controller/';
        $controllerDir  = dir($controllerPath);

        while (false !== ($entry = $controllerDir->read())) {
            if (!in_array($entry, ['.', '..'])) {
                require $controllerPath . $entry;
            }
        }

        return $this;
    }

    public function initRouter(): BootUp
    {
        $router      = new Router();
        $this->route = $router->getRoute();

        return $this;
    }

    public function run(): void
    {
        $controller = $this->route['controller'];
        $method     = $this->route['method'];

        (new $controller())->$method();
    }
}