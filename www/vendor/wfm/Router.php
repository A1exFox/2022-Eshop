<?php

declare(strict_types=1);

namespace wfm;

use Exception;

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

    public static function removeQueryString(string $url): string
    {
        if (strlen($url) > 0) {
            $params = explode("&", $url, 2);
            if (false === str_contains($params[0], "=")) {
                $params[0] = rtrim($params[0], '/');
                return $params[0];
            }
        }
        return '';
    }

    public static function dispatch(string $url): void
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            if (!empty(self::$route['lang'])) {
                App::$app->setProperty('lang', self::$route['lang']);
            }
            $route = self::$route;
            $controller = '\app\controllers\\' .
                $route['admin_prefix'] .
                $route['controller'] .
                'Controller';
            if (class_exists($controller)) {
                /** @var Controller $controllerObject */
                $controllerObject = new $controller($route);

                $controllerObject->getModel();

                $action = self::lowerCamelCase($route['action'] . 'Action');
                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView();
                } else {
                    throw new Exception("Action $controller::$action is not found", 404);
                }
            } else {
                throw new Exception("Controller $controller is not found", 404);
            }
        } else {
            throw new Exception("Page is not found", 404);
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
                    $route['admin_prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
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
