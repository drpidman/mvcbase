<?php

namespace App;

class Router
{
    public function __invoke(RouteCollection $routes)
    {
        $arrayUri = explode('?', $_SERVER["REQUEST_URI"]);
        $matcher = $this->match($arrayUri[0], $routes);

        if ($matcher) {
            $controllerClass = $matcher->controller;
            $classInstance = new $controllerClass();

            call_user_func_array(array($classInstance, $matcher->method), array("routes" => $routes));
        } else {
            include_once "../views/components/404.php";
            header("HTTP/1.1 404 Not Found");
        }
    }

    public function match(string $uri, RouteCollection $routes)
    {
        foreach ($routes->getAll() as $name => $route) {
            if (strpos($route->pathname, ':') !== false) {
                $pattern = str_replace('/', '\/', $route->pathname);
                $pattern = preg_replace('/:[^\/]+/', '([^/]+)', $pattern);
                $regex = "#^" . $pattern . "$#";
                if (preg_match($regex, $uri, $matches)) {
                    $params = [];
                    preg_match_all('/:[^\/]+/', $route->pathname, $paramNames);
                    foreach ($paramNames[0] as $index => $paramName) {
                        $params[] = $matches[$index + 1];
                    }
                    $route->params = $params;
                    return $route;
                }
            } elseif ($route->pathname === $uri) {
                return $route;
            }
        }
        return null;
    }
}


$router = new Router();
$router($routes);
