# FlamePHP 🔥

**FlamePHP** es un microframework PHP diseñado para construir aplicaciones modernas, ligeras y progresivas sin dependencias externas.
Su enfoque es **minimalista pero estructurado**, incorporando un sistema MVC propio, reactividad con `FlameReactive.js` y manejo sencillo de acciones AJAX a través de `Reactions.php`.

---

## 🚀 Características principales

* **MVC nativo**: separación de modelos, vistas y controladores dentro de `flame/`.
* **FlameReactive.js**: capa de reactividad declarativa basada en atributos (`data-name`, `data-type`, `data-event`).
* **Reactions.php**: backend centralizado para manejar eventos AJAX.
* **Entry point único** (`public_html/index.php`) para enrutar toda la aplicación.
* **Ligero y sin dependencias externas**.

---

## 📂 Estructura de carpetas

```
/
├── flame/                  # Núcleo del framework
│   ├── Auth/               # Clases para manejo de autenticación y tokenización (SESSION o JWT)
│   ├── BaseAction/         # Clase abstracta para modelar acciones y sus respuestas
│   ├── BaseAuth/           # Clase abstracta base de autenticación
│   ├── BaseController/     # Clase abstracta para controladores y sus respuestas
│   ├── BaseMiddleware/     # Clase abstracta para middlewares
│   ├── Config/             # Configuración (ej: CookieConfig para Auth)
│   ├── Core/               # Núcleo del framework
│   ├── Crud/               # Helpers para CRUD rápido
│   ├── Html/               # Vistas y manejo dinámico de assets
│   ├── Interfaces/         # Interfaces para renderizado
│   ├── Playground/         # (Experimental) Creación de elementos personalizados con assets
│   ├── Response/           # Respuestas de actions y middlewares
│   ├── Routing/            # Enrutadores para vistas y acciones reactivas
│   └── Run/                # Clase principal que inicializa Flame
│
├── public_html/            # Carpeta pública (entrypoint del servidor)
│   ├── index.php           # Punto de entrada principal
│   ├── Reactions.php       # Procesa peticiones de FlameReactive
│   ├── assets/
│   │   └── core/
│   │       └── flamereactive.js  # Motor de reactividad en el cliente
│   └── ...                 # CSS, imágenes, otros JS
│
├── .env                    # Configuración de entorno (DB, rutas, debug, etc.)
└── ...
```

---

## ⚙️ Flujo de ejecución

1. Toda petición HTTP entra por `public_html/index.php`.
2. `index.php` inicializa el núcleo (`flame/Run/`).
3. `WebRouter` procesa la petición de **vista**, ejecuta middlewares (si corresponde) y luego el **controller** asociado.
4. `ActionRouter` procesa las **acciones reactivas**.
5. En el frontend, `flamereactive.js` escucha los atributos declarativos (`data-*`) y envía eventos a `Reactions.php`.
6. `Reactions.php` reenvía la acción al núcleo (`ActionRouter`), que ejecuta middlewares (si corresponde) y luego la **action** correspondiente.
7. Las actions devuelven un **Action Response**, que regresa a `Reactions.php` y luego a `FlameReactive`.
8. El DOM se actualiza automáticamente según lo que defina `FlameReactive`.

---

## 🔧 Instalación

```bash
git clone https://github.com/Saiperex/FlamePHP.git
```

1. Trabajar en la carpeta `App/`.
2. Configurar `.env` con los datos de tu App.
3. Crear los archivos de rutas de vistas y acciones según `.env` (`WEB_ROUTES_FILE` y `ACTION_ROUTES_FILE`).

### Ejemplo de configuración

**Vistas:**

```php
return [
    'nombreVista' => [
        'controller' => 'NombreController',
        'middlewares' => [
            'middleware-name' => 'nombreMiddleware',
            'middleware-result' => true  // Resultado esperado: true o false
        ],
    ]
];
```

**Acciones:**

```php
return [
    'nombreAccion' => [
        'action' => 'NombreAction',
        'middlewares' => [
            'middleware-name' => 'NombreMiddleware',
            'middleware-target' => 'data',  // Datos a procesar: data o files
            'middleware-result' => true,     // Resultado esperado: true o false
        ],
    ]
];
```

`Puedes usar todos los middlewares que quieras.`

---

## 🎨 Sistema de Vistas y Componentes

FlamePHP ofrece un sistema de construcción visual basado en objetos reutilizables que representan etiquetas HTML (Tags). Las vistas implementan `RenderableInterface` y componen objetos visuales.

### 🔹 Tags y Componentes

Todas las etiquetas HTML (`div`, `main`, `header`, etc.) están representadas como objetos en `flame/Html/Tags/`. Los componentes pueden extender de un tag y añadir lógica o estilos propios.

```php
namespace App\Views\Components\Home;

use Flame\Html\Tags\Main;

final class HomeMain extends Main
{
    public function __construct()
    {
        parent::__construct(['class' => 'principal']);
        $this->registerAssetsCSS();
        $this->registerAssetsJS();
    }
}
```

