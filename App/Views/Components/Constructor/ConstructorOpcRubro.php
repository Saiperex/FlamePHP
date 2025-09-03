<?php
namespace App\Views\Components\Constructor;

use Flame\Html\Tags\Div;
use Flame\Html\Tags\Label;
use Flame\Html\Tags\Span;
use Flame\Html\Tags\Input;

final class ConstructorOpcRubro extends Div
{
    public function __construct(string $value, string $icono, string $texto)
    {
        parent::__construct(['class' => 'rubro_item'],
        [
            new Input([
                'type' => 'radio',
                'name' => 'rubro',
                'id' => 'rubro_' . $value,
                'value' => $value,
                //'data-name' => 'rubro',       
                //'data-type' => 'render',
                //'data-event' => 'change',
                'hidden' => true
            ]),
            new Label(['for' => 'rubro_' . $value], [
                new Span(['class' => 'icono'], [$icono]),
                new Span(['class' => 'texto'], [$texto])
            ])
        ]);
        $this->registerAssetsCSS();
    }
}