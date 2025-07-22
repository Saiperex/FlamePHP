<?php
namespace Flame\BaseAuth;

abstract class BaseAuth 
{
    protected $user;

    
    abstract public function login($credentials);
    abstract public function logout();
    abstract public function check();
    abstract public function getUser();
    abstract public function getUserForKeys(array $keys = []): array;

    public function isAuthenticated(): bool {
        return $this->check() && $this->getUser() !== null;
    }
}
