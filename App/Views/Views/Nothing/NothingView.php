<?php
namespace App\Views\Views\nothing;

use Flame\Interfaces\RenderableInterface;

class NothingView implements RenderableInterface
{
    public function render(): string
    {
        return "No existe este appsite. Crea uno nuevo";
    }
}