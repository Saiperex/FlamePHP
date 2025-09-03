<?php
namespace App\Views\Components\Constructor;

use Flame\Html\Tags\Head;
use Flame\Html\Tags\Link;
use Flame\Html\Tags\Meta;
use Flame\Html\Tags\Title;
use Flame\Html\Tags\Script;

final class ConstructorHead extends Head
{
    public function __construct(array $chilldrens = [], ?string $title = "Evoluciona tu Bio Link en una Bio Landing" )
    {
        parent::__construct(array_merge(
            [
            // Título y metadatos básicos
            new Title("AppSite - ".$title),
            new Meta(['name' => 'description', 'content' => 'AppSite es la nueva forma de crear tu Bio Link: una Bio Landing personalizable con widgets, estadísticas, reservas y más. Ideal para negocios, profesionales y creadores.']),
            new Meta(['name' => 'keywords', 'content' => 'bio link, bio landing, link en bio, carta digital, reservas online, landing personalizada, qr personalizable, enlaces sociales, AppSite']),
            new Meta(['name' => 'author', 'content' => 'AppSite']),
            new Meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0']),
            new Meta(['charset' => 'UTF-8']),

            // INDEXACIÓN Y ROBOTS
            new Meta(['name' => 'robots', 'content' => 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1']),
            new Meta(['name' => 'googlebot', 'content' => 'index, follow']),

            // Canonical y favicon
            new Link(['rel' => 'canonical', 'href' => $_ENV['DOMAIN']]),
            new Link(['rel' => 'icon', 'type' => 'image/png', 'href' => $_ENV['ICON4']]),

            // Open Graph (Facebook, LinkedIn, etc.)
            new Meta(['property' => 'og:title', 'content' => 'AppSite - Evoluciona tu Bio Link en una Bio Landing']),
            new Meta(['property' => 'og:description', 'content' => 'AppSite te permite crear una Bio Landing con widgets, estadísticas, reservas, QR y más. Potencia tu presencia digital con una landing funcional y atractiva.']),
            new Meta(['property' => 'og:type', 'content' => 'website']),
            new Meta(['property' => 'og:url', 'content' => $_ENV['DOMAIN']]),
            new Meta(['property' => 'og:image', 'content' => $_ENV['DOMAIN'] . '/og-image.jpg']),
            new Meta(['property' => 'og:site_name', 'content' => 'AppSite']),

            // Twitter Cards
            new Meta(['name' => 'twitter:card', 'content' => 'summary_large_image']),
            new Meta(['name' => 'twitter:title', 'content' => 'AppSite - Evoluciona tu Bio Link en una Bio Landing']),
            new Meta(['name' => 'twitter:description', 'content' => 'Crea tu Bio Landing con AppSite: enlaces, carta digital, reservas, QR y más. Ideal para negocios y creadores.']),
            new Meta(['name' => 'twitter:image', 'content' => $_ENV['DOMAIN'] . '/og-image.jpg']),
            new Meta(['name' => 'twitter:site', 'content' => '@AppSite']),
            new Meta(['name' => 'twitter:creator', 'content' => '@AppSite']),

            // Google Fonts (20 fuentes populares + las que ya tenías)
            new Link([
                'rel' => 'preconnect',
                'href' => 'https://fonts.googleapis.com'
            ]),
            new Link([
                'rel' => 'preconnect',
                'href' => 'https://fonts.gstatic.com',
                'crossorigin' => 'anonymous'
            ]),
            new Link([
                'rel' => 'stylesheet',
                'href' => 'https://fonts.googleapis.com/css2?' .
                    'family=Inter:wght@100..900&' .
                    'family=Rajdhani:wght@300;400;500;600;700&' .
                    'family=Rubik:wght@300..900&' .
                    'family=Space+Grotesk:wght@300..700&' .
                    'family=Roboto:wght@100..900&' .
                    'family=Open+Sans:wght@300..800&' .
                    'family=Lato:wght@100..900&' .
                    'family=Montserrat:wght@100..900&' .
                    'family=Oswald:wght@200..700&' .
                    'family=Raleway:wght@100..900&' .
                    'family=Playfair+Display:wght@400..900&' .
                    'family=Merriweather:wght@300..900&' .
                    'family=Nunito:wght@200..1000&' .
                    'family=Ubuntu:wght@300..700&' .
                    'family=Poppins:wght@100..900&' .
                    'family=Source+Sans+Pro:wght@200..900&' .
                    'family=Titillium+Web:wght@200..900&' .
                    'family=Quicksand:wght@300..700&' .
                    'family=Fira+Sans:wght@100..900&' .
                    'family=PT+Sans:wght@400..700&' .
                    'family=Cabin:wght@400..700&' .
                    'display=swap'
            ]),

            // FontAwesome (script externo)
            new Script([
                'src' => 'https://kit.fontawesome.com/c8bf7962f3.js',
                'crossorigin' => 'anonymous'
            ]),
            // Swiper CSS
            new Link(['rel' => 'stylesheet', 'href' => 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css']),
        ],
        $chilldrens
        ));
    }
}
