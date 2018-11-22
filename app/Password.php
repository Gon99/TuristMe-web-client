<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{

	protected $table = 'passwords';
	protected $fillable = ['title', 'password'];

    public function users()
    {
    	return $this->belongsTo('\App\User');
    }

    public function categories()
    {
    	return $this->belongsTo('\App\Category');
    }
}