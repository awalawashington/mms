<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Pages;
use App\Models\Visitor;
use Khsing\World\World;
use App\Models\CodeUser;
use App\Models\Code_User;
use Illuminate\Http\Request;
use Rinvex\Country\CountryLoader;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
 
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $countries = World::Countries();
        $ip_address = $request->ip();
        $page = Pages::where('name', 'Register')->first();
        $page_id = $page->id;
        Visitor::create([
            'page_id' => $page_id,
            'ip_address' => $ip_address
        ]); 
        
        return view('auth.register', ['countries' => $countries]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'code' => 'required',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:20|alpha_dash|unique:users,username',
            'phone' => 'required|min:10|numeric',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'dob' => 'required',
            'password' => ['required', 'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ]
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

          

            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'color' => $data['color'],
                'dob' => $data['dob'],
                'password' => Hash::make($data['password']),
            ]);

            CodeUser::create([
                'user_id' => $user->id,
                'country_id' => $data['code'],
            ]);

            return $user;
    }
}
