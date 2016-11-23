<?php

namespace App\Middleware\Validation;

use App\MainContainer;

class OldInputMiddleware extends MainContainer
{

    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION['old'])) {
            $this->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
        }
        $_SESSION['old'] = $request->getParams();

        $response = $next($request, $response);
        return $response;
    }

}