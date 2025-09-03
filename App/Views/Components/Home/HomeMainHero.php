<?php

namespace App\Views\Components\Home;

use Flame\Html\Tags\A;
use Flame\Html\Tags\Div;
use Flame\Html\Tags\H1;
use Flame\Html\Tags\H3;
use Flame\Html\Tags\I;
use Flame\Html\Tags\P;
use Flame\Html\Tags\Section;

final class HomeMainHero extends Section
{
    public function __construct()
    {
        parent::__construct(
            ['class' => 'hero', 'id'=>'inicio'],
            [
                new Div(
                    ['class' => 'hero_mid'],
                    [
                        new Div(
                            ['class' => 'hero_area hero_text'],
                            [
                                new H1([], ['Convertí tus redes en una web Profesional']),
                                new P([], ['La evolución de las tipicas BioLink y los botoncitos está acá. Tu catalogo, tus reservas, tu presentacion, invitaciones o Curriculum Vitae.<br>Todo desde tu celular.']),
                                new Div(
                                    ['class' => 'hero_buttons'],
                                    [
                                        new A(['class' => 'hero_button hero_crear', 'href'=>'crear'], ['Crear Mi AppSite']),
                                        new A(['class' => 'hero_button hero_ejemplos', 'href'=>'#nosotros'], ['Sobre AppSite'])
                                    ]
                                )
                            ]
                        ),
                        new Div(
                            ['class' => 'hero_area hero_example'],
                            [
                                new Div(
                                    ['class' => 'example'],
                                    [
                                        new H3(['class' => 'example_title'], ['Tu AppSite personal']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:50%']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:20%']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:100%']),
                                        new Div(['class' => 'example_button']),
                                        new I(['class' => 'fa-solid fa-store']),
                                        new H3(['class' => 'example_title'], ['Agrega productos']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:100%']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:100%']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:50%']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:80%']),
                                        new Div(['class' => 'example_button']),
                                        new I(['class' => 'fa-solid fa-calendar-days']),
                                        new H3(['class' => 'example_title'], ['Gestiona reservas']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:50%']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:20%']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:100%']),
                                        new Div(['class' => 'example_button']),

                                        new I(['class' => 'fa-solid fa-user-tie']),
                                        new H3(['class' => 'example_title'], ['Crea tu Curriculum']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:50%']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:20%']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:100%']),
                                        new Div(['class' => 'example_button']),
                                        new I(['class' => 'fa-solid fa-photo-film']),
                                        new H3(['class' => 'example_title'], ['Sube contenido multimedia']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:50%']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:20%']),
                                        new P(['class' => 'example_paragraph', 'style' => 'width:100%']),
                                        new Div(['class' => 'example_button']),
                                        new H3(['class' => 'example_h2'], ['Y muchas cosas mas!'])
                                    ]
                                )
                            ]
                        )
                    ]
                )
            ]
        );
        $this->registerAssetsCSS();
    }
}
