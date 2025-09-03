<?php
namespace App\views\Components\Constructor;

use Flame\Html\Tags\Html;

final class ConstructorHtml extends Html
{
    public function __construct()
    {
        parent::__construct(['lang'=> $_ENV['LANG']]);
    }
}