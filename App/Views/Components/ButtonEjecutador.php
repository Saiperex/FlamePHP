<?php
namespace App\Views\Components;
use Flame\Html\Tags\Button;

class ButtonEjecutador Extends Button
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct(['class' => 'custom_button']+$attributes, [
            'Haré aparecer un cuadrado rojo si me haces click',
            ...$children
        ]);
        $this->registerAssetsCSS(); 
        $this->registerAssetsJS();
    }
}