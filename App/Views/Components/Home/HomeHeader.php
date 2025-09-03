<?php

namespace App\Views\Components\Home;

use Flame\Html\Tags\A;
use Flame\Html\Tags\Div;
use Flame\Html\Tags\Header;
use Flame\Html\Tags\I;
use Flame\Html\Tags\Img;
use Flame\Html\Tags\Li;
use Flame\Html\Tags\Nav;

final class HomeHeader extends Header
{
    public function __construct(?bool $data = false)
    {
        parent::__construct(['class' => 'cabecera']);

        $cabeceraMenu = new Nav(['class' => 'cabecera_menu']);
        $arrayOpciones = ['Inicio', 'Planes', 'Nosotros', 'Contacto'];
        $this->crearOpciones($cabeceraMenu, $arrayOpciones);

        $cabeceraImg = new Img(['src' => $_ENV['ICON3']]);
        $cabeceraLogo = new A(['class' => 'logo', 'href' => $_ENV['DOMAIN']]);
        $cabeceraLogo->addChild($cabeceraImg);

        $cabeceraMid = new Div(['class' => 'cabecera_mid']);
        $cabeceraMid->addChild($cabeceraLogo);
        $cabeceraMid->addChild($cabeceraMenu);
        $cabeceraMid->addChild($this->buttonCabecera($data));

        $cabeceraBlur = new Div(['class' => 'cabecera_blur']);
        $cabeceraBlur->addChild($cabeceraMid);
        $this->addChild(new I(['class'=>'button_menu fa-solid fa-bars-staggered']));
        $this->addChild($cabeceraBlur);
        $this->registerAssetsCSS();
        $this->registerAssetsJS();
    }
    private function crearOpciones(Nav $menu, array $opc): void
    {
        foreach ($opc as $option) {
            $tlc = strtolower($option);

            $menu->addChild(new Li(['class' => 'menu_opc'], [new A(['href' => '#'.$tlc], [$option])]));
        }
    }
    private function buttonCabecera(?bool $data = false): A
    {
        return match (empty($data)) {
            true => new A(['href' => 'login', 'class'=>'option_header'], ['Ingresar']),
            false => new A(['href' => 'panel', 'class'=>'option_header'], ['Panel']),
        };
    }
}
