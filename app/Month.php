<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
     function articles () {
    	return $this->hasMany('App\Article');
    }
}
