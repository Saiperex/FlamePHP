<?php
namespace Flame\Auth;

use Flame\BaseAuth\BaseAuth;
use Flame\Crud\Crud;
use Flame\Config\CookieConfig;
use PDO;

/**
 * Clase para manejar autenticación JWT personalizada sin librerías externas.
 */
class JWT extends BaseAuth
{
    protected ?string $token = null;
    protected PDO $pdo;
    protected string $cookieName = 'jwt_token';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function login($userData): string
    {
        $issuedAt = time();
        $expiration = $issuedAt + (int) ($_ENV['JWT_EXPIRATION'] ?? 3600);

        $payload = [
            'iss' => $_ENV['JWT_ISSUER'] ?? 'flame.auth',
            'aud' => $_ENV['JWT_AUDIENCE'] ?? 'flame.app',
            'iat' => $issuedAt,
            'exp' => $expiration,
            'user' => $userData
        ];

        $this->user = $userData;
        $this->token = $this->encode($payload);

        setcookie($this->cookieName, $this->token, CookieConfig::getCookieParams($expiration));
        return $this->token;
    }

    public function logout(): bool
    {
        $token = $this->getTokenFromCookie();
        if (!$token) return false;

        $crud = new Crud($this->pdo);
        $result = $crud->create(['token' => $token, 'created_at' => date('Y-m-d H:i:s')], 'jwt_blacklist');

        setcookie($this->cookieName, '', CookieConfig::getCookieParams(time() - 3600));
        return $result['status'];
    }

    public function check(): bool
    {
        $token = $this->getTokenFromCookie();
        if (!$token) return false;

        $decoded = $this->decode($token);
        if (!$decoded || $decoded['exp'] < time()) return false;

        $crud = new Crud($this->pdo);
        $result = $crud->read('jwt_blacklist', ['token' => $token], ['id']);
        if ($result['status'] && !empty($result['data'])) return false;

        $this->user = $decoded['user'] ?? null;
        return true;
    }

    public function getUser(): ?array
    {
        return $this->user;
    }

    public function getUserForKeys(array $keys = []): array
    {
        if (!$this->user) return [];

        return array_filter(
            $this->user,
            fn($k) => in_array($k, $keys),
            ARRAY_FILTER_USE_KEY
        );
    }

    public function refresh(): ?string
    {
        $oldToken = $this->getTokenFromCookie();
        $decoded = $this->decode($oldToken);
        if (!$decoded) return null;

        unset($decoded['iat'], $decoded['exp']);
        return $this->login($decoded['user']);
    }

    public function existInDB(array $keys = []): bool
    {
        $crud = new Crud($this->pdo);
        $result = $crud->read('usuarios', $keys, ['id'], null, 1);
        return $result['status'] && !empty($result['data']);
    }

    public function encode(array $payload): string
    {
        $header = ['alg' => $_ENV['JWT_ALGO'] ?? 'HS256', 'typ' => 'JWT'];
        $segments = [
            $this->base64UrlEncode(json_encode($header)),
            $this->base64UrlEncode(json_encode($payload))
        ];

        $signing_input = implode('.', $segments);
        $signature = $this->sign($signing_input, $_ENV['JWT_SECRET'] ?? '');
        $segments[] = $this->base64UrlEncode($signature);

        return implode('.', $segments);
    }

    public function decode(string $jwt): ?array
    {
        $parts = explode('.', $jwt);
        if (count($parts) !== 3) return null;

        [$header64, $payload64, $signature64] = $parts;

        $header = json_decode($this->base64UrlDecode($header64), true);
        $payload = json_decode($this->base64UrlDecode($payload64), true);
        $signature = $this->base64UrlDecode($signature64);

        $expectedSig = $this->sign("$header64.$payload64", $_ENV['JWT_SECRET'] ?? '');
        if (!hash_equals($expectedSig, $signature)) return null;

        if (
            ($payload['iss'] ?? null) !== ($_ENV['JWT_ISSUER'] ?? '') ||
            ($payload['aud'] ?? null) !== ($_ENV['JWT_AUDIENCE'] ?? '')
        ) return null;

        return $payload;
    }

    private function sign(string $data, string $secret): string
    {
        return hash_hmac('sha256', $data, $secret, true);
    }

    private function getTokenFromCookie(): ?string
    {
        return $_COOKIE[$this->cookieName] ?? null;
    }

    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64UrlDecode(string $data): string
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }
}
