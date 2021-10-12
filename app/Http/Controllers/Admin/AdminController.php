<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Pages;
use App\Models\Photo;
use App\Models\Comment;
use App\Models\Visitor;
use Khsing\World\World;
use App\Models\CodeUser;
use Illuminate\Http\Request;
use App\Rules\CheckSamePasword;
use App\Rules\MatchOldPassword;
use Khsing\World\Models\Country;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function index(Request $request)
    {
        if (auth()->user()->role != TRUE) {
            abort(403);
        }

        $ip_address = $request->ip();
        $page = Pages::where('name', 'Dashboard')->first();
        $page_id = $page->id;
        Visitor::create([
            'page_id' => $page_id,
            'ip_address' => $ip_address
        ]);

        //all users
       $all_users = User::orderByDesc('created_at')->take(5)->get();


       //compute this weeks user registration
       $start_of_week = Carbon::parse("last Sunday")->addDay();

       $users_created_this_week = User::whereDate('created_at', '<=', date($start_of_week))->get();
       $users_created_this_week = $users_created_this_week->count();
       $total_number_of_users = $all_users->count();

       $percentage_registration_increase = ($users_created_this_week/$total_number_of_users) * 100;

       $last_week = $start_of_week->subDays(7);
       
       $users_created_last_week = User::whereDate('created_at', '<=', date($last_week))
       ->whereDate('created_at', '>=', date($start_of_week))
       ->get();
       
       $users_created_last_week = $users_created_last_week->count();

       //return $users_created_last_week;

      

        return view('users.admin.dashboard', [
            'user' => auth()->user(), 
            'users' => $all_users, 
            'percentage_registration_increase' => $percentage_registration_increase,
            'photos' => Photo::all(),
            'comments' => Comment::all()
        ]);
    }
    //Datatables
    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function users(Request $request)
    {
        if (auth()->user()->role != TRUE) {
            abort(403);
        }

        $countries = World::Countries();
        $kenya = Country::getByCode('ke');
        $counties = $kenya->children();

        $ip_address = $request->ip();
        $page = Pages::where('name', 'Users')->first();
        $page_id = $page->id;
        Visitor::create([
            'page_id' => $page_id,
            'ip_address' => $ip_address,
        ]);

        //filter
        $users = User::orderByDesc('created_at')->get();
        $users = collect($users);
        
        if (!empty(request('address'))) {
            $users = $users->where('address', request('address'));
            $users = collect($users);
        }

        if (!empty(request('nationality'))) {
            $users = $users->where('nationality', request('nationality'));
            $users = collect($users);
        }

        if (!empty(request('marital_status'))) {
            $users = $users->where('marital_status', request('marital_status'));
            $users = collect($users);
        }


        if (!empty(request('gender'))) {
            $users = $users->where('gender', request('gender'));
            $users = collect($users);
        }

        if (!empty(request('min_height')) && !empty(request('max_height'))) {
            $users = $users->whereBetween('height', [request('min_height'), request('max_height')]);
            $users = collect($users);
        }elseif (!empty(request('min_height'))) {
            $users = $users->where('height', '>=' ,request('min_height'));
            $users = collect($users);
        }elseif(!empty(request('max_height'))) {
            $users = $users->where('height', '<=' ,request('max_height'));
            $users = collect($users);
        }

        if (!empty(request('min_weight')) && !empty(request('max_weight'))) {
            $users = $users->whereBetween('weight', [request('min_weight'), request('max_weight')]);
            $users = collect($users);
        }elseif (!empty(request('min_weight'))) {
            $users = $users->where('weight', '>=' ,request('min_weight'));
            $users = collect($users);
        }elseif(!empty(request('max_weight'))) {
            $users = $users->where('weight', '<=' ,request('max_weight'));
            $users = collect($users);
        }


        if (!empty(request('min_age')) && !empty(request('max_age'))) {
            $min_age_date = Carbon::now()->subYears(request('min_age'));
            $max_age_date = Carbon::now()->subYears(request('max_age'));
            $users = $users->whereBetween('dob', [$max_age_date, $min_age_date]);
            $users = collect($users);
        }elseif (!empty(request('min_age'))) {
            $date = Carbon::now()->subYears(request('min_age'));
            $users = $users->where('dob', '<=' ,$date);
            $users = collect($users);
        }elseif(!empty(request('max_age'))) {
            $date = Carbon::now()->subYears(request('max_age'));
            $users = $users->where('dob', '>=' ,$date);
            $users = collect($users);
        }

        return view('users.admin.users', ['user' => auth()->user(), 'users' => $users, 'countries' => $countries, 'counties' => $counties]);
    }

    public function visitorsReports(Request $request)
    {

        if (auth()->user()->role != TRUE) {
            abort(403);
        }
        $ip_address = $request->ip();
        $page = Pages::where('name', 'Visitors Reports')->first();
        $page_id = $page->id;
        Visitor::create([
            'page_id' => $page_id,
            'ip_address' => $ip_address
        ]);
        $users = User::orderByDesc('created_at')->get();
        return view('users.admin.visitors_reports', ['user' => auth()->user(), 'pages' => Pages::all(), 'visitors' => Visitor::all()]);
    }


    public function updateUserProfile(Request $request, $username)
    {
        if (auth()->user()->role != TRUE) {
            abort(403);
        }
        $profile = User::where('username',$username) -> first();
        $code = CodeUser::where('user_id', $profile->id)->firstOrFail();
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:20|alpha_dash',
            'phone' => 'required|min:10|numeric',
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>400, 'errors' => $validator->messages()]);
        }else {
            $profile->name = $request->name;
            $profile->phone = $request->phone;
            $profile->username = $request->username;
            $profile->email = $request->email;
            $code->country_id = $request->code;
        
            $profile->save();
            $code->save();

            return response()->json(['status'=>200, 'success'=>'Updated Successfully']);
        }

    }



    public function updateUserAbout(Request $request, $username)
    {
        if (auth()->user()->role != TRUE) {
            abort(403);
        }
        $profile = User::where('username',$username) -> first();
        //$profile->dob = $request->dob;
        $profile->color = $request->color;
        $profile->gender = $request->gender;
        $profile->address = $request->address;
        $profile->nationality = $request->nationality;
        $profile->marital_status = $request->marital_status;
        $profile->height  = $request->height;
        $profile->weight  = $request->weight;
        $profile->bio  = $request->bio;
        
        $profile->save();

        return response()->json(['status'=>200, 'success'=>'Updated Successfully']);

    }

    public function updateUserPassword(Request $request, $username)
    {
        if (auth()->user()->role != TRUE) {
            abort(403);
        }
        $profile = User::where('username',$username) -> first();

    }

    public function deleteUser( $username) {
        if (auth()->user()->role != TRUE) {
            abort(403);
        }


        $profile = User::where('username',$username) -> first();
        $profile->delete();

        return redirect('admin_users')->with('user_deleted', $profile->name.' successfully deleted');

     }

     public function adminDeletePhotos(Request $request, $id) {
        if (auth()->user()->role != TRUE) {
            abort(403);
        }
        $photo = Photo::findOrFail($id);
        $photo->delete();

        return back()->with('photo_delete', 'Photo deleted successfully');;

     }

}
