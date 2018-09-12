<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
	protected $fillable = ['forename','surname','phone','email','orderedItem_id','price','quantity','currency','address','status'];
}
