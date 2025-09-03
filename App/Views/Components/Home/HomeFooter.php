<?php
namespace App\Views\Components\Home;

use Flame\Html\Tags\Footer;
use Flame\Html\Tags\Div;
use Flame\Html\Tags\H4;
use Flame\Html\Tags\P;
use Flame\Html\Tags\Button;
use Flame\Html\Tags\Span;
use Flame\Html\Tags\A;
use Flame\Html\Tags\Form;
use Flame\Html\Tags\Img;
use Flame\Html\Tags\Input;
use Flame\Html\Tags\Ul;
use Flame\Html\Tags\Li;

final class HomeFooter extends Footer
{
    public function __construct(?array $data=[])
    {
        parent::__construct(
            ['class' => 'footer'],
            [
                new Div(['class' => 'footer_container'], [
                    
                    // Sección principal del footer
                    new Div(['class' => 'footer_main'], [
                        
                        // Columna de la empresa
                        new Div(['class' => 'footer_column footer_brand'], [
                            new Div(['class' => 'footer_logo'], [
                                new Img(['src'=>$_ENV['ICON2']]),
                            ]),
                            new P(['class' => 'footer_description'], [
                                'La primera plataforma argentina para crear tu presencia digital. ',
                                'Más que una biolink, tu espacio personal en internet.'
                            ]),
                            new Div(['class' => 'footer_social'], [
                                new A([
                                    'href' => 'https://wa.me/'.$data['whatsapp'],
                                    'class' => 'footer_social_link whatsapp',
                                    'target' => '_blank',
                                    'aria-label' => 'WhatsApp'
                                ], ['💬']),
                                new A([
                                    'href' => 'https://instagram.com/'.$data['instagram'],
                                    'class' => 'footer_social_link instagram',
                                    'target' => '_blank',
                                    'aria-label' => 'Instagram'
                                ], ['📸']),
                                new A([
                                    'href' => 'https://tiktok.com/@'.$data['tiktok'],
                                    'class' => 'footer_social_link tiktok',
                                    'target' => '_blank',
                                    'aria-label' => 'TikTok'
                                ], ['🎵']),
                                new A([
                                    'href' => 'https://twitter.com/'.$data['twitter'],
                                    'class' => 'footer_social_link twitter',
                                    'target' => '_blank',
                                    'aria-label' => 'Twitter'
                                ], ['🐦'])
                            ])
                        ]),

                        // Columna de productos
                        new Div(['class' => 'footer_column'], [
                            new H4(['class' => 'footer_column_title'], ['Producto']),
                            new Ul(['class' => 'footer_links'], [
                                new Li([], [new A(['href' => '#servicios', 'class' => 'footer_link'], ['Funcionalidades'])]),
                                new Li([], [new A(['href' => '#planes', 'class' => 'footer_link'], ['Planes y precios'])]),
                            ])
                        ]),

                        // Columna de empresa
                        new Div(['class' => 'footer_column'], [
                            new H4(['class' => 'footer_column_title'], ['Empresa']),
                            new Ul(['class' => 'footer_links'], [
                                new Li([], [new A(['href' => '#nosotros', 'class' => 'footer_link'], ['Sobre nosotros'])]),
                                new Li([], [new A(['href' => $_ENV['DOMAIN'].'/blog', 'class' => 'footer_link'], ['Blog'])]),
                                new Li([], [new A(['href' => $_ENV['DOMAIN'].'/afiliados', 'class' => 'footer_link'], ['Programa de afiliados'])]),
                            ])
                        ]),

                        // Columna de soporte
                        new Div(['class' => 'footer_column'], [
                            new H4(['class' => 'footer_column_title'], ['Soporte']),
                            new Ul(['class' => 'footer_links'], [
                                new Li([], [new A(['href' => '#contacto', 'class' => 'footer_link'], ['Contacto'])]),
                                new Li([], [new A(['href' => $_ENV['DOMAIN'].'/ayuda', 'class' => 'footer_link'], ['Centro de ayuda'])]),
                                new Li([], [new A(['href' => $_ENV['DOMAIN'].'/faq', 'class' => 'footer_link'], ['Preguntas frecuentes'])]),
                                new Li([], [new A(['href' => $_ENV['DOMAIN'].'/feedback', 'class' => 'footer_link'], ['Dejanos tu feedback'])]),
                            ])
                        ]),

                        // Columna de newsletter
                        new Div(['class' => 'footer_column footer_newsletter'], [
                            new H4(['class' => 'footer_column_title'], ['Mantenete al día']),
                            new P(['class' => 'footer_newsletter_text'], [
                                'Suscribite para recibir novedades, tips y ofertas exclusivas. ',
                                'Solo contenido copado, nada de spam.'
                            ]),
                            new Form(['class' => 'footer_newsletter_form', 'data-form' => 'newsletter'], [
                                new Div(['class' => 'footer_newsletter_input_group'], [
                                    new Input([
                                        'type' => 'email',
                                        'placeholder' => 'tu@email.com',
                                        'class' => 'footer_newsletter_input',
                                        'required' => true,
                                        'name' => 'email'
                                    ]),
                                    new Button(['type' => 'submit', 'class' => 'footer_newsletter_button'], ['Suscribirme'])
                                ])
                            ]),
                            new P(['class' => 'footer_newsletter_note'], [
                                '🔒 Tu email está seguro con nosotros'
                            ])
                        ])
                    ]),

                    // Sección de información adicional
                    new Div(['class' => 'footer_info'], [
                        new Div(['class' => 'footer_info_grid'], [
                            new Div(['class' => 'footer_info_item'], [
                                new Span(['class' => 'footer_info_icon'], ['📍']),
                                new Div(['class' => 'footer_info_content'], [
                                    new Span(['class' => 'footer_info_label'], ['Ubicación']),
                                    new Span(['class' => 'footer_info_value'], ['Córdoba, Argentina'])
                                ])
                            ]),
                            new Div(['class' => 'footer_info_item'], [
                                new Span(['class' => 'footer_info_icon'], ['📧']),
                                new Div(['class' => 'footer_info_content'], [
                                    new Span(['class' => 'footer_info_label'], ['Email']),
                                    new A(['href' => 'mailto:'.$data['email'], 'class' => 'footer_info_value footer_info_link'], [$data['email']])
                                ])
                            ]),
                            new Div(['class' => 'footer_info_item'], [
                                new Span(['class' => 'footer_info_icon'], ['💬']),
                                new Div(['class' => 'footer_info_content'], [
                                    new Span(['class' => 'footer_info_label'], ['WhatsApp']),
                                    new A(['href' => 'https://wa.me/'.$data['whatsapp'], 'class' => 'footer_info_value footer_info_link'], ['+'.$data['whatsapp']])
                                ])
                            ]),
                            new Div(['class' => 'footer_info_item'], [
                                new Span(['class' => 'footer_info_icon'], ['⏰']),
                                new Div(['class' => 'footer_info_content'], [
                                    new Span(['class' => 'footer_info_label'], ['Horarios']),
                                    new Span(['class' => 'footer_info_value'], ['Lun a Vie 9-20hs'])
                                ])
                            ])
                        ])
                    ]),

                    // Sección legal y copyright
                    new Div(['class' => 'footer_bottom'], [
                        new Div(['class' => 'footer_legal'], [
                            new P(['class' => 'footer_copyright'], [
                                '© 2024 AppSite. Todos los derechos reservados. ',
                                'Hecho con ❤️ en Argentina.'
                            ]),
                            new Div(['class' => 'footer_legal_links'], [
                                new A(['href' => '/privacidad', 'class' => 'footer_legal_link'], ['Política de Privacidad']),
                                new A(['href' => '/terminos', 'class' => 'footer_legal_link'], ['Términos de Uso']),
                                new A(['href' => '/cookies', 'class' => 'footer_legal_link'], ['Cookies']),
                                new A(['href' => '/defensa-consumidor', 'class' => 'footer_legal_link'], ['Defensa del Consumidor'])
                            ])
                        ]),
                        
                        new Div(['class' => 'footer_badges'], [
                            new Div(['class' => 'footer_badge'], [
                                new Span(['class' => 'footer_badge_icon'], ['🔒']),
                                new Span(['class' => 'footer_badge_text'], ['SSL Seguro'])
                            ]),
                            new Div(['class' => 'footer_badge'], [
                                new Span(['class' => 'footer_badge_icon'], ['🇦🇷']),
                                new Span(['class' => 'footer_badge_text'], ['Empresa Argentina'])
                            ]),
                            new Div(['class' => 'footer_badge'], [
                                new Span(['class' => 'footer_badge_icon'], ['💳']),
                                new Span(['class' => 'footer_badge_text'], ['Pagos Seguros'])
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
