<?php

declare(strict_types=1);

namespace Flame\Core;

use PDO;
use Throwable;
use Exception;

/**
 * Clase Connection
 *
 * Gestiona una única instancia de PDO para la conexión a la base de datos.
 * Utiliza el patrón Singleton para garantizar una única conexión activa.
 *
 * @package Flame\Core
 */
final class Connection
{
    /**
     * Instancia PDO activa
     *
     * @var PDO|null
     */
    private static ?PDO $pdo = null;

    /**
     * Constructor privado para evitar instanciación directa.
     */
    private function __construct()
    {
        // Previene la creación directa del objeto
    }

    /**
     * Retorna una instancia activa de PDO conectada a la base de datos.
     * Si ya existe una conexión, la reutiliza.
     *
     * @return PDO
     * @throws Throwable Si ocurre un error al obtener credenciales o al conectar
     */
    public static function getInstance(): PDO
    {
        if (self::$pdo === null) {
            $driver = $_ENV['DB_DRIVER'] ?? 'mysql';
            $host = $_ENV['DB_HOST'] ?? 'localhost';

            try {
                $dbName = self::requireEnv('DB_NAME');
                $user = self::requireEnv('DB_USER');
                $password = $_ENV['DB_PASSWORD'] ?? '';
            } catch (Throwable $e) {
                // Reempaquetamos el error en una Exception o lo relanzamos directamente
                throw new Exception("Error al obtener las credenciales de la base de datos: " . $e->getMessage(), 0, $e);
            }

            $dsn = "$driver:host=$host;dbname=$dbName;charset=utf8mb4";

            try {
                $options = [
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_STRINGIFY_FETCHES => false,
                    PDO::ATTR_PERSISTENT => false,
                ];

                self::$pdo = new PDO($dsn, $user, $password, $options);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (Throwable $e) {
                throw new Exception('No se pudo conectar a la base de datos. Verifica tus credenciales.', (int)$e->getCode(), $e);
            }
        }

        return self::$pdo;
    }

    /**
     * Verifica si la conexión actual a la base de datos sigue activa.
     *
     * @return bool
     * @throws Throwable Si ocurre un error al verificar la conexión
     */
    public static function ping(): bool
    {
        if (self::$pdo === null) {
            return false;
        }

        try {
            self::$pdo->query('SELECT 1');
            return true;
        } catch (Throwable $e) {
            self::close();
            throw new Exception('Error al verificar la conexión a la base de datos: ' . $e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * Cierra la conexión actual con la base de datos.
     *
     * @return void
     */
    public static function close(): void
    {
        self::$pdo = null;
    }

    /**
     * Obtiene una variable del entorno y lanza una excepción si está vacía o no existe.
     *
     * @param string $key
     * @return string
     * @throws Exception
     */
    private static function requireEnv(string $key): string
    {
        $value = $_ENV[$key] ?? null;
        if ($value === null || trim($value) === '') {
            throw new Exception("La variable de entorno '$key' no está definida o está vacía.");
        }
        return $value;
    }
}
// End of file: Flame/Core/Connection.php
// Location: Flame/Core/Connection.php