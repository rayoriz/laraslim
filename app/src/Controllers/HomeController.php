<?php
namespace App\Controllers;

use App\Models\Book;

use Slim\Views\Twig as View;
use App\Controllers\Controller;
use Illuminate\Database\Query\Builder;

class HomeController extends Controller
{

    /**
     * Main view for the script
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function index($req, $res, $args)
    {
        $this->logger->info("Home page action dispatched");
        $this->view->render($res, 'home.twig');
        return $res;
    }
}
