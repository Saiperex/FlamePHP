<?php

declare(strict_types=1);

namespace Flame\Html;

use Flame\Interfaces\RenderableInterface;
use ReflectionClass;
use Exception;

/**
 * Clase AbstractTag
 *
 * Clase base abstracta para todos los elementos HTML componibles.
 * Implementa RenderableInterface, permitiendo representar visualmente
 * cualquier etiqueta HTML con atributos, hijos y manejo de assets.
 *
 * Soporta etiquetas void (autocerradas) como <br>, <img>, etc.
 * Gestiona también el registro de archivos CSS y JS únicos por componente.
 *
 * @package Flame\Html
 */
abstract class AbstractTag implements RenderableInterface
{
    /**
     * Nombre de la etiqueta HTML (por ejemplo, div, span, etc.)
     *
     * @var string
     */
    protected string $tag;

    /**
     * Atributos HTML del elemento (como id, class, style, etc.)
     *
     * @var array
     */
    protected array $attributes = [];

    /**
     * Hijos del elemento. Pueden ser strings o instancias de RenderableInterface.
     *
     * @var array
     */
    protected array $children = [];

    /**
     * Lista de etiquetas HTML que no deben tener cierre (void tags).
     *
     * @var array
     */
    protected static array $voidElements = [
        'area',
        'base',
        'br',
        'col',
        'embed',
        'hr',
        'img',
        'input',
        'link',
        'meta',
        'source',
        'track',
        'wbr'
    ];

    /**
     * Constructor del componente HTML.
     *
     * @param string $tag Nombre de la etiqueta
     * @param array $attributes Atributos del elemento
     * @param array $children Hijos del elemento
     */
    public function __construct(string $tag, array $attributes = [], array $children = [])
    {
        $this->tag = $tag;
        $this->attributes = $attributes;
        $this->children = $children;
    }

    /**
     * Registra los archivos CSS y JS asociados al componente, si existen.
     * Basado en el nombre de la clase. Los paths se configuran vía .env.
     *
     * @throws Exception Si los archivos no se encuentran en el sistema
     */
    protected function registerAssetsCSS(): void
    {
        $className = (new ReflectionClass($this))->getShortName();
        $assetsUrl = rtrim($_ENV['ASSETS_URL'] ?? 'assets/components', '/');
        $cssFile = $className . '.css';
        $publicFolder=$_ENV['PUBLIC_FOLDER'] ?? 'public';
        $publicCssPath = '/' . $assetsUrl . '/' . $cssFile;
        $localCssPath = dirname(__DIR__, 2) . '/'.$publicFolder.'/' . $assetsUrl . '/' . $cssFile;

        if (file_exists($localCssPath)) {
            AssetManager::registerStyle($publicCssPath);
        } else {
            throw new Exception("❌ CSS no encontrado: $localCssPath");
        }
    }

    protected function registerAssetsJS(): void
    {
        $className = (new ReflectionClass($this))->getShortName();
        $assetsUrl = rtrim($_ENV['ASSETS_URL'] ?? 'assets/components', '/');
        $jsFile = $className . '.js';
        $publicFolder=$_ENV['PUBLIC_FOLDER'] ?? 'public';
        $publicJsPath = '/' . $assetsUrl . '/' . $jsFile;
        $localJsPath = dirname(__DIR__, 2) . '/'.$publicFolder.'/' . $assetsUrl . '/' . $jsFile;

        if (file_exists($localJsPath)) {
            AssetManager::registerScript($publicJsPath);
        } else {
            throw new Exception("❌ JS no encontrado: $localJsPath");
        }
    }

    /**
     * Agrega un hijo al componente.
     *
     * @param RenderableInterface|string $child Elemento hijo
     */
    public function addChild(RenderableInterface|string $child): void
    {
        $this->children[] = $child;
    }

    /**
     * Renderiza el componente HTML, incluyendo hijos y atributos.
     *
     * @return string HTML generado
     */
    public function render(): string
    {
        $html = "<{$this->tag}" . $this->renderAttributes();

        if (in_array($this->tag, self::$voidElements, true)) {
            return $html . ' />';
        }

        $html .= '>';

        foreach ($this->children as $child) {
            $html .= $child instanceof RenderableInterface ? $child->render() : $child;
        }

        $html .= "</{$this->tag}>";

        return $html;
    }

    /**
     * Renderiza los atributos HTML del componente.
     *
     * @return string Atributos renderizados
     */
    protected function renderAttributes(): string
    {
        $html = '';

        foreach ($this->attributes as $key => $value) {
            if (is_bool($value)) {
                if ($value) {
                    $html .= ' ' . htmlspecialchars($key, ENT_QUOTES);
                }
            } else {
                $html .= sprintf(' %s="%s"', htmlspecialchars($key, ENT_QUOTES), htmlspecialchars((string)$value, ENT_QUOTES));
            }
        }

        return $html;
    }
}
// End of file: Flame/Html/AbstractTag.php
// Location: Flame/Html/AbstractTag.php