<?php

declare(strict_types=1);

use Flame\Run\Flame;

// Autoload de Flame y App
require_once __DIR__ . '/../Flame/Core/Autoload.php';
Flame::setTimezone('America/Argentina/Buenos_Aires');
// Entrada para acciones reactivas
Flame::exceptionsNoAtrapadas();
Flame::exceptionsNoFatales();
Flame::runReactive();
