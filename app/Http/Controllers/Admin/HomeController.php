<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
     protected $redirectAfterLogout = 'xxx';

    public function index()
    {
                
        if(Auth::check()) 
        {
            $view = view('admin.home.home');
        } 
        else 
        {
            $view = view('auth.login');
        }
        
        return $view;
        
    }
}
