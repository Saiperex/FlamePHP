<?php

declare(strict_types=1);

namespace Flame\Html;

use Flame\Html\Tags\Link;
use Flame\Html\Tags\Script;

/**
 * Clase AssetManager
 *
 * Gestiona la inclusión de archivos CSS y JS para componentes HTML del framework.
 * Evita duplicaciones y permite renderizar los tags <link> y <script> al momento de construir la vista.
 *
 * Los estilos y scripts se resuelven en función de una base URL opcional (DOMAIN) definida en el entorno.
 *
 * @package Flame\Html
 */
class AssetManager
{
    /**
     * Lista de rutas CSS registradas (únicas).
     *
     * @var string[]
     */
    protected static array $styles = [];

    /**
     * Lista de rutas JS registradas (únicas).
     *
     * @var string[]
     */
    protected static array $scripts = [];

    /**
     * Registra una ruta de archivo CSS si no fue registrada previamente.
     *
     * @param string $path Ruta relativa del archivo CSS
     */
    public static function registerStyle(string $path): void
    {
        if (!in_array($path, self::$styles, true)) {
            self::$styles[] = $path;
            error_log("Estilo registrado: $path");
        }
    }

    /**
     * Registra una ruta de archivo JS si no fue registrada previamente.
     *
     * @param string $path Ruta relativa del archivo JS
     */
    public static function registerScript(string $path): void
    {
        if (!in_array($path, self::$scripts, true)) {
            self::$scripts[] = $path;
            error_log("Script registrado: $path");
        }
    }

    /**
     * Devuelve una lista de objetos Link (<link rel="stylesheet">) para los estilos registrados.
     *
     * @return Link[] Arreglo de objetos Link
     */
    public static function renderStyles(): array
    {
        $baseUrl = rtrim($_ENV['DOMAIN'] ?? '', '/');

        return array_map(
            fn($s) => new Link([
                'rel' => 'stylesheet',
                'href' => $baseUrl . $s
            ]),
            self::$styles
        );
    }

    /**
     * Devuelve una lista de objetos Script (<script src="...">) para los scripts registrados.
     *
     * @return Script[] Arreglo de objetos Script
     */
    public static function renderScripts(): array
    {
        $baseUrl = rtrim($_ENV['DOMAIN'] ?? '/', '/');

        return array_map(
            fn($s) => new Script([
                'src' => $baseUrl . $s
            ]),
            self::$scripts
        );
    }

    /**
     * Limpia completamente el registro de estilos y scripts cargados.
     */
    public static function reset(): void
    {
        self::$styles = [];
        self::$scripts = [];
        error_log("Assets reseteados");
    }

    //Desde aqui hay una actualizacion
    /**
     * Devuelve las rutas CSS registradas (sin envolver en objetos).
     *
     * @return string[]
     */
    public static function getStyles(): array
    {
        return self::$styles;
    }

    /**
     * Devuelve las rutas JS registradas (sin envolver en objetos).
     *
     * @return string[]
     */
    public static function getScripts(): array
    {
        return self::$scripts;
    }
}
// End of file: Flame/Html/AssetManager.php
// Location: Flame/Html/AssetManager.php
