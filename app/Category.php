<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $table = 'categories';
	protected $fillable = ['name','user_id'];      //Atributos asignados en masa
    public $timestamps = false;     //Con esto quitamos el error de SQL

    public function password()
    {
    	return $this->hasMany('\App\Password');
    }

    public function user()
    {
    	return $this->belongsTo('\App\User');
    }
}