<?php

namespace App\Http\Controllers\LiterarniTour;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tours;
use Carbon\Carbon;

class LiterarniTourController extends Controller
{
 	function index () {
 		$tours = Tours::orderBy('date_of_event','DESC')->get();

 		return view('literarni-tour.literarni-tour', compact('tours'));
 	}

 	function show($id) {
 		$tour = Tours::all()->where('id', $id)->first();
 		$tour->date_of_event = Carbon::parse($tour->date_of_event)->format('d.m.Y H:i');

 		return view('literarni-tour.literarni-tour-show', compact('tour'));

 	}
 }
