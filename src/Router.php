<?php

namespace Application;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = (new Config())->getConfig('routes');
    }

    public function getRoute(): array
    {
        (new Logger())->debug($this->routes);
        $currentUrl   = $_SERVER['REQUEST_URI'];
        $currentroute = [];

        foreach ($this->routes as $route) {
            
        }

        return [];
    }
}