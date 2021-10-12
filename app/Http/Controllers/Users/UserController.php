<?php

namespace App\Http\Controllers\Users;

use Carbon\Carbon;
use App\Models\Like;
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
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $ip_address = $request->ip();
        $page = Pages::where('name', 'Home')->first();
        $page_id = $page->id;
        Visitor::create([
            'page_id' => $page_id,
            'ip_address' => $ip_address
        ]);
        
        $countries = World::Countries();
        $kenya = Country::getByCode('ke');
        $counties = $kenya->children();
        $photos = Photo::orderBy('created_at', 'DESC')->paginate(1);
        if ($request->ajax()) {
            $view = view('layouts.feeds', compact('photos'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('users.profile', [
            'user' => new UserResource(auth()->user()), 
            'photos' => $photos, 
            'countries' => $countries, 'counties' => $counties
        ]);
    }

    public function profilePicture(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

       
        $imageName = time().'.'.$request->photo->extension();  
     
        $request->photo->move(public_path('images/profiles'), $imageName);
        $user = User::findOrFail(auth()->user()->id);
        $user->profile = $imageName;
        $user->save();
        return back()->with('status', 'Profile picture has been updated!');
    }


    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $code = CodeUser::where('user_id', auth()->user()->id)->firstOrFail();;
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
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->username = $request->username;
            $user->email = $request->email;
            $code->country_id = $request->code;
        
            $user->save();
            $code->save();

            return response()->json(['status'=>200, 'success'=>'Updated Successfully']);
        }
    }

    public function updateAbout(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $validator = Validator::make($request->all(), [
            //'dob' => 'required',
            'color' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'nationality' => 'required',
            'marital_status' => 'required|string|max:255',
            'height' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'bio' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>400, 'errors' => $validator->messages()]);
        }else {
            //$user->dob = $request->dob;
            $user->color = $request->color;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->nationality = $request->nationality;
            $user->marital_status = $request->marital_status;
            $user->height  = $request->height;
            $user->weight  = $request->weight;
            $user->bio  = $request->bio;
        
            $user->save();

            return response()->json(['status'=>200, 'success'=>'Updated Successfully']);
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required',new MatchOldPassword],
            'password' => ['required',Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised(), new CheckSamePasword]
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>400, 'errors' => $validator->messages()]);
        }else {
            $request->user()->update([
                "password" => bcrypt($request->password) 
            ]);

            return response()->json(['status'=>200, 'success'=>'Updated Successfully']);
        }
    }

    //Users profile
    public function userProfile(Request $request, $username)
    {
        $ip_address = $request->ip();
        $page = Pages::where('name', 'Profile')->first();
        $page_id = $page->id;
        Visitor::create([
            'page_id' => $page_id,
            'ip_address' => $ip_address
        ]);

        $countries = World::Countries();
        $kenya = Country::getByCode('ke');
        $counties = $kenya->children();
        $profile = User::where('username',$username)->firstOrFail();
        return view('users.user_profile', ['user' => new UserResource(auth()->user()), 'countries' => $countries, 'counties' => $counties, 'profile' => $profile]);
    }

    public function photoComment(Request $request, $id)
    {
        $request->validate([
            'message' => 'required',
        ]);
        
        Comment::create([
            'photo_id' => $id,
            'user_id' => auth()->user()->id,
            'message' => $request->message
        ]); 
        
        return back();
        
    }

    public function addPhotos(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>400, 'errors' => $validator->messages()]);
        }else {
            $photo_name = $this->imageUpload($request->photo);
     
            $photo = Photo::create([
                'name' => $photo_name,
                'user_id' => auth()->user()->id,
                'description' => $request->description
            ]);

            return response()->json(['status'=>200, 'photo_id'=>$photo->id]);
        }
        
    }

    protected function imageUpload($photo)
    {
    
        $imageName = time().'.'.$photo->extension();  
     
        $photo->move(public_path('images/gallery'), $imageName);
        
        return $imageName;
        
    }

    public function editPhotos(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'desctiption' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>400, 'errors' => $validator->messages()]);
        }else {
     
            $photo = Photo::findOrFail($request->id);

            $photo->description = $request->description;

            $photo->save();

            return response()->json(['status'=>200, 'success'=>'Edited Successfully', 'photo_id' => $request->id]);
        }
        
    }

    public function deletePhotos(Request $request, $id) {
        $photo = Photo::findOrFail($id);
        $photo->delete();

        return redirect('home')->with('photo_delete', 'Photo deleted successfully');
        //return back()->with('photo_delete', 'Photo deleted successfully');

     }

     public function photos(Request $request, $id) {
        $ip_address = $request->ip();
        $page = Pages::where('name', 'Photo')->first();
        $page_id = $page->id;
        Visitor::create([
            'page_id' => $page_id,
            'ip_address' => $ip_address
        ]);

        $photo = Photo::findOrFail($id);

        return view('users.photos', ['user' => new UserResource(auth()->user()), 'photo' => $photo]);
     }

     public function search()
    {
        $ip_address = $request->ip();
        $page = Pages::where('name', 'Search Results')->first();
        $page_id = $page->id;
        Visitor::create([
            'page_id' => $page_id,
            'ip_address' => $ip_address
        ]);

        $users = User::all();
        $users = collect($users);


        $search = request('search');

        $users = User::query()
        ->where('name', 'LIKE', "%{$search}%")
        ->orWhere('username', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->orWhere('phone', 'LIKE', "%{$search}%")
        ->orWhere('bio', 'LIKE', "%{$search}%")
        ->get();
        $users = collect($users);
        //use collections!!!
        return view('users.users', ['users' => $users, 'search' => $search]);
    }

    //get all posts
    public function getPosts()
    {
        return response()->json([
            'photos' => Photo::with(['user', 'comments'])->orderBy('created_at', 'DESC')->get()
        ]);
    }

    //like
    public function like($id)
    {
        $liked = Like::where('user_id', '=', auth()->user()->id)->where('photo_id', '=', $id)->first();
        if (!$liked) {
            Like::create([
                'photo_id' => $id,
                'user_id' => auth()->user()->id,
                'like' => TRUE
            ]); 
        }else{
            if ($liked->like == FALSE) {
                $liked->like = TRUE;
            }else{
                $liked->like = FALSE;
            }
            $liked->save();
        }
        return back();
    }
    
}
