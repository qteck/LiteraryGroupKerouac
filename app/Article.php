<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{ 
    protected $dates = [
        'created_at',
        'updated_at',
        'scheduled'
    ];

    protected $fillable = ['title', 'content_in_brief', 'content', 'place', 'storyline', 'author_id', 'status', 'scheduled', 'created_at', 'updated_at'];

    function sources() {
    	return $this->hasMany('App\Source');
    }

    function month () {
    	return $this->belongsTo('\App\Month');
    }
}
