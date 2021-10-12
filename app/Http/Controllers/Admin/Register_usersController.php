<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\VerifyAccount;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class Register_usersController extends Controller
{
    public function index()
    {
        if (! Gate::allows('is_admin')) {
            abort(403);
        }
        return view('users.admin.register');
    }

    public function register(Request $request)
    {
        if (! Gate::allows('is_admin')) {
            abort(403);
        }
        $this->validator($request->all())->validate();

        $password = Str::random(8);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
            'color' => $request->color,
            'dob' => $request->dob,
            'password' => Hash::make($password),
            'active' => TRUE,
        ]);

        $this->sendAccountVerificationLink($user->id, $password);

        return redirect(url('users'));
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:20|alpha_dash|unique:users,username',
            'phone' => 'required|min:10|numeric',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'dob' => 'required'
        ]);
    }

    protected function sendAccountVerificationLink($id, $password)
    {
        $user = User::find($id);
        $user->notify(new VerifyAccount($user, $password));
    }

}
