<?php
namespace App\Controllers\Auth;

use App\Models\User;
use Slim\Views\Twig as View;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{

    /**
     * Show the login page for the user.
     *
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function getSignIn($req, $res)
    {
    
        // $this->logger->info("Display the login page");
        
        $this->view->render($res, 'auth/login.twig');

        return $res;
    }

    /**
     * Get the post details from the sign in page.
     *
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function postSignIn($req, $res, $args)
    {
        // $this->logger->info("Sign the user in with email : {$req->getParam('email')}");

        $auth = $this->auth->attempt(
            $req->getParam('email'),
            $req->getParam('password')
        );

        if (!$auth) {
            $this->flash->addMessage('error', 'Inloggen mislukt, Email en wachtwoord komen niet overeen');
            return $res->withRedirect($this->router->pathFor('auth.signin'));
        }
        $this->flash->addMessage('success', 'Inloggen voltooid !');
        return $res->withRedirect($this->router->pathFor('home'));
    }

    /**
     * Show the sign up page for the user.
     *
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function getSignUp($req, $res)
    {
    
        $this->logger->info("Display the sign up page");
        
        $this->view->render($res, 'auth/signup.twig');
        return $res;
    }


    /**
     * Get the post details from the sign up page.
     *
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function postSignUp($req, $res, $args)
    {
        $this->logger->info("Create a new user with email: {$req->getParam('email')}");

        $validation = $this->validator->validate($req, [
            'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'username' => v::notEmpty()->alpha(),
            'firstname' => v::notEmpty()->alpha(),
            'lastname' => v::notEmpty()->alpha(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()) {
            $this->flash->addMessage('error', 'Registratie is mislukt');
            return $res->withRedirect($this->router->pathFor('auth.signup'));
        }
        
        User::create([
            'username' => $req->getParam('username'),
            'firstname' => $req->getParam('firstname'),
            'lastname' => $req->getParam('lastname'),
            'email' => $req->getParam('email'),
            'password' => password_hash($req->getParam('password'), PASSWORD_DEFAULT)
        ]);

        $this->flash->addMessage('success', 'Uw account is aangemaakt en U bent ingelogd');
        $this->auth->attempt($user->email, $req->getParam('password'));
        return $res->withRedirect($this->router->pathFor('home'));
    }

    /**
     * Sign the user out
     *
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function getsignOut($req, $res, $args)
    {
        $this->logger->info("Signing user out with email : {$this->auth->user()->email}");
        $this->flash->addMessage('success', 'U bent nu uitgelogd');
        $this->auth->logout();
        return $res->withRedirect($this->router->pathFor('home'));
    }
}
