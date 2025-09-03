<?php
namespace App\Controllers;

use Flame\BaseController\BaseController;
use App\Views\Views\Constructor\ConstructorView;
use Exception;
use Flame\Crud\Crud;

class CrearController extends BaseController
{
    public function index(): void
    {
        if(!$this->pdo)
        {
            throw new Exception("Conexión requerida", 1);
        }
        $crud = new Crud($this->pdo);
        //Obtener los nombre de los template hero
        
       
        $this->render(ConstructorView::class);
    }
}