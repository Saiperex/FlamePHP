<?php

namespace Flame\Run;

use Flame\Auth\Session;
use Flame\Core\ErrorHandler;
use Throwable;
use Flame\Core\EnvLoader;
use Flame\Core\Connection;
use Flame\Routing\WebRouter;
use Flame\Routing\ActionRouter;

/**
 * Clase principal.
 * 
 * Esta clase contiene métodos estáticos para gestionar excepciones, errores y la inicialización
 * de la aplicación, como el establecimiento de la zona horaria y la carga del entorno. También 
 * se encarga de manejar excepciones no atrapadas, errores fatales y no fatales durante la ejecución.
 * 
 * @package App\Run
 */
final class Flame
{
     /**
     * Establece la zona horaria global para la aplicación.
     *
     * @param string $timezone La zona horaria (ej. 'UTC', 'America/Argentina/Buenos_Aires').
     */
    public static function setTimezone(string $timezone): void
    {
        date_default_timezone_set($timezone);
    }

    /**
     * Configura el manejador para las excepciones no atrapadas (uncaught exceptions).
     * 
     * Las excepciones no atrapadas serán procesadas y registradas según el valor de la variable
     * de entorno `APP_DEBUG`. Si está habilitado el modo de depuración, se mostrará la traza del error.
     */
    public static function exceptionsNoAtrapadas(): void
    {
        set_exception_handler(
            function (Throwable $e) {
                ErrorHandler::logException($e);

                $debug = filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN);
                http_response_code(500);

                if ($debug) {
                    echo "<pre style='color:red;font-family:monospace'>";
                    echo "[Flame Uncaught Error] " . $e->getMessage() . "\n";
                    echo "Archivo: " . $e->getFile() . " (Línea " . $e->getLine() . ")\n";
                    echo "Traza:\n" . $e->getTraceAsString();
                    echo "</pre>";
                } else {
                    self::showGenericError();
                }
            }
        );
    }

    /**
     * Configura el manejador para los errores no fatales de PHP (warnings, notices, deprecated, etc.).
     * 
     * Los errores no fatales se mostrarán o se registrarán según el valor de la variable de entorno
     * `APP_DEBUG`. En caso de no estar habilitado el modo de depuración, se mostrará un mensaje genérico.
     */
    public static function exceptionsNoFatales(): void
    {
        set_error_handler(function (int $errno, string $errstr, string $errfile, int $errline) {
            $message = sprintf(
                'PHP Error [%d]: %s en %s:%d',
                $errno,
                $errstr,
                $errfile,
                $errline
            );

            ErrorHandler::log($message);

            // Manejo de errores en función del debug
            $debug = filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN);
            http_response_code(500);

            if ($debug) {
                echo "<pre style='color:orange;font-family:monospace'>";
                echo "[Flame Non-Fatal Error] $message\n";
                echo "Archivo: $errfile (Línea $errline)\n";
                echo "</pre>";
            } else {
                self::showGenericError();
            }

            // Retornar false para que siga el comportamiento estándar de PHP (mostrar el error si está habilitado)
            return false;
        });
    }

    /**
     * Configura el manejador para los errores fatales de PHP (E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR).
     * 
     * Si ocurre un error fatal, se manejará de forma especial dependiendo de si el modo de depuración está
     * habilitado o no.
     */
    public static function exceptionsFatales(): void
    {
        register_shutdown_function(function () {
            $error = error_get_last();
            $fatalTypes = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR];

            if ($error && in_array($error['type'], $fatalTypes)) {
                $message = sprintf(
                    'Fatal error: %s in %s on line %d',
                    $error['message'],
                    $error['file'],
                    $error['line']
                );

                ErrorHandler::log($message);

                $debug = filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN);
                http_response_code(500);

                if ($debug) {
                    echo "<pre style='color:red;font-family:monospace'>[Fatal] $message</pre>";
                } else {
                    self::showGenericError();
                }
            }
        });
    }

    /**
     * Muestra un mensaje genérico cuando ocurre un error inesperado y el modo de depuración no está habilitado.
     */
    private static function showGenericError(): void
    {
        echo "Ha ocurrido un error inesperado.";
    }
    /**
     * Método principal para iniciar la aplicación.
     * 
     * Este método realiza toda la inicialización necesaria y maneja las excepciones globales.
     */
    public static function run(): void
    {
        try {
            self::initialize();
        } catch (Throwable $e) {
            self::handleException($e);
        }
    }
    /**
     * Realiza la inicialización de la aplicación.
     * 
     * Carga el archivo `.env`, establece la conexión con la base de datos y
     * cualquier otra configuración necesaria antes de iniciar el router.
     */
    private static function initialize(): void
    {
        // 1. Cargar .env e inicio session
        EnvLoader::load();
        Session::sessionStart();
        // 2. Abrir conexión a la base de datos
        $auth_conn = filter_var($_ENV['DB_ACTIVATION'] ?? false, FILTER_VALIDATE_BOOLEAN);
        if ($auth_conn) {
            $pdo = Connection::getInstance();
        }

        // 3. Iniciar el router principal (De vistas)
        if ($auth_conn) {
            $router = new WebRouter($pdo);
        } else {
            $router = new WebRouter();
        }
        $router->dispatch();

        // 4. Cerrar la conexión a la base de datos
        Connection::close();
    }
     /**
     * Maneja las excepciones globales que ocurren durante la ejecución.
     * 
     * Si está habilitado el modo de depuración, se muestra la traza del error.
     * De lo contrario, se muestra un mensaje genérico.
     * 
     * @param Throwable $e La excepción que se ha producido.
     */
    private static function handleException(Throwable $e): void
    {
        // Manejo de errores global
        ErrorHandler::logException($e);

        $debug = filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN);

        if ($debug) {
            http_response_code(500);
            echo "<pre style='color:red;font-family:monospace'>";
            echo "[Flame Error] " . $e->getMessage() . "\n";
            echo "Archivo: " . $e->getFile() . " (Línea " . $e->getLine() . ")\n";
            echo "Traza:\n" . $e->getTraceAsString();
            echo "</pre>";
        } else {
            self::showGenericError();
        }
    }

     // Aqui comienza la parte del entry point de los action. 

    public static function runReactive(): void
    {
        try {
            self::initializeReactive();
        } catch (Throwable $e) {
            self::handleJsonException($e);
        }
    }

    private static function initializeReactive(): void
    {
        // Cargar entorno
        EnvLoader::load();

        // Determinar si se usa base de datos
        $auth_conn = filter_var($_ENV['DB_ACTIVATION'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $pdo = $auth_conn ? Connection::getInstance() : null;

        // Capturar datos del FormData y archivos
        $formData = $_POST;
        $fileData = $_FILES ?? [];

        // Instanciar ActionRouter con lo necesario
        if ($pdo) {
            $router = new ActionRouter($pdo, $formData, $fileData);
        } else {
            $router = new ActionRouter(null, $formData, $fileData);
        }

        // Ejecutar
        $router->dispatch();

        // Cerrar conexión
        Connection::close();
    }

    private static function handleJsonException(Throwable $e): void
    {
        ErrorHandler::logException($e);
        http_response_code(500);

        $debug = filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN);

        echo json_encode([
            'success' => false,
            'error' => $debug ? $e->getMessage() : 'Error inesperado.'
        ]);
    }

}