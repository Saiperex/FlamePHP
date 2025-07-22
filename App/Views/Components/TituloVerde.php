<?php
namespace App\Views\Components;
use Flame\Html\Tags\H1;

class TituloVerde Extends H1
{
    public function __construct()
    {
        parent::__construct(['class' => 'TituloVerde'], [
            "Título Verde"
        ]);
        $this->registerAssetsCSS(); 
    }
}