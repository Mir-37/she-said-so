<?php

namespace Mir\TruthWhisper\router;

use Exception;
use Mir\TruthWhisper\model\Logger;

class Route
{
    private array $routes = [];
    private string $url_path;
    private string $base_url = BASE_URL;

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
            if (!preg_match("#^{$route['path']}(?<id>[0-9]*)/?$#", $path,  $match) || $route['method'] != $method) {
                continue;
            }
            $id = $match["id"] ?? null;
            list($class_name, $function_name) = $route["controller"];

            try {
                $controller_instance = new $class_name;
                if ($id) {
                    $controller_instance->$function_name($id);
                } else {
                    $controller_instance->$function_name();
                }
                $route["dispatched"] = true;
                return;
            } catch (\Throwable $th) {
                throw $th;
                $this->returnBadRequest($th->getMessage(), 500);
                return;
            }
        }
        $this->returnBadRequest("Not Found", 404);
    }

    private function normalizePath(string $url_path): string
    {
        $url_path = str_replace($this->base_url, "", $url_path);
        $url_path = trim($url_path, "/");
        $url_path = "/{$url_path}/";
        $url_path = preg_replace("#[/]{2,}#", '/', $url_path);

        return $url_path;
    }

    private function returnBadRequest(string $message, int $code): void
    {
        http_response_code($code);
        $logger = new Logger();
        $logger->message = $message;
        $logger->created_at = date("Y-m-d", time());
        $logger->save();
    }
}
