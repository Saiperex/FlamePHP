<?php

namespace Flame\Html\Tags;

use Flame\Html\AbstractTag;
use Flame\Interfaces\RenderableInterface;
use Exception;

/**
 * Clase VoidTag
 *
 * Permite registrar los assets de un componente sin renderizar su HTML.
 * Útil para asegurarse de que los estilos y scripts estén disponibles
 * antes de que el componente sea inyectado dinámicamente en el DOM.
 *
 * @package Flame\Html\Tags
 */
class VoidTag extends AbstractTag
{
    /**
     * VoidTag constructor.
     *
     * @param string $componentClass Nombre completo de la clase del componente (ej: Cuadradito::class)
     * @throws Exception Si la clase no existe o no implementa RenderableInterface
     */
    public function __construct(string $componentClass)
    {
        // El tag 'void' no tiene representación visual
        parent::__construct('void', [], []);

        if (!class_exists($componentClass)) {
            throw new Exception("La clase '$componentClass' no existe.");
        }

        $instance = new $componentClass();

        if (!$instance instanceof RenderableInterface) {
            throw new Exception("La clase '$componentClass' no implementa RenderableInterface.");
        }

        // No se renderiza, pero se espera que el constructor del componente registre sus assets
    }

    /**
     * Renderizado vacío. Este tag no genera salida HTML.
     *
     * @return string
     */
    public function render(): string
    {
        return '';
    }
}
// End of file: Flame/Html/Tags/VoidTag.php
// Location: Flame/Html/Tags/VoidTag.php
