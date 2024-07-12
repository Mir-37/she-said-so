<?php

namespace Mir\TruthWhisper\router;

use Exception;

class Route
{
    private array $routes = [];
    private string $url_path;

    public function __construct()
    {
        $this->url_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

    public function add(string $http_method, string $url_path, array $controller): void
    {
        $path = $this->normalizePath($url_path);
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($http_method),
            'controller' => $controller,
            'dispatched' => false
        ];
    }

    public function dispatch(): void
    {
        $path = $this->normalizePath($this->url_path);
        $method = strtoupper($_SERVER["REQUEST_METHOD"]);
        foreach ($this->routes as $route) {
            if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] != $method) {
                continue;
            }

            list($class_name, $function_name) = $route["controller"];

            try {
                $controller_instance = new $class_name;
                $controller_instance->$function_name();
                $route["dispatched"] = true;
                return;
            } catch (\Throwable $th) {
                $this->returnBadRequest("Class name or function name is invalid");
                return;
            }
        }
        $this->returnBadRequest("Not Found");
    }

    private function normalizePath(string $url_path): string
    {
        $url_path = trim($url_path, "/");
        $url_path = "/{$url_path}/";
        $url_path = preg_replace("#[/]{2,}#", '/', $url_path);
        return $url_path;
    }

    private function returnBadRequest(string $message): mixed
    {
        http_response_code(400);
        return json_encode($message);
    }
}
