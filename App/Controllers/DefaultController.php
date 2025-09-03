<?php
namespace App\Controllers;

use App\Views\Views\nothing\NothingView;
use Flame\BaseController\BaseController;
use Flame\Crud\Crud;
use Exception;

class DefaultController extends BaseController
{
    public function index(): void
    {
        if ($this->pdo == null) {
            throw new Exception("Se requiere activar la conexion a la base de datos", 1);
        }
        $slug = $_GET['url'] ?? 'nothing';
        $crud = new Crud($this->pdo);
        $consulta = $crud->read('usuarios',['slug'=>$slug],null, null,1);
        if(!$consulta['status'])
        {
            throw new Exception("Error al obtener Datos del slug: " . $consulta['message'], 1);
        }
        if(!$consulta['data'])
        {
            $this->render(NothingView::class);
        }
        else
        {
            $json = $consulta['json'];
            if(!$json)
            {
                throw new Exception("Error al cargar el Json: Comunicarse con Soporte", 1);
            }
            $json_decodificado = json_decode($json, true);
        }
    }
}