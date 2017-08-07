<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use DB; not needed with the lower line
use App\Article;

class HomeController extends Controller
{
    function index() {
    	$articles = Article::all();

    	return view('home.home', compact('articles'));
    }
}
