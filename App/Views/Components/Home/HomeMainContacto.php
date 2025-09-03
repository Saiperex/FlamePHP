<?php
namespace App\Views\Components\Home;

use Flame\Html\Tags\Section;
use Flame\Html\Tags\Div;
use Flame\Html\Tags\H2;
use Flame\Html\Tags\H3;
use Flame\Html\Tags\H4;
use Flame\Html\Tags\P;
use Flame\Html\Tags\Button;
use Flame\Html\Tags\Span;
use Flame\Html\Tags\A;
use Flame\Html\Tags\Form;
use Flame\Html\Tags\Input;
use Flame\Html\Tags\TextArea;
use Flame\Html\Tags\Label;

final class HomeMainContacto extends Section
{
    public function __construct(?array $contacto=[])
    {
        parent::__construct(
            ['class' => 'contacto', 'id' => 'contacto'],
            [
                new Div(['class' => 'contacto_container'], [
                    
                    // Header de la sección
                    new Div(['class' => 'contacto_header'], [
                        new Span(['class' => 'contacto_badge'], ['Hablemos']),
                        new H2(['class' => 'contacto_title'], ['¿Tenés alguna duda? Charlemos']),
                        new P(['class' => 'contacto_subtitle'], [
                            'Estamos acá para ayudarte. Elegí la forma que más te guste para contactarnos. ',
                            'Te respondemos al toque y en criollo, como debe ser.'
                        ])
                    ]),

                    // Grid de métodos de contacto
                    new Div(['class' => 'contacto_methods'], [
                        
                        // WhatsApp
                        new Div(['class' => 'contacto_method whatsapp'], [
                            new Div(['class' => 'contacto_method_icon'], [
                                new Span(['class' => 'contacto_icon_bg whatsapp_bg'], []),
                                new Span(['class' => 'contacto_icon_symbol'], ['<i class="fa-brands fa-whatsapp"></i>'])
                            ]),
                            new Div(['class' => 'contacto_method_content'], [
                                new H3(['class' => 'contacto_method_title'], ['WhatsApp']),
                                new P(['class' => 'contacto_method_description'], [
                                    'La forma más rápida de contactarnos. Te respondemos al toque y resolvemos tus dudas en el momento.'
                                ]),
                                new Div(['class' => 'contacto_method_info'], [
                                    new Span(['class' => 'contacto_info_label'], ['Número:']),
                                    new Span(['class' => 'contacto_info_value'], ['+'.$contacto['whatsapp']])
                                ]),
                                new Div(['class' => 'contacto_method_info'], [
                                    new Span(['class' => 'contacto_info_label'], ['Horario:']),
                                    new Span(['class' => 'contacto_info_value'], ['Lun a Vie 9 a 20hs'])
                                ]),
                                new A([
                                    'href' => 'https://wa.me/'.$contacto['whatsapp'].'?text=¡Hola!%20Quiero%20saber%20más%20sobre%20AppSite%20🇦🇷',
                                    'class' => 'contacto_method_button whatsapp_button',
                                    'target' => '_blank',
                                    'data-platform' => 'whatsapp'
                                ], ['Escribir por WhatsApp'])
                            ])
                        ]),

                        // Instagram
                        new Div(['class' => 'contacto_method instagram'], [
                            new Div(['class' => 'contacto_method_icon'], [
                                new Span(['class' => 'contacto_icon_bg instagram_bg'], []),
                                new Span(['class' => 'contacto_icon_symbol'], ['<i class="fa-brands fa-instagram"></i>'])
                            ]),
                            new Div(['class' => 'contacto_method_content'], [
                                new H3(['class' => 'contacto_method_title'], ['Instagram']),
                                new P(['class' => 'contacto_method_description'], [
                                    'Seguinos para ver ejemplos, tips y novedades. También podés mandarnos un DM para consultas rápidas.'
                                ]),
                                new Div(['class' => 'contacto_method_info'], [
                                    new Span(['class' => 'contacto_info_label'], ['Usuario:']),
                                    new Span(['class' => 'contacto_info_value'], ['@'.$contacto['instagram']])
                                ]),
                                new Div(['class' => 'contacto_method_info'], [
                                    new Span(['class' => 'contacto_info_label'], ['Contenido:']),
                                    new Span(['class' => 'contacto_info_value', 'style'=>'text-align:center;'], ['Tips, ejemplos y más'])
                                ]),
                                new A([
                                    'href' => 'https://instagram.com/'.$contacto['instagram'],
                                    'class' => 'contacto_method_button instagram_button',
                                    'target' => '_blank',
                                    'data-platform' => 'instagram'
                                ], ['Seguir en Instagram'])
                            ])
                        ]),

                        // TikTok
                        new Div(['class' => 'contacto_method tiktok'], [
                            new Div(['class' => 'contacto_method_icon'], [
                                new Span(['class' => 'contacto_icon_bg tiktok_bg'], []),
                                new Span(['class' => 'contacto_icon_symbol'], ['<i class="fa-brands fa-tiktok"></i>'])
                            ]),
                            new Div(['class' => 'contacto_method_content'], [
                                new H3(['class' => 'contacto_method_title'], ['TikTok']),
                                new P(['class' => 'contacto_method_description'], [
                                    'Tutoriales rápidos, antes y después de AppSites, y toda la onda para que aprendas mientras te divertís.'
                                ]),
                                new Div(['class' => 'contacto_method_info'], [
                                    new Span(['class' => 'contacto_info_label'], ['Usuario:']),
                                    new Span(['class' => 'contacto_info_value'], ['@'.$contacto['instagram']])
                                ]),
                                new Div(['class' => 'contacto_method_info'], [
                                    new Span(['class' => 'contacto_info_label'], ['Contenido:']),
                                    new Span(['class' => 'contacto_info_value'], ['Tutoriales y tips'])
                                ]),
                                new A([
                                    'href' => 'https://tiktok.com/@'.$contacto['instagram'],
                                    'class' => 'contacto_method_button tiktok_button',
                                    'target' => '_blank',
                                    'data-platform' => 'tiktok'
                                ], ['Seguir en TikTok'])
                            ])
                        ])
                    ]),

                    // Formulario de contacto alternativo
                    new Div(['class' => 'contacto_form_section'], [
                        new Div(['class' => 'contacto_form_header'], [
                            new H3(['class' => 'contacto_form_title'], ['¿Preferís escribirnos por acá?']),
                            new P(['class' => 'contacto_form_subtitle'], [
                                'Dejanos tu consulta y te respondemos por email en menos de 24 horas.'
                            ])
                        ]),
                        
                        new Form(['class' => 'contacto_form', 'data-form' => 'contacto'], [
                            new Div(['class' => 'contacto_form_row'], [
                                new Div(['class' => 'contacto_form_group'], [
                                    new Label(['for' => 'nombre', 'class' => 'contacto_form_label'], ['Nombre']),
                                    new Input([
                                        'type' => 'text',
                                        'id' => 'nombre',
                                        'name' => 'nombre',
                                        'class' => 'contacto_form_input',
                                        'placeholder' => 'Tu nombre',
                                        'required' => true
                                    ])
                                ]),
                                new Div(['class' => 'contacto_form_group'], [
                                    new Label(['for' => 'email', 'class' => 'contacto_form_label'], ['Email']),
                                    new Input([
                                        'type' => 'email',
                                        'id' => 'email',
                                        'name' => 'email',
                                        'class' => 'contacto_form_input',
                                        'placeholder' => 'tu@email.com',
                                        'required' => true
                                    ])
                                ])
                            ]),
                            
                            new Div(['class' => 'contacto_form_group'], [
                                new Label(['for' => 'asunto', 'class' => 'contacto_form_label'], ['Asunto']),
                                new Input([
                                    'type' => 'text',
                                    'id' => 'asunto',
                                    'name' => 'asunto',
                                    'class' => 'contacto_form_input',
                                    'placeholder' => '¿De qué querés hablar?',
                                    'required' => true
                                ])
                            ]),
                            
                            new Div(['class' => 'contacto_form_group'], [
                                new Label(['for' => 'mensaje', 'class' => 'contacto_form_label'], ['Mensaje']),
                                new TextArea([
                                    'id' => 'mensaje',
                                    'name' => 'mensaje',
                                    'class' => 'contacto_form_textarea',
                                    'placeholder' => 'Contanos tu consulta, idea o lo que necesites...',
                                    'rows' => '5',
                                    'required' => true
                                ])
                            ]),
                            
                            new Button(['type' => 'submit', 'class' => 'contacto_form_submit'], ['Enviar mensaje'])
                        ])
                    ]),

                    // Información adicional
                    new Div(['class' => 'contacto_info_extra'], [
                        new Div(['class' => 'contacto_info_grid'], [
                            new Div(['class' => 'contacto_info_item'], [
                                new Div(['class' => 'contacto_info_icon'], ['⏰']),
                                new H4(['class' => 'contacto_info_item_title'], ['Horarios de atención']),
                                new P(['class' => 'contacto_info_item_text'], [
                                    'Lunes a Viernes de 9 a 20hs (GMT-3). ',
                                    'Los fines de semana respondemos consultas urgentes por WhatsApp.'
                                ])
                            ]),
                            
                            new Div(['class' => 'contacto_info_item'], [
                                new Div(['class' => 'contacto_info_icon'], ['🚀']),
                                new H4(['class' => 'contacto_info_item_title'], ['Tiempo de respuesta']),
                                new P(['class' => 'contacto_info_item_text'], [
                                    'WhatsApp: Al toque (en horario de atención). ',
                                    'Email: Menos de 24 horas. Redes sociales: Dentro del día.'
                                ])
                            ]),
                            
                            new Div(['class' => 'contacto_info_item'], [
                                new Div(['class' => 'contacto_info_icon'], ['🇦🇷']),
                                new H4(['class' => 'contacto_info_item_title'], ['Soporte en español']),
                                new P(['class' => 'contacto_info_item_text'], [
                                    'Todo nuestro equipo habla español argentino. ',
                                    'Nada de chatbots o respuestas automáticas en inglés.'
                                ])
                            ])
                        ])
                    ]),

                    // CTA final
                    new Div(['class' => 'contacto_cta'], [
                        new H3(['class' => 'contacto_cta_title'], ['¿Listo para empezar?']),
                        new P(['class' => 'contacto_cta_text'], [
                            'No te quedes con dudas. Contactanos por donde más te guste y empezá a crear tu AppSite hoy mismo.'
                        ]),
                        new Button(['class' => 'contacto_cta_button', 'data-action' => 'empezar'], ['Crear mi AppSite gratis'])
                    ])
                ])
            ]
        );
        $this->registerAssetsCSS();
        $this->registerAssetsJS();
    }
}
