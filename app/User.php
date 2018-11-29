<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password','role_id'];      //Asignación masiva, si te deja añadir el campo a la tabla de la BD.
    public $timestamps = false;
    //desde las rutas la variable $user es la misma que $fillable?
    //protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo('\App\Role');
    }

    public function categories()
    {
        return $this->hasMany('\App\Category');
    }

    public function password()
    {
        return $this->hasMany('\App\Password');
    }
}
