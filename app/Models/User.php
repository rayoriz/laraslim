<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use softDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'username',
        'lastname',
        'password',
        'firstname',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Set the password when a update method is called.
     * 
     * @param string $password
     */
    public static function setPassword($password)
    {
        $this->update([
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    /**
     * Return the full name of the user
     * @return string
     */
    public function getFullName()
    {
        return $this->firstname . " " . $this->lastname;
    }
}
