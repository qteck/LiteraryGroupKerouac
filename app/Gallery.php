<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galleries';
    protected $fillable = ['title', 'content_in_brief', 'place','author_id'];
    
    function photos () {
        return $this->hasMany('App\Photo', 'galleries_id');
    }
}
