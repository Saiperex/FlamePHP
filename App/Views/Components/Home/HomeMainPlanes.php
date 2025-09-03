<?php
namespace App\Views\Components\Home;

use Flame\Html\Tags\Section;
use Flame\Html\Tags\Div;
use Flame\Html\Tags\H2;
use Flame\Html\Tags\H3;
use Flame\Html\Tags\H4;
use Flame\Html\Tags\P;
use Flame\Html\Tags\A;
use Flame\Html\Tags\Span;
use Flame\Html\Tags\Ul;
use Flame\Html\Tags\Li;

final class HomeMainPlanes extends Section
{
    public function __construct()
    {
        parent::__construct(
            ['class' => 'planes','id'=>'planes'],
            [
                new Div(['class' => 'planes_container'], [
                    
                    // Header de la sección
                    new Div(['class' => 'planes_header'], [
                        new Span(['class' => 'planes_badge'], ['Precios']),
                        new H2(['class' => 'planes_title'], ['Planes que se adaptan a vos']),
                        new P(['class' => 'planes_subtitle'], [
                            'Empezá gratis y descubrí todo lo que AppSite puede hacer por tu presencia digital. ',
                            'Sin compromisos, sin tarjeta de crédito.'
                        ])
                    ]),

                
                    // Grid de planes
                    new Div(['class' => 'planes_grid'], [
                        
                        // Plan Gratuito
                        new Div(['class' => 'planes_card free'], [
                            new Div(['class' => 'planes_card_header'], [
                                new Div(['class' => 'planes_card_badge'], ['Prueba Gratis']),
                                new H3(['class' => 'planes_card_title'], ['Descubrí AppSite']),
                                new P(['class' => 'planes_card_description'], [
                                    'Probá todas las funcionalidades sin límites por 2 días completos.'
                                ])
                            ]),
                            
                            new Div(['class' => 'planes_card_price'], [
                                new Span(['class' => 'planes_price_currency'], ['$']),
                                new Span(['class' => 'planes_price_amount'], ['0']),
                                new Span(['class' => 'planes_price_period'], ['/2 días'])
                            ]),

                            new Div(['class' => 'planes_card_features'], [
                                new H4(['class' => 'planes_features_title'], ['Todo incluido:']),
                                new Ul(['class' => 'planes_features_list'], [
                                    new Li(['class' => 'included'], ['Secciones ilimitadas']),
                                    new Li(['class' => 'included'], ['Catálogo completo']),
                                    new Li(['class' => 'included'], ['Sistema de reservas']),
                                    new Li(['class' => 'included'], ['Curriculum vitae']),
                                    new Li(['class' => 'included'], ['Gestión de eventos']),
                                    new Li(['class' => 'included'], ['Personalización total']),
                                    new Li(['class' => 'included'], ['Enlace Personalizado']),
                                    new Li(['class' => 'included'], ['Soporte por email'])
                                ])
                            ]),

                            new Div(['class' => 'planes_card_cta'], [
                                new A(['class' => 'planes_button primary', 'href' => 'crear'], ['Empezar gratis']),
                                new P(['class' => 'planes_card_note'], ['Sin tarjeta de crédito'])
                            ])
                        ]),

                        // Plan Premium
                        new Div(['class' => 'planes_card premium popular'], [
                            
                            new Div(['class' => 'planes_card_header'], [
                                new Div(['class' => 'planes_card_badge premium'], ['Premium']),
                                new H3(['class' => 'planes_card_title'], ['AppSite Pro']),
                                new P(['class' => 'planes_card_description'], [
                                    'Acceso completo a todas las funcionalidades y futuras actualizaciones.'
                                ])
                            ]),
                            
                            new Div(['class' => 'planes_card_price'], [
                                new Span(['class' => 'planes_price_currency'], ['$']),
                                new Span(['class' => 'planes_price_amount'], ['2.000']),
                                new Span(['class' => 'planes_price_period'], ['/mes'])
                            ]),

                            new Div(['class' => 'planes_card_features'], [
                                new H4(['class' => 'planes_features_title'], ['Todo de la prueba gratis +:']),
                                new Ul(['class' => 'planes_features_list'], [
                                    new Li(['class' => 'included'], ['Sin límite de tiempo']),
                                    new Li(['class' => 'included'], ['Actualizaciones constantes']),
                                    new Li(['class' => 'included'], ['Soporte Prioritario']),
                                    new Li(['class' => 'included'], ['Asistencia en diseño']),
                                    new Li(['class' => 'included'], ['Backup automático']),
                                    new Li(['class' => 'included'], ['Correo Empresarial']),
                                    new Li(['class' => 'included'], ['Nuevas funcionalidades primero']),
                                    new Li(['class' => 'included'], ['Participación en novedades!'])
                                ])
                            ]),

                            new Div(['class' => 'planes_card_cta'], [
                                new A(['class' => 'planes_button premium', 'href' => 'crear'], ['Suscribirme ahora']),
                                new P(['class' => 'planes_card_note'], ['Cancela cuando quieras'])
                            ])
                        ])
                    ]),

                    // Sección de garantía y beneficios
                    new Div(['class' => 'planes_benefits'], [
                        new Div(['class' => 'planes_benefits_grid'], [
                            new Div(['class' => 'planes_benefit'], [
                                new Div(['class' => 'planes_benefit_icon'], ['🛡️']),
                                new H4(['class' => 'planes_benefit_title'], ['Garantía de Servicios']),
                                new P(['class' => 'planes_benefit_text'], ['Estamos evolucionando todos los dias y mejorando los servicios.'])
                            ]),
                            new Div(['class' => 'planes_benefit'], [
                                new Div(['class' => 'planes_benefit_icon'], ['🚀']),
                                new H4(['class' => 'planes_benefit_title'], ['Actualizaciones incluidas']),
                                new P(['class' => 'planes_benefit_text'], ['Nuevas funcionalidades sin costo adicional'])
                            ]),
                            new Div(['class' => 'planes_benefit'], [
                                new Div(['class' => 'planes_benefit_icon'], ['💬']),
                                new H4(['class' => 'planes_benefit_title'], ['Soporte dedicado']),
                                new P(['class' => 'planes_benefit_text'], ['Te ayudamos a sacar el máximo provecho'])
                            ])
                        ])
                    ]),

                    // FAQ rápido
                    new Div(['class' => 'planes_faq'], [
                        new H3(['class' => 'planes_faq_title'], ['Preguntas frecuentes']),
                        new Div(['class' => 'planes_faq_grid'], [
                            new Div(['class' => 'planes_faq_item'], [
                                new H4(['class' => 'planes_faq_question'], ['¿Puedo solicitar una prueba ampliada??']),
                                new P(['class' => 'planes_faq_answer'], ['Sí, podés pedir una prueba ampliada y analizaremos tu caso. Estamos abiertos a ideas y mejoras.'])
                            ]),
                            new Div(['class' => 'planes_faq_item'], [
                                new H4(['class' => 'planes_faq_question'], ['¿Qué pasa después de los 2 días gratis?']),
                                new P(['class' => 'planes_faq_answer'], ['Tu AppSite se desactiva pero reservamos tu enlace durante un més.'])
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
