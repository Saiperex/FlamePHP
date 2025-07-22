<?php

namespace Flame\Routing;

use Flame\Response\ActionResponse;
use Flame\Response\MiddlewareResponse;
use Exception;
use PDO;

final class ActionRouter
{
    private array $routes;
    private ?PDO $pdo;
    private array $data;
    private array $files;

    public function __construct(?PDO $pdo = null, array $data = [], array $files = [])
    {
        $this->pdo = $pdo;
        $this->data = $data;
        $this->files = $files;
        $this->routes = $this->loadRoutes($_ENV['ACTION_ROUTES_FILE'] ?? 'App/Config/actions.php');
    }

    private function loadRoutes(string $routesPath): array
    {
        $routesFile = __DIR__ . '/../../' . $routesPath;

        if (!file_exists($routesFile) || !is_readable($routesFile)) {
            throw new Exception("Archivo de rutas de acción inválido: $routesFile");
        }

        $routes = require $routesFile;

        if (!is_array($routes)) {
            throw new Exception("El archivo de rutas de acción '$routesFile' no devolvió un array.");
        }

        return $routes;
    }

    public function dispatch(): void
    {
        $actionKey = $this->data['data-name'] ?? null;

        if (!$actionKey || !isset($this->routes[$actionKey])) {
            throw new Exception("No se encontró una acción válida para: '$actionKey'");
        }

        $route = $this->routes[$actionKey];

        // Procesamiento de middlewares (encadenados)
        $processedData = $this->data;
        $processedFiles = $this->files;

        foreach ($route['middlewares'] ?? [] as $middlewareConfig) {
            $middlewareName = $middlewareConfig['middleware-name'] ?? null;
            $middlewareTarget = $middlewareConfig['middleware-data'] ?? 'data'; // data o files
            $expectedResult = $middlewareConfig['middleware-result'] ?? true;

            if (!$middlewareName) {
                throw new Exception("Middleware sin nombre definido en acción '$actionKey'.");
            }

            $namespace = rtrim($_ENV['MIDDLEWARE_NAMESPACE'] ?? 'App\\Middleware', '\\');
            $className = "$namespace\\$middlewareName";

            if (!class_exists($className)) {
                throw new Exception("El middleware '$className' no existe.");
            }

            $middlewareInstance = $this->pdo
                ? new $className($this->pdo)
                : new $className();

            if (!method_exists($middlewareInstance, 'handle')) {
                throw new Exception("El middleware '$className' no tiene un método 'handle'.");
            }

            $input = $middlewareTarget === 'files' ? $processedFiles : $processedData;

            /** @var MiddlewareResponse $response */
            $response = $middlewareInstance->handle($input);

            if ($response->success !== $expectedResult) {
                throw new Exception("Middleware '$className' falló en acción '$actionKey'.");
            }

            // Actualizar data o files según corresponda
            if ($middlewareTarget === 'files') {
                $processedFiles = is_array($response->data) ? $response->data : [];
            } else {
                $processedData = is_array($response->data) ? $response->data : [];
            }
        }

        // Ejecutar acción
        $actionName = $route['action'] ?? null;
        if (!$actionName) {
            throw new Exception("Acción no definida para la clave '$actionKey'.");
        }

        $namespace = rtrim($_ENV['ACTION_NAMESPACE'] ?? 'App\\Actions', '\\');
        $actionClass = "$namespace\\$actionName";

        if (!class_exists($actionClass)) {
            throw new Exception("La clase de acción '$actionClass' no existe.");
        }

        $actionInstance = $this->pdo
            ? new $actionClass($this->pdo)
            : new $actionClass();

        if (!method_exists($actionInstance, 'handle')) {
            throw new Exception("La clase '$actionClass' no tiene un método 'handle'.");
        }

        // Ejecutar la acción y obtener el ActionResponse
        /** @var ActionResponse $response */
        $response = $actionInstance->handle($processedData, $processedFiles);

        if (!$response instanceof ActionResponse) {
            throw new Exception("La acción '$actionClass' no devolvió un ActionResponse válido.");
        }

        header('Content-Type: application/json');
        echo $response->toJson();
        exit;
    }
}
