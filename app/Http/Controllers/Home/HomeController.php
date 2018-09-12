<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Article;

class HomeController extends Controller
{
    function index() {
    	$current_time = Carbon::now();
        $articles = Article::where('scheduled', '<=', $current_time)
                                                ->where('status', '=', 'published')
                                                ->orderBy('scheduled', 'desc')->get();

    	return view('home.home', compact('articles'));
    }
}
