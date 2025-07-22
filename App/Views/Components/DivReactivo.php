<?php
namespace App\Views\Components;

use Flame\Html\Tags\Div;
class DivReactivo extends Div
{
    public function __construct(array $attributes = [], array $children = [])
    {
        parent::__construct(['class' => 'custom-div']+$attributes, );
        $this->registerAssetsCSS(); 
    }
}