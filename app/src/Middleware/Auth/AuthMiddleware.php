<?php

namespace App\Middleware\Auth;

use App\Middleware\Middleware;

class AuthMiddleware extends Middleware
{

    public function __invoke($request, $response, $next)
    {

        if (!$this->auth->check()) {
            $this->flash->AddMessage('error', 'U kunt dit niet doen omdat U eerst moet inloggen.');
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        $response = $next($request, $response);
        return $response;
    }

}