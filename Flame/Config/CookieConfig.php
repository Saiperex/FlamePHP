<?php
namespace Flame\Config;

class CookieConfig
{
    public static function getCookieParams(int $expiration = 0): array
    {
        return [
            'expires' => $expiration,
            'path' => $_ENV['COOKIE_PATH'] ?? '/',
            'domain' => $_ENV['COOKIE_DOMAIN'] ?? ($_SERVER['HTTP_HOST'] ?? ''),
            'secure' => filter_var($_ENV['COOKIE_SECURE'] ?? true, FILTER_VALIDATE_BOOLEAN),
            'httponly' => filter_var($_ENV['COOKIE_HTTPONLY'] ?? true, FILTER_VALIDATE_BOOLEAN),
            'samesite' => $_ENV['COOKIE_SAMESITE'] ?? 'Lax',
        ];
    }
}
