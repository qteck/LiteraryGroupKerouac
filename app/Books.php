<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
	protected $fillable = ['title', 'description', 'author','price','coverUrl','author_id'];
	  //protected $dateFormat = 'U';
    
}
