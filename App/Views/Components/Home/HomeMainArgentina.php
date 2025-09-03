<?php
namespace App\Views\Components\Home;

use Flame\Html\Tags\Section;
use Flame\Html\Tags\Div;
use Flame\Html\Tags\H2;
use Flame\Html\Tags\H3;
use Flame\Html\Tags\H4;
use Flame\Html\Tags\P;
use Flame\Html\Tags\Span;
use Flame\Html\Tags\A;

final class HomeMainArgentina extends Section
{
    public function __construct(?array $data)
    {
        parent::__construct(
            ['class' => 'argentina'],
            [
                new Div(['class' => 'argentina_container'], [
                    
                    // Header de la sección
                    new Div(['class' => 'argentina_header'], [
                        new Div(['class' => 'argentina_flag'], ['🇦🇷']),
                        new Span(['class' => 'argentina_badge'], ['100% Argentino']),
                        new H2(['class' => 'argentina_title'], ['Hecho en Argentina, para argentinos']),
                        new P(['class' => 'argentina_subtitle'], [
                            '¿Cansado de pagar en dólares y que te cobren como si fueras millonario? ',
                            'AppSite es la primera plataforma argentina que entiende tu realidad. ',
                            'Precios en pesos, soporte en criollo y sin vueltas.'
                        ])
                    ]),

                    // Grid principal de ventajas argentinas
                    new Div(['class' => 'argentina_grid'], [
                        
                        // Precios en pesos
                        new Div(['class' => 'argentina_card'], [
                            new Div(['class' => 'argentina_card_icon'], ['💰']),
                            new H3(['class' => 'argentina_card_title'], ['Precios en pesos, che']),
                            new P(['class' => 'argentina_card_text'], [
                                'Nada de "son 10 dólares" y que te terminen cobrando 15 lucas. ',
                                'Acá el precio que ves es el que pagás. En pesos argentinos, como debe ser.'
                            ]),
                            new Div(['class' => 'argentina_card_highlight'], [
                                '$2.000 ARS/mes (no U$S 2 que después son $3.500)'
                            ])
                        ]),

                        // Soporte local
                        new Div(['class' => 'argentina_card'], [
                            new Div(['class' => 'argentina_card_icon'], ['🧉']),
                            new H3(['class' => 'argentina_card_title'], ['Soporte tomando mate']),
                            new P(['class' => 'argentina_card_text'], [
                                'Nuestro equipo está en Córdoba, entiende cuando decís "no entiendo un carajo" ',
                                'y te responde en horario argentino. No más chatbots que no entienden una goma.'
                            ]),
                            new Div(['class' => 'argentina_card_highlight'], [
                                'Lunes a Viernes 9 a 18hs (GMT-3)'
                            ])
                        ]),

                        // Sin trabas burocráticas
                        new Div(['class' => 'argentina_card'], [
                            new Div(['class' => 'argentina_card_icon'], ['⚡']),
                            new H3(['class' => 'argentina_card_title'], ['Sin trabas burocráticas']),
                            new P(['class' => 'argentina_card_text'], [
                                'Te registrás con tu email y listo. No necesitás pasaporte, ',
                                'declaración jurada ni firmar 47 términos y condiciones en inglés que nadie lee.'
                            ]),
                            new Div(['class' => 'argentina_card_highlight'], [
                                'Registro en 2 minutos, sin papelerío'
                            ])
                        ]),

                        // Entendemos la realidad argentina
                        new Div(['class' => 'argentina_card'], [
                            new Div(['class' => 'argentina_card_icon'], ['🏦']),
                            new H3(['class' => 'argentina_card_title'], ['Entendemos tu realidad']),
                            new P(['class' => 'argentina_card_text'], [
                                'Sabemos que el precio del dolar es mas inestable que tu Ex, ',
                                'por eso nuestros precios se mantienen estables en pesos. Tu bolsillo nos lo va a agradecer.'
                            ]),
                            new Div(['class' => 'argentina_card_highlight'], [
                                'Precio fijo en ARS, sin sorpresas'
                            ])
                        ])
                    ]),

                    // Sección de contacto directo
                    new Div(['class' => 'argentina_contact'], [
                        new Div(['class' => 'argentina_contact_content'], [
                            new H3(['class' => 'argentina_contact_title'], ['¿Tenés alguna duda? Hablemos']),
                            new P(['class' => 'argentina_contact_text'], [
                                'No somos una multinacional que te deja hablando solo. ',
                                'Somos un equipo argentino que entiende tus necesidades y habla tu idioma.'
                            ]),
                            
                            new Div(['class' => 'argentina_contact_methods'], [
                                new Div(['class' => 'argentina_contact_method'], [
                                    new Div(['class' => 'argentina_contact_method_icon'], ['📱']),
                                    new Div(['class' => 'argentina_contact_method_info'], [
                                        new H4([], ['WhatsApp']),
                                        new P([], ['Te respondemos al toque']),
                                        new A(['href' => 'https://wa.me/'.$data['whatsapp'], 'class' => 'argentina_contact_link'], ['+'.$data['whatsapp']])
                                    ])
                                ]),
                                
                                new Div(['class' => 'argentina_contact_method'], [
                                    new Div(['class' => 'argentina_contact_method_icon'], ['✉️']),
                                    new Div(['class' => 'argentina_contact_method_info'], [
                                        new H4([], ['Email']),
                                        new P([], ['Para consultas más técnicas']),
                                        new A(['href' => 'mailto:'.$data['email'], 'class' => 'argentina_contact_link'], [$data['email']])
                                    ])
                                ])
                            ])
                        ])
                    ]),

                    // Sección de datos argentinos
                    new Div(['class' => 'argentina_stats'], [
                        new H3(['class' => 'argentina_stats_title'], ['AppSite en números argentinos']),
                        new Div(['class' => 'argentina_stats_grid'], [
                            new Div(['class' => 'argentina_stat'], [
                                new Div(['class' => 'argentina_stat_number'], ['2.500+']),
                                new Div(['class' => 'argentina_stat_label'], ['Argentinos ya confían en nosotros'])
                            ]),
                            new Div(['class' => 'argentina_stat'], [
                                new Div(['class' => 'argentina_stat_number'], ['24hs']),
                                new Div(['class' => 'argentina_stat_label'], ['Tiempo promedio de respuesta'])
                            ]),
                            new Div(['class' => 'argentina_stat'], [
                                new Div(['class' => 'argentina_stat_number'], ['100%']),
                                new Div(['class' => 'argentina_stat_label'], ['Desarrollado en Córdoba'])
                            ]),
                            new Div(['class' => 'argentina_stat'], [
                                new Div(['class' => 'argentina_stat_number'], ['0']),
                                new Div(['class' => 'argentina_stat_label'], ['Dolores de cabeza'])
                            ])
                        ])
                    ]),

                    // Testimonios argentinos
                    new Div(['class' => 'argentina_testimonials'], [
                        new H3(['class' => 'argentina_testimonials_title'], ['Lo que dicen los pibes']),
                        new Div(['class' => 'argentina_testimonials_grid'], [
                            new Div(['class' => 'argentina_testimonial'], [
                                new P(['class' => 'argentina_testimonial_text'], [
                                    '"Loco, por fin una app que no me cobra en dólares. ',
                                    'Y cuando tuve un problema me respondieron al toque por WhatsApp. 10 puntos."'
                                ]),
                                new Div(['class' => 'argentina_testimonial_author'], [
                                    new Span(['class' => 'argentina_testimonial_name'], ['Martín']),
                                    new Span(['class' => 'argentina_testimonial_location'], ['Córdoba, Argentina'])
                                ])
                            ]),
                            
                            new Div(['class' => 'argentina_testimonial'], [
                                new P(['class' => 'argentina_testimonial_text'], [
                                    '"Estaba podrido de Linktree y sus precios en dólares. ',
                                    'AppSite me salió la mitad y funciona mejor. Aguante lo nacional."'
                                ]),
                                new Div(['class' => 'argentina_testimonial_author'], [
                                    new Span(['class' => 'argentina_testimonial_name'], ['Lucía']),
                                    new Span(['class' => 'argentina_testimonial_location'], ['Rosario, Argentina'])
                                ])
                            ]),
                            
                            new Div(['class' => 'argentina_testimonial'], [
                                new P(['class' => 'argentina_testimonial_text'], [
                                    '"Me encanta que sea argentino. Cuando necesité ayuda, ',
                                    'me explicaron todo re facil y sin vueltas. Así da gusto."'
                                ]),
                                new Div(['class' => 'argentina_testimonial_author'], [
                                    new Span(['class' => 'argentina_testimonial_name'], ['Diego']),
                                    new Span(['class' => 'argentina_testimonial_location'], ['Mendoza, Argentina'])
                                ])
                            ])
                        ])
                    ]),

                    // CTA final
                    new Div(['class' => 'argentina_cta'], [
                        new Div(['class' => 'argentina_cta_content'], [
                            new H3(['class' => 'argentina_cta_title'], ['Dale, probá AppSite']),
                            new P(['class' => 'argentina_cta_text'], [
                                'Sumate a los miles de argentinos que ya eligieron lo nacional. ',
                                '2 días gratis para que veas que no te estamos chamuyando.'
                            ]),
                            new Div(['class' => 'argentina_buttons'], [
                                new A(['class' => 'argentina_button primary', 'href' => 'crear'], ['Probar 2 días gratis']),
                                new A(['class' => 'argentina_button secondary', 'href' => 'https://wa.me/'.$data['whatsapp'].'?text= Hola! Quiero ser parte de AppSite','target'=>'blank'], ['Hablar por WhatsApp'])
                            ]),
                            new P(['class' => 'argentina_cta_note'], [
                                'Sin tarjeta, sin dólares, sin drama 🇦🇷'
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
