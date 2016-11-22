<?php

namespace App\Middleware\Auth;

use App\Middleware\Middleware;

class GuestMiddleware extends Middleware
{

    public function __invoke($request, $response, $next)
    {

        if ($this->auth->check()) {
            $this->flash->AddMessage('error', 'U bent al ingelogd.');
            return $response->withRedirect($this->router->pathFor('home'));
        }

        $response = $next($request, $response);
        return $response;
    }

}