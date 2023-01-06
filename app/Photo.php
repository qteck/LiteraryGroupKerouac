<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    
    function gallery() {
        return $this->belongsTo('App\Gallery');
    }
}
