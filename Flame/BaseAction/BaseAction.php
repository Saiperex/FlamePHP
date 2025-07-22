<?php

namespace Flame\BaseAction;

use Flame\Response\ActionResponse;
use PDO;

abstract class BaseAction
{
    protected ?PDO $pdo;
    protected array $data;
    protected array $files;

    public function __construct(?PDO $pdo = null, array $data = [], array $files = [])
    {
        $this->pdo = $pdo;
        $this->data = $data;
        $this->files = $files;
    }

    /**
     * Este método debe ser implementado por cada acción concreta.
     * Debe retornar una respuesta JSON para ser enviada al cliente.
     *
     * @return ActionResponse
     */
    abstract public function handle(): ActionResponse;
}
