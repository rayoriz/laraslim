<?php
namespace App\Controllers;

use App\MainContainer;

class HomeController extends MainContainer
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
        $this->view->render($res, 'home.twig');
        return $res;
    }
}
