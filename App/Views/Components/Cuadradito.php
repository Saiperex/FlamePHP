<?php
namespace App\Views\Components;
use Flame\Html\Tags\Div;

class Cuadradito Extends Div
{
    public function __construct()
    {
        parent::__construct(['class' => 'cuadradito'], [
            new TituloVerde(),
        ]);
        $this->registerAssetsCSS(); 
    }
}