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

        return $this;
    }

    public function initRouter (): BootUp
    {
        $router = new Router();
        $this->route = $router->getRoute();

        return $this;
    }

    public function run(): void
    {
        //@todo call controller specified in config for current route
    }
}