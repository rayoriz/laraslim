<?php
namespace App\Controllers\Auth;

use App\Models\User;
use App\MainContainer;
use Respect\Validation\Validator as v;

class PasswordController extends MainContainer
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
            $this->flash->addMessage('error', 'Chaning password failed');
            return $res->withRedirect($this->router->pathFor('auth.password.change'));
        }

        $this->auth->user()->setPassword($req->getParam('password'));
        $this->flash->addMessage('info', 'Your password has been changed.');
        return $res->withRedirect($this->router->pathFor('home'));

    }
}
