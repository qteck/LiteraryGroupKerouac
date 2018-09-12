<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Support\Facades\Auth;

use App\Orders;


class OrdersController extends Controller
{
    function index (Orders $orders)
    {
        $orders = $orders->orderBy('created_at','DESC')->get();

        return view('admin.orders.orders', compact('orders'));
    }

}
