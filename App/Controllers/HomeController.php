<?php
namespace App\Controllers;
use Flame\BaseController\BaseController;
use App\Views\View\HomeView;
class HomeController extends BaseController
{
    
    public function index(): void
    {
        // Pasás el nombre de clase como string
        $this->render(HomeView::class);
    }
}