<?php

namespace Mir\TruthWhisper\router;

class Route
{
    private array $routes = [];

    public function add(string $http_method, string $url_path, array $controller): void
    {
        $path = $this->normalizePath($url_path);
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($http_method),
            'controller' => $controller,
            // 'middlewares' => []
        ];
    }

    public function dispatch(string $url_path): void
    {
        $path = $this->normalizePath($url_path);
        $method = strtoupper($_SERVER["REQUEST_METHOD"]);

        foreach ($this->routes as $route) {
            if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] != $method) {
                continue;
            }

            list($class_name, $function_name) = $route["controller"];

            try {
                $controller_instance = new $class_name;
                $controller_instance->$function_name();
            } catch (\Throwable $th) {
                throw "Class name or function name is invalid";
            }
        }
    }

    private function normalizePath(string $url_path): string
    {
        $url_path = trim($url_path, "/");
        $url_path = "/{$url_path}/";
        $url_path = preg_replace("#[/]{2,}#", '/', $url_path);
        return $url_path;
    }
}
