<?php
namespace App\VIews\Views\Constructor;

use App\views\Components\Constructor\ConstructorBody;
use App\Views\Components\Constructor\ConstructorHead;
use App\views\Components\Constructor\ConstructorHtml;
use App\views\Components\Constructor\ConstructorSection;
use Flame\Html\AssetManager;
use Flame\Interfaces\RenderableInterface;

class ConstructorView implements RenderableInterface
{
    public function render(): string
    {
        $section = new ConstructorSection();

        
        $body = new ConstructorBody();
        $body->addChild($section);

        $head = new ConstructorHead(AssetManager::renderStyles());

        $this->RenderAssetsJS($body,AssetManager::renderScripts());

        $html = new ConstructorHtml();
        $html->addChild($head);
        $html->addChild($body);

        return $html->render();
    }
    private function RenderAssetsJS($object,array $assetsJs=[])
    {
        foreach ($assetsJs as $asset) 
        {
           $object->addChild($asset);
        }
    }
}