<?php
namespace App\Views\Components\Home;

use Flame\Html\Tags\Section;
use Flame\Html\Tags\Div;
use Flame\Html\Tags\H2;
use Flame\Html\Tags\H3;
use Flame\Html\Tags\P;
use Flame\Html\Tags\A;
use Flame\Html\Tags\Span;
use Flame\Html\Tags\Ul;
use Flame\Html\Tags\Li;

final class HomeMainServicios extends Section
{
    public function __construct()
    {
        parent::__construct(
            ['class' => 'servicios', 'id'=>'servicios'],
            [
                new Div(['class' => 'servicios_container'], [
                    
                    // Header de la sección
                    new Div(['class' => 'servicios_header'], [
                        new Span(['class' => 'servicios_badge'], ['Funcionalidades']),
                        new H2(['class' => 'servicios_title'], ['Todo lo que necesitás en un solo lugar']),
                        new P(['class' => 'servicios_subtitle'], [
                            'AppSite te permite crear una experiencia completa para tus visitantes. ',
                            'No solo enlaces, sino herramientas reales que potencian tu presencia digital.'
                        ])
                    ]),

                    // Grid principal de servicios
                    new Div(['class' => 'servicios_grid'], [
                        
                        // Links
                        new Div(['class' => 'servicios_card featured'], [
                            new Div(['class' => 'servicios_card_header'], [
                                new Div(['class' => 'servicios_card_icon'], ['🔗']),
                                new Span(['class' => 'servicios_card_badge'], ['Básico'])
                            ]),
                            new H3(['class' => 'servicios_card_title'], ['Links Inteligentes']),
                            new P(['class' => 'servicios_card_description'], [
                                'Organiza todos tus enlaces importantes de forma elegante y profesional.'
                            ]),
                            new Ul(['class' => 'servicios_card_features'], [
                                new Li([], ['Enlaces a redes sociales']),
                                new Li([], ['Links personalizados']),
                                new Li([], ['Efectos y animaciones']),
                                new Li([], ['Diseño personalizable'])
                            ])
                        ]),

                        // Catálogo
                        new Div(['class' => 'servicios_card'], [
                            new Div(['class' => 'servicios_card_header'], [
                                new Div(['class' => 'servicios_card_icon'], ['🛍️']),
                                new Span(['class' => 'servicios_card_badge popular'], ['Popular'])
                            ]),
                            new H3(['class' => 'servicios_card_title'], ['Catálogo Digital']),
                            new P(['class' => 'servicios_card_description'], [
                                'Muestra tus productos o servicios con imágenes, precios y descripciones.'
                            ]),
                            new Ul(['class' => 'servicios_card_features'], [
                                new Li([], ['Galería de productos']),
                                new Li([], ['Precios y descripciones']),
                                new Li([], ['Categorías organizadas']),
                                new Li([], ['Botón de contacto directo'])
                            ])
                        ]),

                        // Reservas
                        new Div(['class' => 'servicios_card'], [
                            new Div(['class' => 'servicios_card_header'], [
                                new Div(['class' => 'servicios_card_icon'], ['📅']),
                                new Span(['class' => 'servicios_card_badge'], ['Pro'])
                            ]),
                            new H3(['class' => 'servicios_card_title'], ['Sistema de Reservas']),
                            new P(['class' => 'servicios_card_description'], [
                                'Permite que tus clientes reserven citas o servicios directamente desde tu perfil.'
                            ]),
                            new Ul(['class' => 'servicios_card_features'], [
                                new Li([], ['Calendario integrado']),
                                new Li([], ['Horarios disponibles']),
                                new Li([], ['Confirmación automática']),
                                new Li([], ['Recordatorios por email'])
                            ])
                        ]),

                        // Curriculum
                        new Div(['class' => 'servicios_card'], [
                            new Div(['class' => 'servicios_card_header'], [
                                new Div(['class' => 'servicios_card_icon'], ['👨‍💼']),
                                new Span(['class' => 'servicios_card_badge'], ['Pro'])
                            ]),
                            new H3(['class' => 'servicios_card_title'], ['Curriculum Vitae']),
                            new P(['class' => 'servicios_card_description'], [
                                'Presenta tu experiencia profesional de manera moderna e interactiva.'
                            ]),
                            new Ul(['class' => 'servicios_card_features'], [
                                new Li([], ['Experiencia laboral']),
                                new Li([], ['Habilidades y competencias']),
                                new Li([], ['Portfolio integrado']),
                                new Li([], ['Enlace Personalizado'])
                            ])
                        ]),

                        // Eventos
                        new Div(['class' => 'servicios_card'], [
                            new Div(['class' => 'servicios_card_header'], [
                                new Div(['class' => 'servicios_card_icon'], ['🎉']),
                                new Span(['class' => 'servicios_card_badge'], ['Nuevo'])
                            ]),
                            new H3(['class' => 'servicios_card_title'], ['Gestión de Eventos']),
                            new P(['class' => 'servicios_card_description'], [
                                'Organiza y promociona tus eventos con inscripciones y seguimiento.'
                            ]),
                            new Ul(['class' => 'servicios_card_features'], [
                                new Li([], ['Creación de eventos']),
                                new Li([], ['Inscripciones online']),
                                new Li([], ['Lista de asistentes']),
                                new Li([], ['Recordatorios automáticos'])
                            ])
                        ]),

                        // Próximamente
                        new Div(['class' => 'servicios_card coming_soon'], [
                            new Div(['class' => 'servicios_card_header'], [
                                new Div(['class' => 'servicios_card_icon'], ['🚀']),
                                new Span(['class' => 'servicios_card_badge'], ['Próximamente'])
                            ]),
                            new H3(['class' => 'servicios_card_title'], ['¡Y mucho más!']),
                            new P(['class' => 'servicios_card_description'], [
                                'Estamos desarrollando nuevas funcionalidades constantemente.'
                            ]),
                            new Ul(['class' => 'servicios_card_features'], [
                                new Li([], ['Blog integrado']),
                                new Li([], ['Tienda online']),
                                new Li([], ['Chat en vivo']),
                                new Li([], ['Analíticas avanzadas'])
                            ])
                        ])
                    ]),

                    // CTA Section
                    new Div(['class' => 'servicios_cta'], [
                        new Div(['class' => 'servicios_cta_content'], [
                            new H3(['class' => 'servicios_cta_title'], ['¿Listo para potenciar tu presencia digital?']),
                            new P(['class' => 'servicios_cta_text'], [
                                'Combina todas estas funcionalidades en una sola plataforma y lleva tu marca al siguiente nivel.'
                            ]),
                            new Div(['class' => 'servicios_buttons'], [
                                new A(['class' => 'servicios_button primary', 'href' => 'crear'], ['Empezar gratis']),
                                new A(['class' => 'servicios_button secondary', 'href' => '#planes'], ['Ver Planes'])
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
