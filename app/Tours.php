<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    protected $fillable = ['title', 'place', 'price', 'map_url', 'date_of_event', 'status', 'created_at', 'updated_at'];
}