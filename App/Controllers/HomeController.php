<?php

namespace App\Controllers;

use Flame\Auth\Session;
use Flame\BaseController\BaseController;
use Flame\Crud\Crud;
use Exception;
use App\Views\views\Home\HomeView;

class HomeController extends BaseController
{
    public function index(): void
    {
        if ($this->pdo == null) {
            throw new Exception("Se requiere activar la conexion a la base de datos", 1);
        }
        $session = new Session($this->pdo);
        $crud = new Crud($this->pdo);
        //Obtenemos informacion de la base de datos
        $consulta = $crud->read('contact_data', null, null, null, 1);
        if (!$consulta['status']) {
            throw new Exception("Error al obtener Datos: " . $consulta['message'], 1);
        }
        $response =
        [
            'auth' => false,
            'data' => $consulta['data'][0]
        ];
        if ($session->isAuthenticated() && $session->existsInDb(['id' => $session->getUserForKeys(['id'])['id']])) 
        {
            //Está autenticado
            $auth = true;
            $response =
            [
                'auth' => $auth,
                'data' => $consulta['data'][0]
            ];
        }
        $this->render(HomeView::class, $response);
    }
}
