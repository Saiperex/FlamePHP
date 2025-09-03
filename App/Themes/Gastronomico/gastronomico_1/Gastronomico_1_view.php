<?php
namespace App\Themes\Gastronomico\gastronomico_1;

use Flame\Interfaces\RenderableInterface;

class Gastronomico_1_view implements RenderableInterface
{
    private array $identificador;
    public function __construct(array $identificador = [])
    {
        $this->identificador= $identificador;
    }
    public function render(): string
    {
        return "";
    }
}