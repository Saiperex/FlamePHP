<?php

declare(strict_types=1);
/**
 * Autoload de clases para Flame + App.
 * Usa una implementación sencilla de PSR-4 para cargar clases
 * desde los namespaces `Flame\*` y `App\*`.
 * @package Flame\Core
 */

spl_autoload_register(function ($class) {
    $prefixes = [
        'App\\'   => __DIR__ . '/../../App/',
        'Flame\\' => __DIR__ . '/../',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        if (str_starts_with($class, $prefix)) {
            $relativeClass = substr($class, strlen($prefix));
            $file = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

            if (file_exists($file)) {
                require_once $file;
                return;
            }

            // Registro de error opcional para desarrollo
            error_log("Autoload error: clase no encontrada '$class' en '$file'");
        }
    }
});
// End of file: Flame/Core/Autoload.php
// Location: Flame/Core/Autoload.php
