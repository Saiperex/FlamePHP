<?php

declare(strict_types=1);

namespace Flame\Html\Renderer;

use Flame\Interfaces\RenderableInterface;
use Exception;
use Throwable;

/**
 * Clase ViewRenderer
 *
 * Renderiza vistas basadas en objetos que implementan la interfaz RenderableInterface.
 * Encapsula la salida del DOCTYPE y captura errores en la generación del HTML,
 * lanzando excepciones con mensajes claros para facilitar la depuración.
 *
 * @package Flame\Html\Renderer
 */
class ViewRenderer
{
    /**
     * Renderiza la vista recibida e imprime el contenido.
     *
     * @param RenderableInterface $view Objeto que implementa el método render()
     * @throws Exception En caso de error durante la generación del HTML
     */
    public static function render_view(RenderableInterface $view): void
    {
        try {
            echo '<!DOCTYPE html>' . $view->render();
        } catch (Throwable $e) {
            $viewClass = get_class($view);
            throw new Exception("Error al renderizar la vista '$viewClass': " . $e->getMessage(), 0, $e);
        }
    }
}
// End of file: Flame/Html/Renderer/ViewRenderer.php
// Location: Flame/Html/Renderer/ViewRenderer.php
