<?php

namespace Flame\BaseMiddleware;
use Flame\Response\MiddlewareResponse;

use PDO;

abstract class BaseMiddleware
{
    protected ?PDO $pdo;
    protected ?array $data;
    //El array data puede ser el $_POST[] o el $_FILES
    public function __construct(?PDO $pdo = null,?array $data = null)
    {
        $this->pdo = $pdo;
        $this->data = $data;
    }

    // Este método puede ser sobreescrito por los middlewares concretos
    abstract public function handle(): MiddlewareResponse;
}
// End of BaseMiddleware.php