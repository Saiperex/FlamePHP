<?php

namespace App\Actions;

use Flame\BaseAction\BaseAction;
use Flame\Response\ActionResponse;
use App\Views\Components\Cuadradito;

class ApareceCuadradito extends BaseAction
{
    public function handle(): ActionResponse
    {
        $cuadradito = new Cuadradito();
        return new ActionResponse(
            success: true,
            target: '#div-reactivo',
            html: $cuadradito->render()
        );
    }
}
