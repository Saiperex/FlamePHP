<?php
namespace Flame\BaseAuth;

abstract class BaseAuth 
{
    protected $user;

    //Crear el jwt o Session con los datos 
    abstract public function login(array $data);
    //Borrar o enviar a black list el session o jwt
    abstract public function logout(): void;
    //Devuelve true o false si existe o no el jwt (y no esta en blaclist) o session user
    abstract public function check();
    //Devuelve el array user ya sea del jwt como del session.
    abstract public function getUser();
    //Devuelve solo los datos correspondientes segun un array de nombres de llaves
    abstract public function getUserForKeys(array $keys = []): array;

    public function isAuthenticated(): bool 
    {
        return $this->check() && is_array($this->getUser()) && !empty($this->getUser());
    }
    // Verifica si el usuario actual sigue existiendo en la base de datos
    abstract public function existsInDb(): bool;
    
}

