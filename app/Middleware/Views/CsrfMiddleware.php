<?php

namespace App\Middleware\Views;

use App\MainContainer;

class CsrfMiddleware extends MainContainer
{

    public function __invoke($request, $response, $next)
    {
        // Generate new token and update request
        $request = $this->csrf->generateNewToken($request);

        $this->view->getEnvironment()->addGlobal('csrf', [
            'field' => '
                <input type="hidden" name="' . $this->csrf->getTokenNameKey() . '" value="' . $this->csrf->getTokenName() . '">
                <input type="hidden" name="' . $this->csrf->getTokenValueKey() . '" value="' . $this->csrf->getTokenValue() . '">
            ',
        ]);

        $response = $next($request, $response);
        return $response;
    }

}