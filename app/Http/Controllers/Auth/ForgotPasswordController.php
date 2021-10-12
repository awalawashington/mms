<?php

namespace App\Http\Controllers\Auth;

use App\Models\Pages;
use App\Models\Visitor;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails; 
    public function showLinkRequestForm()  
    {
        $ip_address = $request->ip();
        $page = Pages::where('name', 'Forgot Password')->first();
        $page_id = $page->id;
        Visitor::create([
            'page_id' => $page_id,
            'ip_address' => $ip_address
        ]); 
        return view('auth.forgot_password');
    }
    
}
