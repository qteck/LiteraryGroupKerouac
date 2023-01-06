<?php

namespace App\Http\Controllers\Manifest;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Manifest;

class ManifestController extends Controller
{
    function index() {

    	$manifests = Manifest::all();

    	return view('manifest.manifest', compact('manifests'));
    }
}
