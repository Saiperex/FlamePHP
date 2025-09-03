<?php
namespace Flame\Config;

class CookieConfig
{
    public static function getCookieParams(): array
    {
        return [
            'lifetime' => (int)($_ENV['SESSION_EXPIRATION'] ?? 3600), 
            'path' => $_ENV['COOKIE_PATH'] ?? '/',
            'domain' => $_ENV['COOKIE_DOMAIN'] ?? ($_SERVER['HTTP_HOST'] ?? ''),
            'secure' => filter_var($_ENV['COOKIE_SECURE'] ?? true, FILTER_VALIDATE_BOOLEAN),
            'httponly' => filter_var($_ENV['COOKIE_HTTPONLY'] ?? true, FILTER_VALIDATE_BOOLEAN),
            'samesite' => $_ENV['COOKIE_SAMESITE'] ?? 'Lax',
        ];
    }
}
