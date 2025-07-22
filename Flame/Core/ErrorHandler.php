<?php

declare(strict_types=1);

namespace Flame\Core;

use DateTime;
use Throwable;

/**
 * Clase ErrorLogger
 *
 * Registra errores en archivos de log diarios.
 * La ruta del log puede definirse en la variable de entorno LOG_PATH.
 * Si no está definida o vacía, se usa la ruta por defecto storage/logs/ con aviso en el log.
 * @package Flame\Core
 */
final class ErrorHandler
{
    /**
     * Ruta base del log, cacheada tras leer la variable de entorno.
     * 
     * @var string|null
     */
    private static ?string $logBasePath = null;

    /**
     * Registra un mensaje de error en el archivo de log.
     *
     * @param string $message Mensaje de error
     */
    public static function log(string $message): void
    {
        try {
            $dateTime = new DateTime();
            $date = $dateTime->format('Y-m-d');
            $time = $dateTime->format('H:i:s');

            $logDir = self::getLogBasePath();
            $logFile = $logDir . "/error-$date.log";

            // Crear carpeta si no existe
            if (!is_dir($logDir)) {
                mkdir($logDir, 0775, true);
            }

            // Si estamos usando ruta por defecto, y es la primera vez que se escribe, agregamos advertencia
            if (self::isUsingDefaultPath() && !file_exists($logFile)) {
                $defaultNotice = "[$time] [Advertencia] La ruta para logs no está definida en la variable de entorno LOG_PATH. Se está usando la ruta por defecto: $logDir" . PHP_EOL;
                file_put_contents($logFile, $defaultNotice, FILE_APPEND | LOCK_EX);
            }

            $formatted = "[$time] $message" . PHP_EOL;

            // Escribir log
            file_put_contents($logFile, $formatted, FILE_APPEND | LOCK_EX);
        } catch (Throwable $e) {
            // Evitar errores fatales en caso de que falle el logger
            error_log("ErrorLogger falló: " . $e->getMessage());
        }
    }

    /**
     * Registra una excepción con detalles.
     *
     * @param Throwable $e La excepción capturada
     */
    public static function logException(Throwable $e): void
    {
        $type = $e instanceof \Error ? 'Error fatal' : 'Excepción';

        $message = sprintf(
            "%s [%s]: %s en %s:%d\nTrace:\n%s",
            $type,
            get_class($e),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getTraceAsString()
        );

        self::log($message);
    }

    /**
     * Obtiene la ruta base para guardar los logs.
     * Intenta leer la variable de entorno LOG_PATH.
     * Si no está definida o está vacía, usa ruta por defecto storage/logs.
     *
     * @return string Ruta base para logs (sin slash final)
     */
    private static function getLogBasePath(): string
    {
        if (self::$logBasePath !== null) {
            return self::$logBasePath;
        }

        $envPath = getenv('LOG_PATH') ?: ($_ENV['LOG_PATH'] ?? null);

        if ($envPath !== null && trim($envPath) !== '') {
            self::$logBasePath = rtrim($envPath, "/\\");
        } else {
            // Ruta por defecto relativa a este archivo
            self::$logBasePath = realpath(__DIR__ . '/../../storage/logs') ?: (__DIR__ . '/../../storage/logs');
        }

        return self::$logBasePath;
    }

    /**
     * Indica si se está usando la ruta por defecto para logs
     *
     * @return bool
     */
    private static function isUsingDefaultPath(): bool
    {
        $envPath = getenv('LOG_PATH') ?: ($_ENV['LOG_PATH'] ?? null);
        return $envPath === null || trim($envPath) === '';
    }
}
// End of file: Flame/Core/ErrorHandler.php
// Location: Flame/Core/ErrorHandler.php