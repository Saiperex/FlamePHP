<?php

declare(strict_types=1);

namespace Flame\Routing;

use Exception;
use PDO;
use Flame\Routing\Redirection;

final class WebRouter
{
    private array $routes;
    private ?PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->routes = $this->loadRoutes($_ENV['WEB_ROUTES_FILE'] ?? '/routes/web.php');
        $this->pdo = $pdo;
    }
    private function loadRoutes(string $routesPath): array
    {
        $routesFile = __DIR__ . '/../../' . $routesPath;

        if (!file_exists($routesFile) || !is_readable($routesFile) || !is_file($routesFile)) {
            throw new Exception("Archivo de rutas inválido: $routesFile");
        }

        $routes = require $routesFile;

        if (!is_array($routes)) {
            throw new Exception("El archivo de rutas '$routesFile' no devolvió un array.");
        }

        return $routes;
    }
    public function dispatch(): void
    {
        $routeKey = $_GET['page'] ?? 'home';

        if (!isset($this->routes[$routeKey])) {
            http_response_code(404);
            header("Location: " . ($_ENV['FALLBACK'] ?? '404'));
            exit;
        }

        $route = $this->routes[$routeKey];

        // Ejecutar middlewares si existen
        if (!empty($route['middlewares'])) {
            foreach ($route['middlewares'] as $middlewareConfig) {
                $middlewareName = $middlewareConfig['middleware-name'] ?? null;
                $expectedResult = $middlewareConfig['middleware-result'] ?? true;

                if (!$middlewareName) {
                    throw new Exception("Nombre de middleware no definido en la ruta '$routeKey'.");
                }
                //usaremos el namespace base de los middlewares
                $middlewareNamespace = rtrim($_ENV['MIDDLEWARE_NAMESPACE'] ?? 'App\\Middlewares', '\\');
                // Construir el nombre completo de la clase del middleware
                $middlewareClass = $middlewareNamespace . '\\' . $middlewareName;
                if (!class_exists($middlewareClass)) {
                    throw new Exception("El middleware '$middlewareClass' no existe.");
                }
                // Vamos a instanciar el middleware pero antes vamos a ver si va a tener conexión a la base de datos
                $auth_conn = filter_var($_ENV['DB_ACTIVATION'] ?? false, FILTER_VALIDATE_BOOLEAN);
                $middlewareInstance = $auth_conn
                    ? new $middlewareClass($this->pdo)
                    : new $middlewareClass();

                // Ejecutar el middleware y guardamos la respuesta
                if (!method_exists($middlewareInstance, 'handle')) {
                    throw new Exception("El middleware '$middlewareClass' no tiene un método 'handle'.");
                }
                $middlewareResponse = $middlewareInstance->handle();

                // Verificar si el resultado del middleware es el esperado
                if ($middlewareResponse->success !== $expectedResult) {
                    // Si el middleware falla, redirigimos segun la configuración de redirección
                    $redirectionFile = __DIR__ . '/../../' . ($_ENV['REDIRECTION_FILE'] ?? 'App/Config/redirections.php');
                    // Verificamos si el archivo de redirección existe
                    if (!file_exists($redirectionFile)) {
                        throw new Exception("El archivo de redirección '$redirectionFile' no existe.");
                    }
                    // Cargamos las redirecciones
                    $redirections = require $redirectionFile;
                    $redirect = new Redirection();
                    $redirect->handle($routeKey, $redirections);
                }
            }
        }
        // Ahora vamos a cargar el controlador
        $controllerName = $route['controller'] ?? null;
        //usaremos el namespace base de los controllers
        $controllerNamespace = rtrim($_ENV['CONTROLLER_NAMESPACE'] ?? 'App\\Controllers', '\\');
        // Construir el nombre completo de la clase del controller
        $controllerClass = $controllerNamespace . '\\' . $controllerName;
        if (!class_exists($controllerClass)) {
            throw new Exception("El controlador '$controllerClass' no existe.");
        }
        // Vamos a instanciar el controller pero antes vamos a ver si va a tener conexión a la base de datos
        $auth_conn = filter_var($_ENV['DB_ACTIVATION'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $controllerInstance = $auth_conn
            ? new $controllerClass($this->pdo)
            : new $controllerClass();
        //Ejecutamos el método index del controlador
        if (!method_exists($controllerInstance, 'index')) 
        {
            throw new Exception("El controlador '$controllerClass' no tiene un método 'index'.");
        }
        $controllerInstance->index();
    }
}
// End of file: Flame/Routing/WebRouter.php
// Location: Flame/Routing/WebRouter.php