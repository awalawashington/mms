<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Pages;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function showLoginForm(Request $request)
    {
        $ip_address = $request->ip();
        $page = Pages::where('name', 'Login')->first();
        $page_id = $page->id;
        Visitor::create([
            'page_id' => $page_id,
            'ip_address' => $ip_address
        ]); 
        
        return view('auth.login');
    }
  
}
