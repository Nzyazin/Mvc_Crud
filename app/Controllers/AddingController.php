<?php 

namespace App\Controllers;

use App\Models\Product;
use Symfony\Component\Routing\RouteCollection;

class AddingController
{
    public function adding(RouteCollection $routes)
    {
        $product = new Product();

        require_once APP_ROOT . '/views/adding.php';
    }
}