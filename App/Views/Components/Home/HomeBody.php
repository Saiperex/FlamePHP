<?php
namespace App\Views\Components\Home;

use Flame\Html\Tags\Body;

final class HomeBody extends Body
{
    public function __construct(?array $chilldrens=[])
    {
        parent::__construct(['class'=>'cuerpo']);
        $this->registerAssetsCSS();
    }
}