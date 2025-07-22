<?php

declare(strict_types=1);

namespace Flame\Core;

use Exception;

/**
 * Clase EnvLoader
 * Carga las variables de entorno desde un archivo .env
 * y las almacena en la superglobal $_ENV.
 * 
 * @package Flame\Core
 */
final class EnvLoader
{
    /**
     * Carga las variables del archivo .env en $_ENV.
     *
     * @param string $file
     * @throws Exception
     */
    public static function load(string $file = __DIR__ . '/../../.env'): void
    {
        if (!file_exists($file)) {
            throw new Exception("Archivo .env no encontrado en: $file");
        }

        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $lineNumber => $line) {
            $line = trim($line);

            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            if (!str_contains($line, '=')) {
                throw new Exception("Formato inválido en línea " . ($lineNumber + 1) . " del archivo .env.");
            }

            [$name, $value] = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (
                (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                (str_starts_with($value, "'") && str_ends_with($value, "'"))
            ) {
                $value = substr($value, 1, -1);
            }

            if (!array_key_exists($name, $_ENV)) {
                $_ENV[$name] = $value;
            }
        }
    }
}
// End of file: Flame/Core/EnvLoader.php
// Location: Flame/Core/EnvLoader.php
