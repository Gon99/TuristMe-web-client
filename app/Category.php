<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $table = 'categories';
	protected $fillable = ['name', 'password','user_id'];
    //public $timestamps = false; Con esto quitamos el error de SQL

    public function password()
    {
    	return $this->hasMany('\App\Password');
    }

    public function user()
    {
    	return $this->belongsTo('\App\User');
    }
}