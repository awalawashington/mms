<?php

namespace App\Http\Controllers\Auth;

use App\Models\Pages;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password. 
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        $ip_address = $request->ip();
        $page = Pages::where('name', 'Reset Password')->first();
        $page_id = $page->id;
        Visitor::create([
            'page_id' => $page_id,
            'ip_address' => $ip_address
        ]);
        return view('auth.reset_password');
    }
}
