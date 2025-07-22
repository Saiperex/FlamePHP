<?php

namespace App\Views\View;
use Flame\Interfaces\RenderableInterface;
use App\Views\Components\ButtonEjecutador;
use App\Views\Components\DivReactivo;
use App\Views\Components\Cuadradito;
use Flame\Html\Tags\Html;
use Flame\Html\Tags\Head;
use Flame\Html\AssetManager;
use Flame\Html\Tags\VoidTag;
use Flame\Html\Tags\ReactiveScript;

class HomeView implements RenderableInterface
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }
    public function render(): string
    {
        $reactivity = new ReactiveScript();
        $divReactivo = new DivReactivo(['id' => 'div-reactivo'],
        [
            // Otros componentes o contenido
            new VoidTag(Cuadradito::class),
        ]);
        $button = new ButtonEjecutador(["data-name" => "ejecutador", "data-type" => "render", "data-event" => "click"], [
            "¡Haz click aquí!"
        ]);
        $head = new Head([
            ...AssetManager::renderStyles(),
        ]);
        $html = new Html([],
        [
            $head,
            $button,
            $divReactivo,
            ...AssetManager::renderScripts(),
            $reactivity
        ]);
        return $html->render();
    }
}