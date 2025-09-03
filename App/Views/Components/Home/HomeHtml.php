<?php
namespace App\Views\Components\Home;

use Flame\Html\Tags\Html;

final Class HomeHtml extends Html
{
    public function __construct()
    {
        parent::__construct(['lang'=>$_ENV['LANG']]);
    }
}