<?php
namespace App\views\Components\Constructor;

use Flame\Html\Tags\Body;

final class ConstructorBody extends Body
{
    public function __construct()
    {
        parent::__construct(['class'=>'cuerpo']);
        $this->registerAssetsCSS();
    }
}