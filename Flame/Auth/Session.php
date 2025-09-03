<?php

namespace Flame\Auth;

use Flame\BaseAuth\BaseAuth;
use Flame\Crud\Crud;
use Flame\Config\CookieConfig;
use Exception;
use PDO;

/**
 * Clase que maneja autenticación basada en sesiones PHP nativas.
 * Hereda de BaseAuth y permite login, logout, verificación y persistencia segura.
 */
class Session extends BaseAuth
{
    protected PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function login(array $userData = []): void
    {
        $this->sessionStart();
        $_SESSION['user'] = $userData;
    }

    public function logout(): void
    {
        $this->sessionStart();
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = CookieConfig::getCookieParams();
            setcookie(session_name(), '', [
                'expires' => time() - 42000,
                'path' => $params['path'],
                'domain' => $params['domain'],
                'secure' => $params['secure'],
                'httponly' => $params['httponly'],
                'samesite' => $params['samesite'],
            ]);
        }

        session_destroy();
    }


    public function check(): bool
    {
        $this->sessionStart();
        return isset($_SESSION['user']) && !empty($_SESSION['user']);
    }

    public function getUser(): ?array
    {
        $this->sessionStart();
        return $_SESSION['user'];
    }

    public function getUserForKeys(array $keys = []): array
    {
        $this->sessionStart();

        // Si no hay sesión de usuario, no continuar
        if (!isset($_SESSION['user'])) return [];

        $userData = $_SESSION['user'];

        // Validar que todas las claves existan
        foreach ($keys as $key) {
            if (!array_key_exists($key, $userData)) {
                throw new Exception("Clave: '{$key}' No existe en Session", 1);
                return []; // Si falta alguna clave, no devuelve nada
            }
        }

        // Filtrar solo las claves requeridas
        return array_filter(
            $userData,
            fn($k) => in_array($k, $keys),
            ARRAY_FILTER_USE_KEY
        );
    }

    public function existsInDb(array $keys = []): bool
    {
        $crud = new Crud($this->pdo);
        $result = $crud->read('usuarios', $keys, null, null, 1);
        return $result['status'] && !empty($result['data']);
    }

    public static function sessionStart(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            $expiration = (int)($_ENV['SESSION_EXPIRATION'] ?? 3600);
            $name = $_ENV['SESSION_NAME'] ?? 'session';

            session_name($name);
            session_set_cookie_params(CookieConfig::getCookieParams(time() + $expiration));
            session_start();
        }
    }
}
