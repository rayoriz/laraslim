<?php
namespace App\Controllers\Auth;

use App\Models\User;
use Slim\Views\Twig as View;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class PasswordController extends Controller
{

    /**
     * Get the change password page
     *
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function getChangePassword($req, $res, $args)
    {
        $this->logger->info("Display the change password page for : {$this->auth->user()->email} ");
        
        $this->view->render($res, 'auth/password/change-password.twig');
        return $res;
    }

    /**
     * Post the password change
     *
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function postChangePassword($req, $res, $args)
    {
        $this->logger->info("Try to change the password");
        $validation = $this->validator->validate($req, [
            'current_password' => V::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'password' => V::noWhitespace()->notEmpty()
        ]);

        if ($validation->failed()) {
            $this->flash->addMessage('error', 'Wachtwoord wijziging is niet gelukt.');
            return $res->withRedirect($this->router->pathFor('auth.password.change'));
        }

        $this->auth->user()->setPassword($req->getParam('password'));
        $this->flash->addMessage('info', 'Uw wachtwoord is gewijzigd.');
        return $res->withRedirect($this->router->pathFor('home'));

    }

    /**
     * Show the forgot password page for the user
     *
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function getForgotPassword($req, $res, $args)
    {
    
        $this->logger->info("Display the forgot password page");
        
        $this->view->render($res, 'auth/forgot-password.twig');
        return $res;
    }

    /**
     * Run the forgot password function
     *
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function postForgotPassword($req, $res, $args)
    {
        $this->logger->info("Reset the password for the user with email: {$req->getParam('email')}");
        
        // Run the forgot password script.
    }

    /**
     * Show the set new password page for the user.
     *
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function getResetPassword($req, $res, $args)
    {
        $this->logger->info("Show the reset password page");
        
        $this->view->render($res, 'auth/reset-password.twig');
        return $res;
    }

    /**
     * Run the reset password script
     *
     * @param  Request  $req  request object
     * @param  Response $res  response object
     * @param  array   $args  arguments array
     * @return mixed          return the current page.
     */
    public function postResetPassword($req, $res, $args)
    {
        $this->logger->info("The user with email: {$req->getParam('email')} has resetted his password");
        
        // Run the reset password code.
    }
}
