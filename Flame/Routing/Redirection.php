<?php

namespace Flame\Routing;

class Redirection
{
    /**
     * Se supone que si se llega a esta clase es porque el middleware ha fallado.
     * 
     * Maneja la redirección según la ruta solicitada.
     *
     * @param string $routeKey La clave de la ruta que se está intentando acceder.
     * @param array $redirecciones Un array de redirecciones posibles.
     * @return void 
     */
    public function handle(string $routeKey, array $redirecciones): void
    {
        // Verificar si la clave existe en el array de redirecciones
        if (array_key_exists($routeKey, $redirecciones)) {
            $redirectTo = $redirecciones[$routeKey];
        } 
        // Si no existe, intentar usar la redirección por defecto
        elseif (array_key_exists('default', $redirecciones)) {
            $redirectTo = $redirecciones['default'];
        } 
        // Si ni siquiera hay default, lanzar excepción o redirigir a "home" fijo
        else {
            $redirectTo = 'home';
        }

        // Redirigir
        header("Location: ?page=$redirectTo");
        exit;
    }
}
// End of file: Flame/Routing/Redirection.php
// Location: Flame/Routing/Redirection.php
