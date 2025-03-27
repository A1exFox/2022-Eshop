<?php

declare(strict_types=1);

namespace wfm;

class Router
{
    protected static array $routes = [];
    protected static array $route = [];

    public static function add(string $regexp, array $route = []): void
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function getRoute(): array
    {
        return self::$route;
    }

    public static function dispatch(string $url): void
    {
        if (self::matchRoute($url)) {
            echo "OK";
        } else {
            echo "NO";
        }
    }

    public static function matchRoute(string $url): bool
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                if (!isset($route['admin_prefix'])) {
                    $route['admin_prefix'] = '';
                } else {
                    $route['admin_prefix'] = '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                $route['action'] = self::lowerCamelCase($route['action']);
                debug($route);
                return true;
            }
        }
        return false;
    }

    protected static function upperCamelCase(string $name): string
    {
        $name = str_replace("-", " ", $name);
        $name = ucwords($name);
        $name = str_replace(" ", "", $name);
        return $name;
    }

    protected static function lowerCamelCase(string $name): string
    {
        $name = self::upperCamelCase($name);
        $name = lcfirst($name);
        return $name;
    }
}
