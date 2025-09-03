<?php

namespace App\views\Components\Constructor;

use App\Views\Components\Constructor\ConstructorOpcCategory;
use App\Views\Components\Constructor\ConstructorOpcRubro;
use Flame\Html\Tags\Button;
use Flame\Html\Tags\Div;
use Flame\Html\Tags\Form;
use Flame\Html\Tags\H2;
use Flame\Html\Tags\H3;
use Flame\Html\Tags\Input;
use Flame\Html\Tags\Label;
use Flame\Html\Tags\Option;
use Flame\Html\Tags\P;
use Flame\Html\Tags\Section;
use Flame\Html\Tags\Select;
use Flame\Html\Tags\Span;
use Flame\Html\Tags\TextArea;

final class ConstructorSection extends Section
{
    private array $data;
    public function __construct(array $data = [])
    {
        $this->data = $data;
        parent::__construct(
            ['class' => 'constructor'],
            [
                new Div(
                    ['class' => 'constructor_area constructor_data'],
                    [
                        new Form(
                            ['data-name' => 'constructor_form', 'class' => 'form_constructor'],
                            [
                                new Div(
                                    ['class' => 'etapas_content'],
                                    [
                                        // Etapa 1: Slug
                                        new Div(
                                            ['class' => 'constructor_etapa'],
                                            [
                                                new H2([], ['Fase 1: Nombre']),
                                                new Label(['for' => 'slug', 'class' => 'label'], ['Elige el nombre de tu AppSite']),
                                                new Div(
                                                    ['class' => 'slug_area'],
                                                    [
                                                        new Input(['data-name' => 'slug', 'data-type' => 'render', 'data-event' => 'input', 'name' => 'slug', 'type' => 'text', 'id' => 'slug', 'placeholder' => 'NombreGenial'])
                                                    ]
                                                ),
                                                new P(['id' => 'slug_message'])
                                            ]
                                        ),
                                        // Etapa 2: Rubro
                                        new Div(
                                            ['class' => 'constructor_etapa etapa_rubro'],
                                            [
                                                new H2([], ['Fase 2: Rubro']),
                                                new Label(['for' => 'rubro', 'class' => 'label'], ['Elige el rubro que mas se adapte a ti']),
                                                new Div(
                                                    ['class' => 'rubros_opciones'],
                                                    [
                                                        $this->rubroOpcion('gastronomico', '🥩', 'Gastronomico'),
                                                        $this->rubroOpcion('barberia', '✂️', 'Barberías'),
                                                        $this->rubroOpcion('tienda', '🛍️', 'Tiendas'),
                                                        $this->rubroOpcion('clases', '🧘‍♂️', 'Profesores / Clases'),
                                                        $this->rubroOpcion('alojamiento', '🏨', 'Inmobiliario'),
                                                        $this->rubroOpcion('artistas', '🎤', 'Artistas'),
                                                        $this->rubroOpcion('freelancer', '🧑‍🎓', 'Freelancer'),
                                                        $this->rubroOpcion('veterinaria', '🐶', 'Veterinaria'),
                                                        $this->rubroOpcion('gimnasio', '🏋️', 'Gimnasio')
                                                    ]
                                                )
                                            ]
                                        ),
                                        // Etapa 3: Temas por Rubro
                                        new Div(
                                            ['class' => 'constructor_etapa etapa_preset'],
                                            [
                                                new H2([], ['Fase 3: Temas']),
                                                new Label(['for' => 'preset', 'class' => 'label'], ['Elige Temas de expertos para tu rubro']),
                                                new Div(
                                                    ['id' => 'presets_opciones'],
                                                    []
                                                )
                                            ]
                                        ),

                                        // Etapa 4: Edición de secciones
                                        new Div(
                                            ['class' => 'constructor_etapa etapa_secciones'],
                                            [
                                                new H2([], ['Fase 4: Secciones']),
                                                new Label(['for' => 'secciones', 'class' => 'label'], ['Últimos ajustes para tu Appsite']),
                                                new Div(
                                                    ['class' => 'sections_config'],
                                                    [
                                                        // --- SECCIÓN HERO ---
                                                        new Div(
                                                            ['class' => 'section section_hero'],
                                                            [
                                                                new H3([], ['Hero']),
                                                                new Div(
                                                                    ['class' => 'section_contenido'],
                                                                    [
                                                                    ]
                                                                )
                                                            ]
                                                        ),

                                                        new Div(
                                                            ['class' => 'section_sortable', 'id' => 'section_sortable'],
                                                            [
                                                                // --- SECCIÓN CATÁLOGO ---
                                                                new Div(
                                                                    ['class' => 'section section_catalogo'],
                                                                    [
                                                                        new H3([], ['Catálogo']),
                                                                        new Div(
                                                                            ['class' => 'section_contenido'],
                                                                            [
                                                                            ]
                                                                        )
                                                                    ]
                                                                ),

                                                                // --- SECCIÓN TURNOS Y RESERVAS ---
                                                                new Div(
                                                                    ['class' => 'section section_turnos'],
                                                                    [
                                                                        new H3([], ['Turnos y Reservas']),
                                                                        new Div(
                                                                            ['class' => 'section_contenido'],
                                                                            [
                                                                                
                                                                            ]
                                                                        )
                                                                    ]
                                                                ),

                                                                // --- SECCIÓN EVENTOS ---
                                                                new Div(
                                                                    ['class' => 'section section_eventos'],
                                                                    [
                                                                        new H3([], ['Eventos']),
                                                                        new Div(
                                                                            ['class' => 'section_contenido'],
                                                                            [
                                                                                
                                                                            ]
                                                                        )
                                                                    ]
                                                                ),

                                                                // --- SECCIÓN ENLACES ---
                                                                new Div(
                                                                    ['class' => 'section section_enlaces'],
                                                                    [
                                                                        new H3([], ['Enlaces']),
                                                                        new Div(
                                                                            ['class' => 'section_contenido'],
                                                                            [
                                                                                
                                                                            ]
                                                                        )
                                                                    ]
                                                                ),

                                                                // --- SECCIÓN GALERÍA ---
                                                                new Div(
                                                                    ['class' => 'section section_galeria'],
                                                                    [
                                                                        new H3([], ['Galería']),
                                                                        new Div(
                                                                            ['class' => 'section_contenido'],
                                                                            [
                                                                            ]
                                                                        )
                                                                    ]
                                                                )
                                                            ]
                                                        )
                                                    ]
                                                )
                                            ]
                                        ),

                                        // Etapa 5: Registro
                                        new Div(
                                            ['class' => 'constructor_etapa'],
                                            []
                                        ),
                                    ]
                                )
                            ]
                        ),
                        new Div(
                            ['class' => 'form_buttons'],
                            [
                                new Button(['class' => 'prev'], ['Anterior']),
                                new Button(['class' => 'sig'], ['Siguiente'])
                            ]
                        )
                    ]
                ),
                new Div(
                    ['class' => 'constructor_area constructor_preview'],
                    [
                        new Div(
                            ['class' => 'preview'],
                            [
                                new P(
                                    ['class' => 'preview_slug'],
                                    [
                                        'https://tuapp.site/',
                                        new Span(['id' => 'preview_slug-span'])
                                    ]
                                )
                            ]
                        )
                    ]
                )
            ]
        );
        $this->registerAssetsCSS();
        $this->registerAssetsJS();
    }
    private function rubroOpcion(string $value, string $icono, string $texto): ConstructorOpcRubro
    {
        return new ConstructorOpcRubro($value, $icono, $texto);
    }
}
