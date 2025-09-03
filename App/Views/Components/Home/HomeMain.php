<?php
namespace App\Views\Components\Home;

use Flame\Html\Tags\Main;

final class HomeMain extends Main
{
    public function __construct()
    {
        parent::__construct(['class'=>'principal']);
        $this->registerAssetsCSS();
        $this->registerAssetsJS();
    }
}