### 🔹 Vistas (RenderableInterface)

```php
namespace App\Views\Views\Home;

use App\Views\Components\Home\HomeBody;
use App\Views\Components\Home\HomeFooter;
use App\Views\Components\Home\HomeHead;
use App\Views\Components\Home\HomeHeader;
use App\Views\Components\Home\HomeMain;
use Flame\Interfaces\RenderableInterface;
use Flame\Html\AssetManager;

class HomeView implements RenderableInterface
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function render(): string
    {
        $main = new HomeMain();
        $header = new HomeHeader($this->data['auth']);
        $footer = new HomeFooter($this->data['data']);

        $body = new HomeBody();
        $body->addChild($header);
        $body->addChild($main);
        $body->addChild($footer);

        $this->RenderAssetsJS($body, AssetManager::renderScripts());

        $head = new HomeHead(AssetManager::renderStyles(), 'Evoluciona tu Bio Link en una Bio Landing');

        return (new \App\Views\Components\Home\HomeHtml())
            ->addChild($head)
            ->addChild($body)
            ->render();
    }

    private function RenderAssetsJS($object, array $assetsJs = [])
    {
        foreach ($assetsJs as $asset) {
            $object->addChild($asset);
        }
    }
}
```

### 🔹 Manejo de Assets

```php
$this->registerAssetsCSS();
$this->registerAssetsJS();

AssetManager::renderStyles();
AssetManager::renderScripts();
```

### 🔹 Reactividad en Vistas

```php
use Flame\Html\Tags\ReactiveScript;

$reactive = new ReactiveScript();
$body->addChild($reactive);
```

### 🔹 Renderizado Diferido con VoidTag

```php
use App\Component\NombreClassObjeto;
use Flame\Html\Tags\VoidTag;

$placeholder = new VoidTag(Class::NombreClaseObjeto);
```

---

## 🔥 Reactividad en FlamePHP

FlamePHP permite actualizar el DOM automáticamente desde el backend sin recargar la página.

### ⚡ Conceptos clave

**Ejecutadores:** objetos que disparan eventos y contienen:

* `data-name` → nombre de la acción.
* `data-type` → tipo de acción (render, form, conditional).
* `data-event` → evento DOM (click, submit, etc.).

**Delegados:** objetos que reciben los cambios:

* `data-name` → vincula con la acción que los modifica.

Ejemplo de ejecutador:

```html
<button data-name="login" data-type="form" data-event="submit">Entrar</button>
```

Ejemplo de delegado:

```html
<div data-name="login"></div>
```

### 🟢 FlameReactive.js

* Escucha eventos declarativos.
* Detecta ejecutadores por atributos `data-name`, `data-type` y `data-event`.
* Llama al handler según `data-type`.
* Envía información a `Reactions.php` mediante `fetch`.
* Actualiza delegados con la respuesta (ActionResponse).

### 🖥 Backend: ActionRouter

* Recibe las acciones reactivas.
* Procesa middlewares y ejecuta la acción correspondiente.
* Devuelve `ActionResponse` al frontend.

### 📝 BaseAction

```php
abstract class BaseAction
{
    protected ?PDO $pdo;
    protected array $data;
    protected array $files;

    public function __construct(?PDO $pdo = null, array $data = [], array $files = [])
    {
        $this->pdo = $pdo;
        $this->data = $data;
        $this->files = $files;
    }

    abstract public function handle(): ActionResponse;
}
```

### 📦 ActionResponse

Campos principales:

| Campo          | Tipo   | Descripción                            |                             |
| -------------- | ------ | -------------------------------------- | --------------------------- |
| success        | bool   | Indica si la acción fue exitosa        |                             |
| target         | string | Selector CSS del delegado a actualizar |                             |
| html           | string | null                                   | HTML a inyectar             |
| htmlActionType | string | null                                   | replaceHtml, addHtml o null |
| redirect       | string | null                                   | URL de redirección          |
| actions        | array  | null                                   | Acciones sobre el DOM       |

Ejemplo:

```php
new ActionResponse(
    success: true,
    target: '#contenedor',
    html: '<p>Nuevo contenido</p>', //La devolucion puede ser el render de un objeto
    htmlActionType: 'replaceHtml'
);
```

### 🔄 Flujo completo de reactividad

1. El ejecutador dispara un evento.
2. FlameReactive.js genera FormData y envía la petición a Reactions.php.
3. ActionRouter ejecuta middlewares y la acción.
4. La acción retorna un ActionResponse.
5. FlameReactive.js actualiza el delegado en el DOM.
6. Se aplican clases, atributos o redirecciones según la respuesta.

Esto asegura un sistema de reactividad declarativa completo y desacoplado, donde el backend define la lógica y el frontend solo escucha y actualiza delegados.
