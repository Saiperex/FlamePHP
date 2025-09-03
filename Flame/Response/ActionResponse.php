<?php

namespace Flame\Response;

/**
 * Class ActionResponse
 * 
 * Respuesta estándar para acciones que modifican el DOM desde backend.
 * 
 * 📌 Campo `target`
 * ----------------
 * Indica qué elementos del DOM serán afectados por la acción.
 * Se interpreta como un **selector CSS válido** y soporta:
 * 
 * | Ejemplo                       | Significado                                                         |
 * | ----------------------------- | ------------------------------------------------------------------- |
 * | `.mi-clase`                    | Todos los elementos con clase `mi-clase`                           |
 * | `#mi-id`                       | El elemento con ID `mi-id`                                         |
 * | `[data-role="admin"]`          | Elementos con el atributo `data-role` igual a `"admin"`             |
 * | `input[name="usuario"]`        | Solo inputs cuyo atributo `name` sea `"usuario"`                   |
 * | `form[data-name="login"] input[type="email"]` | Selectores combinados para mayor precisión                 |
 * 
 * 🔹 Internamente se pasa directo a `document.querySelectorAll(target)`, 
 * por lo que cualquier selector CSS válido funcionará.
 * 
 * 📌 Tipos de acción (`htmlActionType` y `actions`)
 * ------------------------------------------------
 * 
 * | Tipo              | Uso del campo `html`                    | Campos adicionales                     | Comentarios                                                    |
 * | ----------------- | -------------------------------------- | ------------------------------------ | -------------------------------------------------------------- |
 * | `replaceHtml`     | Usa el campo `html` de ActionResponse  | Ninguno                              | Reemplaza el contenido completo del target                     |
 * | `addHtml`         | Usa el campo `html` de ActionResponse  | Ninguno                              | Agrega contenido HTML al final del contenido actual del target |
 * | `addClass`        | No                                    | `className` (string)                 | Añade clase CSS al target                                      |
 * | `removeClass`     | No                                    | `className` (string)                 | Quita clase CSS del target                                     |
 * | `setAttribute`    | No                                    | `attribute` (string), `value` (string) | Añade o actualiza atributo en target                           |
 * | `removeAttribute` | No                                    | `attribute` (string)                 | Elimina atributo del target                                    |
 * 📌 Ejemplos de uso
 * -----------------
 * 1. Reemplazar contenido de un contenedor por ID:
 * 
 *  new ActionResponse(
 *      success: true,
 *      target: '#contenedor',
 *      html: '<p>Nuevo contenido</p>',
 *      htmlActionType: 'replaceHtml'
 *  );
 * 
 * 2. Agregar un elemento a todos los div con clase `.card`:
 * 
 *  new ActionResponse(
 *      success: true,
 *      target: '.card',
 *      html: '<span>Etiqueta</span>',
 *      htmlActionType: 'addHtml'
 *  );
 * 
 * 3. Cambiar atributo `disabled` en un botón específico:
 * 
 *  new ActionResponse(
 *      success: true,
 *      target: 'button[name="enviar"]',
 *      actions: [
 *          ['type' => 'setAttribute', 'attribute' => 'disabled', 'value' => 'true']
 *      ]
 *  );
 * 
 * 4. Añadir una clase a un formulario por data-atributo:
 * 
 *  new ActionResponse(
 *      success: true,
 *      target: 'form[data-name="login"]',
 *      actions: [
 *          ['type' => 'addClass', 'className' => 'is-loading']
 *      ]
 *  );
 */
class ActionResponse
{
    public function __construct(
        public bool $success,
        public string $target,
        public ?string $html = null,
        public ?string $htmlActionType = 'replaceHtml', // 'replaceHtml', 'addHtml', or null
        public ?string $redirect = null,
        public ?array $actions = null
    ) {}

    public function toJson(): string
    {
        return json_encode([
            'success' => $this->success,
            'target' => $this->target,
            'html' => $this->html,
            'htmlActionType' => $this->htmlActionType,
            'redirect' => $this->redirect,
            'actions' => $this->actions,
        ], JSON_UNESCAPED_UNICODE);
    }
}
