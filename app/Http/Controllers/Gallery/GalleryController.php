<?php

namespace App\Http\Controllers\Gallery;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Gallery;

class GalleryController extends Controller
{
    function index () {
        $galleries = Gallery::all();
        

        return view('galerie.galerie', compact('galleries'));
    }
    
    function show ($id) {
        $photos = Gallery::where('id', $id)->get()->first();
        //dd($photos);
        return view('galerie.galerie-show', compact('photos'));
    }
}
