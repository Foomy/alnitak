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
        $currentRoute = current(array_filter($this->routes, function ($routeSet) {
            return ($_SERVER['REQUEST_URI'] === $routeSet['route']);
        }));

        return [];
    }
}