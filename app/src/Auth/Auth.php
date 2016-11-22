<?php

namespace App\Auth;

use App\Models\User;

class Auth
{

    /**
     * Return the user object.
     * @return object
     */
    public function user()
    {
        if ($this->check() == true) {

            return User::find($_SESSION['user']);
        }
    }

    /**
     * Check if the user is logged in.
     * @return boolean
     */
    public function check()
    {
        return isset($_SESSION['user']);
    }

    /**
     * Attempt to log the user in.
     * @param  string $email
     * @param  string $password
     * @return mixed
     */
    public function attempt($email, $password)
    {
        
        $user = User::where('email', '=', $email)->first();

        if (!is_object($user) || password_verify($password, $user->password) == false) {
            return false;
        } else {
            $_SESSION['user'] = $user->id;
            return true;
        }

        return false;
    }

    /**
     * Unset the current user session
     * @return void
     */
    public function logout()
    {
        unset($_SESSION['user']);
    }
}