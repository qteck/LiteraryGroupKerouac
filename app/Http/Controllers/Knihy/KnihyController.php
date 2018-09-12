<?php

namespace App\Http\Controllers\Knihy;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Orders;
use App\Books;

class KnihyController extends Controller
{
    function index(Books $books) {
        $books = $books->all();

    	return view('knihy.knihy', compact('books'));
    }

    function paypalPayment(Request $request) {
    	//dd($request);

    	$orders = new Orders($request->all());
    	$orders->save();
    	return json_encode(array('state' => 1));
        exit;
    }
}
