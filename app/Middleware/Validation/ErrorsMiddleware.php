<?php

namespace App\Middleware\Validation;

use App\MainContainer;

class ErrorsMiddleware extends MainContainer
{

    public function __invoke($request, $response, $next)
    {

        if (isset($_SESSION['errors'])) {
            $this->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
        }
        unset($_SESSION['errors']);

        $response = $next($request, $response);
        return $response;
    }

}