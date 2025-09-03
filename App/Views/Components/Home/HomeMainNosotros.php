<?php
namespace App\Views\Components\Home;

use Flame\Html\Tags\Section;
use Flame\Html\Tags\Div;
use Flame\Html\Tags\H2;
use Flame\Html\Tags\H3;
use Flame\Html\Tags\P;
use Flame\Html\Tags\A;
use Flame\Html\Tags\Span;

final class HomeMainNosotros extends Section
{
    public function __construct()
    {
        parent::__construct(
            ['class' => 'nosotros','id'=>'nosotros'],
            [
                new Div(['class' => 'nosotros_container'], [
                    
                    // Header de la sección
                    new Div(['class' => 'nosotros_header'], [
                        new Span(['class' => 'nosotros_badge'], ['Sobre AppSite']),
                        new H2(['class' => 'nosotros_title'], ['Más que una BioLink']),
                        new P(['class' => 'nosotros_subtitle'], [
                            'AppSite no es una biolink más. Es una evolución. ',
                            'Mientras otros te dan botones a tus redes, nosotros te damos una verdadera web personal — rápida, personalizable y pensada para crecer con vos.'
                        ])
                    ]),

                    // Grid de características
                    new Div(['class' => 'nosotros_grid'], [
                        
                        new Div(['class' => 'nosotros_card'], [
                            new Div(['class' => 'nosotros_card_icon'], ['🚀']),
                            new H3(['class' => 'nosotros_card_title'], ['¿Qué es una BioLanding?']),
                            new P(['class' => 'nosotros_card_text'], [
                                'Creamos un nuevo concepto: la BioLanding. ',
                                'Tu espacio digital ahora puede incluir no solo enlaces, sino widgets interactivos como catálogos, reservas, eventos, currículums y más. ',
                                'Todo esto en una sola página, desde el celular y sin saber programar.'
                            ])
                        ]),

                        new Div(['class' => 'nosotros_card'], [
                            new Div(['class' => 'nosotros_card_icon'], ['👥']),
                            new H3(['class' => 'nosotros_card_title'], ['¿Para quién es AppSite?']),
                            new P(['class' => 'nosotros_card_text'], [
                                'Para creadores, emprendedores, freelancers, artistas, profesionales y cualquier persona que quiera presentarse de forma profesional sin complicarse.'
                            ])
                        ]),

                        new Div(['class' => 'nosotros_card'], [
                            new Div(['class' => 'nosotros_card_icon'], ['⚡']),
                            new H3(['class' => 'nosotros_card_title'], ['Siempre en evolución']),
                            new P(['class' => 'nosotros_card_text'], [
                                'AppSite crece con vos. Estamos sumando nuevos widgets, funciones y herramientas constantemente, para que tengas el control de tu presencia online sin depender de nadie.'
                            ])
                        ])
                    ]),

                    // CTA Section
                    new Div(['class' => 'nosotros_cta'], [
                        new Div(['class' => 'nosotros_cta_content'], [
                            new H3(['class' => 'nosotros_cta_title'], ['¿Listo para crear tu presencia digital?']),
                            new P(['class' => 'nosotros_cta_text'], ['Únete a miles de usuarios que ya confían en AppSite']),
                            new Div(['class' => 'nosotros_buttons'], [
                                new A(['class' => 'nosotros_button primary', 'href'=>'crear'], ['Crear mi AppSite']),
                                new A(['class' => 'nosotros_button secondary', 'href'=>'#servicios'], ['Servicios'])
                            ])
                        ])
                    ])
                ])
            ]
        );
        $this->registerAssetsCSS();
        $this->registerAssetsJS();
    }
}
