<?php

namespace Application;

class BootUp
{
    private array $route;

    public function initAutoloader(): BootUp
    {
        // autoload from config
        spl_autoload_register(static function ($class) {
            $autoloadCfg = require APPLICATION_PATH . '/config/autoloader.php';

            if (array_key_exists($class, $autoloadCfg) && file_exists($autoloadCfg[$class])) {
                require $autoloadCfg[$class];
                return true;
            }

            return false;
        });

        // autoload from directory
        $path      = APPLICATION_PATH . '/src/Controller/';
        $dir       = dir($path);
        $blacklist = ['.', '..'];
        $files     = [];

        while (false !== ($entry = $dir->read())) {
            if (!in_array($entry, $blacklist, true)) {
                $files[] = $path . $entry;
            }
        }

        sort($files, SORT_STRING);
        foreach ($files as $file) {
            require $file;
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