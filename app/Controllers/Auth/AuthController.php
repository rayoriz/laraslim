<?php
namespace App\Controllers\Auth;

use App\Models\User;
use App\MainContainer;
use Respect\Validation\Validator as v;

class AuthController extends MainContainer
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

        $auth = $this->auth->attempt(
            $req->getParam('email'),
            $req->getParam('password')
        );

        if (!$auth) {
            $this->flash->addMessage('error', 'Logging in failed : email and or password did not match up');
            return $res->withRedirect($this->router->pathFor('auth.signin'));
        }
        $this->flash->addMessage('success', 'Logging in succesful');
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

        $validation = $this->validator->validate($req, [
            'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'username' => v::notEmpty()->alpha(),
            'firstname' => v::notEmpty()->alpha(),
            'lastname' => v::notEmpty()->alpha(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()) {
            $this->flash->addMessage('error', 'Registration failed');
            return $res->withRedirect($this->router->pathFor('auth.signup'));
        }
        
        User::create([
            'username' => $req->getParam('username'),
            'firstname' => $req->getParam('firstname'),
            'lastname' => $req->getParam('lastname'),
            'email' => $req->getParam('email'),
            'password' => password_hash($req->getParam('password'), PASSWORD_DEFAULT)
        ]);

        $this->flash->addMessage('success', 'Your account has been made and you have been logged in');
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
        $this->flash->addMessage('success', 'Logged out succesfully');
        $this->auth->logout();
        return $res->withRedirect($this->router->pathFor('home'));
    }
}
