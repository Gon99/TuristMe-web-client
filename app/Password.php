<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{

	protected $table = 'passwords';

    public function comments()
    {
    	return $this->hasMany('')
    }
}