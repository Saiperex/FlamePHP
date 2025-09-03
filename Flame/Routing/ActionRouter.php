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
            $middlewareTarget = $middlewareConfig['middleware-target'] ?? 'data'; 
            $expectedResult = $middlewareConfig['middleware-result'] ?? true;

            if (!$middlewareName) 
            {
                $respuesta = new ActionResponse(false, '#message', '<div class="alert alert-danger">Middleware sin nombre definido en acción '.$actionKey.'.</div>');
                echo $respuesta->toJson();
                exit;
            }

            $namespace = rtrim($_ENV['MIDDLEWARE_NAMESPACE'] ?? 'App\\Middleware', '\\');
            $className = "$namespace\\$middlewareName";

            if (!class_exists($className)) 
            {
                $respuesta = new ActionResponse(false, '#message', '<div class="alert alert-danger">El middleware '.$className.' no existe.</div>');
                echo $respuesta->toJson();
                exit;
            }
            $input = $middlewareTarget === 'files' ? $processedFiles : $processedData;
            $middlewareInstance = $this->pdo
                ? new $className($this->pdo, $input)
                : new $className(null,$input);

            if (!method_exists($middlewareInstance, 'handle')) 
            {
                $respuesta = new ActionResponse(false, '#message', '<div class="alert alert-danger">El middleware '.$className.' no tiene un método handle</div>');
                echo $respuesta->toJson();
                exit;
            }

            /** @var MiddlewareResponse $response */
            $response = $middlewareInstance->handle();

            if ($response->success !== $expectedResult) 
            {
                $respuesta = new ActionResponse(false, '#message', '<div class="alert alert-warning">'.$response->data.'</div>');
                echo $respuesta->toJson();
                exit;
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
        if (!$actionName) 
        {
            $respuesta = new ActionResponse(false, '#message', '<div class="alert alert-danger">Acción no definida para la clave '.$actionKey.'</div>');
            echo $respuesta->toJson();
            exit;
        }

        $namespace = rtrim($_ENV['ACTION_NAMESPACE'] ?? 'App\\Actions', '\\');
        $actionClass = "$namespace\\$actionName";

        if (!class_exists($actionClass)) 
        {
            $respuesta = new ActionResponse(false, '#message', '<div class="alert alert-danger">La clase de acción '.$actionClass.' no existe</div>');
            echo $respuesta->toJson();
            exit;
        }

        $actionInstance = $this->pdo
            ? new $actionClass($this->pdo, $processedData, $processedFiles)
            : new $actionClass(null, $processedData, $processedFiles);

        if (!method_exists($actionInstance, 'handle')) 
        {
            $respuesta = new ActionResponse(false, '#message', '<div class="alert alert-danger">La clase '.$actionClass.' no tiene un método handle</div>');
            echo $respuesta->toJson();
            exit;
        }

        // Ejecutar la acción y obtener el ActionResponse
        /** @var ActionResponse $response */
        $response = $actionInstance->handle($processedData, $processedFiles);

        if (!$response instanceof ActionResponse) 
        {
            $respuesta = new ActionResponse(false, '#message', '<div class="alert alert-danger">La acción '.$actionClass.' no devolvió un ActionResponse válido</div>');
            echo $respuesta->toJson();
            exit;
        }

        header('Content-Type: application/json');
        echo $response->toJson();
        exit;
    }
}
