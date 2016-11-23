<?php

namespace App\Middleware\Auth;

use App\MainContainer;

class AuthMiddleware extends MainContainer
{

    public function __invoke($request, $response, $next)
    {

        if (!$this->auth->check()) {
            $this->flash->AddMessage('error', 'You need to sign in before you can do this.');
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        $response = $next($request, $response);
        return $response;
    }

}