<?php

namespace App\Middleware\Auth;

use App\MainContainer;

class GuestMiddleware extends MainContainer
{

    public function __invoke($request, $response, $next)
    {

        if ($this->auth->check()) {
            $this->flash->AddMessage('error', 'You are already logged in.');
            return $response->withRedirect($this->router->pathFor('home'));
        }

        $response = $next($request, $response);
        return $response;
    }

}