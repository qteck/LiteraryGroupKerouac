<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
	protected $fillable = ['forename','surname','phone','email','orderedItem_id','price','totalPrice','transaction_id','quantity','currency','address','status'];
}
