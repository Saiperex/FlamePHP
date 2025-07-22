<?php

namespace Flame\BaseController;

use Flame\Html\Renderer\ViewRenderer;
use Flame\Interfaces\RenderableInterface;
use PDO;
use Exception;

abstract class BaseController
{
    protected ?PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo;
    }

    public function render(string $viewClass, array $data = []): void
    {
        if (!class_exists($viewClass)) {
            throw new Exception("La clase de vista '$viewClass' no existe.");
        }
        if($data)
        {
            $view = new $viewClass($data);
        } else {
            $view = new $viewClass();  
        }

        if (!$view instanceof RenderableInterface) {
            throw new Exception("La clase '$viewClass' no implementa RenderableInterface.");
        }

        ViewRenderer::render_view($view);
    }
    abstract public function index(): void;
}
// End of BaseController.php