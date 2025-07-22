<?php

declare(strict_types=1);
//Namespaces a usar. Por defecto Flame usa los namespaces `Flame\*` y `App\*`.
use Flame\Run\Flame;
// Autoload de clases para Flame + App.
require_once __DIR__ . '/../Flame/Core/Autoload.php';

Flame::setTimezone('America/Argentina/Buenos_Aires');
Flame::exceptionsNoAtrapadas();
Flame::exceptionsNoFatales();
Flame::run();