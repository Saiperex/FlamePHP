<?php
namespace App\Views\Views\Home;

use App\Views\Components\Home\HomeBody;
use App\Views\Components\Home\HomeFooter;
use App\Views\Components\Home\HomeHead;
use App\Views\Components\Home\HomeHeader;
use App\Views\Components\Home\HomeHtml;
use App\Views\Components\Home\HomeMain;
use App\Views\Components\Home\HomeMainArgentina;
use App\Views\Components\Home\HomeMainContacto;
use App\Views\Components\Home\HomeMainHero;
use App\Views\Components\Home\HomeMainNosotros;
use App\Views\Components\Home\HomeMainPlanes;
use App\Views\Components\Home\HomeMainServicios;
use Flame\Interfaces\RenderableInterface;
use Flame\Html\AssetManager;

class HomeView implements RenderableInterface
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }
    public function render(): string
    {
        $contacto = new HomeMainContacto($this->data['data']);
        $argentina = new HomeMainArgentina($this->data['data']);
        $planes = new HomeMainPlanes();
        $servicios = new HomeMainServicios();
        $nosotros = new HomeMainNosotros();
        $hero = new HomeMainHero();

        $footer = new HomeFooter($this->data['data']);
        $main = new HomeMain();
        $main->addChild($hero);
        $main->addChild($nosotros);
        $main->addChild($servicios);
        $main->addChild($planes);
        $main->addChild($argentina);
        $main->addChild($contacto);
        $header = new HomeHeader($this->data['auth']);

        $body = new HomeBody();
        $body->addChild($header);
        $body->addChild($main);
        $body->addChild($footer);
        $this->RenderAssetsJS($body,AssetManager::renderScripts());
        $head = new HomeHead(AssetManager::renderStyles(),'Evoluciona tu Bio Link en una Bio Landing');
        $html = new HomeHtml();
        
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