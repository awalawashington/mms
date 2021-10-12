<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Rinvex\Country\CountryLoader;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Photo;

class UsersController extends Controller
{
    public function index()
    {
        $users= User::all();
        $countries = CountryLoader::countries();
        $countries = collect($countries);
        return view('users.users', ['users' => $users, 'countries' => $countries, 'user' => new UserResource(auth()->user())]);
    }

    public function search(Request $request)
    {
        $countries = CountryLoader::countries();
        $countries = collect($countries);
        $users = User::all();
        $users = collect($users);

        if(!empty($request->input('search'))) {
            $search = $request->input('search');

            $users = User::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('username', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('bio', 'LIKE', "%{$search}%")
            ->get();
            $users = collect($users);
        }

        if (!empty($request->input('address'))) {
            $address = $request->input('address');

            $users = User::query()
            ->where('address', 'LIKE', "%{$address}%")
            ->get();
            $users = collect($users);
        }

        if (!empty($request->input('nationality'))) {
            $users = $users->where('nationality', $request->input('nationality'));
            $users = collect($users);
        }

        if (!empty($request->input('marital_status'))) {
            $users = $users->where('marital_status', $request->input('marital_status'));
            $users = collect($users);
        }


        if (!empty($request->input('gender'))) {
            $users = $users->where('gender', $request->input('gender'));
            $users = collect($users);
        }

        if (!empty($request->input('min_height')) && !empty($request->input('max_height'))) {
            $users = $users->whereBetween('height', [$request->input('min_height'), $request->input('max_height')]);
            $users = collect($users);
        }elseif (!empty($request->input('min_height'))) {
            $users = $users->where('height', '>=' ,$request->input('min_height'));
            $users = collect($users);
        }elseif(!empty($request->input('max_height'))) {
            $users = $users->where('height', '<=' ,$request->input('max_height'));
            $users = collect($users);
        }

        if (!empty($request->input('min_weight')) && !empty($request->input('max_weight'))) {
            $users = $users->whereBetween('weight', [$request->input('min_weight'), $request->input('max_weight')]);
            $users = collect($users);
        }elseif (!empty($request->input('min_weight'))) {
            $users = $users->where('weight', '>=' ,$request->input('min_weight'));
            $users = collect($users);
        }elseif(!empty($request->input('max_weight'))) {
            $users = $users->where('weight', '<=' ,$request->input('max_weight'));
            $users = collect($users);
        }


        if (!empty($request->input('min_age')) && !empty($request->input('max_age'))) {
            $min_age_date = Carbon::now()->subYears($request->input('min_age'));
            $max_age_date = Carbon::now()->subYears($request->input('max_age'));
            $users = $users->whereBetween('dob', [$max_age_date, $min_age_date]);
            $users = collect($users);
        }elseif (!empty($request->input('min_age'))) {
            $date = Carbon::now()->subYears($request->input('min_age'));
            $users = $users->where('dob', '<=' ,$date);
            $users = collect($users);
        }elseif(!empty($request->input('max_age'))) {
            $date = Carbon::now()->subYears($request->input('max_age'));
            $users = $users->where('dob', '>=' ,$date);
            $users = collect($users);
        }
        
        

        
        
            //use collections!!!
            return view('users.filter.filter', ['users' => $users, 'countries' => $countries]);
    }
}
