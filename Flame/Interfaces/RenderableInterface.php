<?php

declare(strict_types=1);

namespace Flame\Interfaces;

/**
 * Interface RenderableInterface
 *
 * Contrato para clases que pueden ser renderizadas a HTML.
 * Todas las clases que representen un componente visual deben
 * implementar este método para generar su representación como string.
 *
 * @package Flame\Interfaces
 */
interface RenderableInterface
{
    /**
     * Devuelve la representación HTML del componente.
     *
     * @return string
     */
    public function render(): string;
}
// End of file Flame/Interfaces/RenderableInterface.php
// Location: Flame/Interfaces/RenderableInterface.php