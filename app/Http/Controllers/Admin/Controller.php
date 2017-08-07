<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $user;

	public function __construct()
	{
		$this->middleware('auth');
	    
	    	$this->middleware(function ($request, $next) {
            			$this->user = Auth::user();
            			
            			view()->share('user', $this->user);

           	 		return $next($request);
     		});
	}

	public function logout() 
	{
		Auth::logout();
	        
	        	return redirect('admin/dealer');
	}
}
