<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\MeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Users\HomeController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Users\PhotoController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\SettingsController;
use App\Http\Controllers\Users\CommentController;
use App\Http\Controllers\Users\ProfileController;
use App\Http\Controllers\Users\EditUserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController; 
use App\Http\Controllers\Users\Register_usersController;
use App\Http\Controllers\Users\ProfileSettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route group for public users
//Route::get('me',[MeController::class ,'getMe']);

//Route group for authenticated users only

//Route::get('register_user',[Register_usersController::class ,'index'])->middleware(['auth', 'verified']);
//Route::post('register_user',[Register_usersController::class ,'register'])->middleware(['auth', 'verified']);

Route::get('users',[UsersController::class ,'index'])->middleware(['auth', 'verified'])->name('users');
Route::post('users',[UsersController::class ,'search'])->middleware(['auth', 'verified']);


Route::get('logout',[LoginController::class ,'logout'])->middleware(['auth', 'verified'])->name('logout');







Route::get('dashboard',[AdminController::class ,'index'])->middleware(['auth', 'verified']);
Route::get('admin_users',[AdminController::class ,'users'])->middleware(['auth', 'verified']);
Route::get('visitors_reports',[AdminController::class ,'visitorsReports'])->middleware(['auth', 'verified']);

Route::get('home',[UserController::class ,'profile'])->middleware(['auth', 'verified']);
Route::put('edit_profile',[UserController::class ,'updateProfile'])->middleware(['auth', 'verified']);
Route::put('edit_about',[UserController::class ,'updateAbout'])->middleware(['auth', 'verified']);
Route::put('edit_password',[UserController::class ,'updatePassword'])->middleware(['auth', 'verified']);
Route::put('profile_picture',[UserController::class ,'profilePicture'])->name('profile_picture')->middleware(['auth', 'verified']);
Route::get('like/{id}',[UserController::class ,'like'])->middleware(['auth', 'verified']);

Route::get('user_profile/{username}',[UserController::class ,'userProfile'])->middleware(['auth', 'verified']);
Route::put('admin_user_profile/{username}',[AdminController::class ,'updateUserProfile'])->name('admin_user_profile')->middleware(['auth', 'verified']);
Route::put('admin_user_about/{username}',[AdminController::class ,'updateUserAbout'])->name('admin_user_about')->middleware(['auth', 'verified']);
Route::put('admin_user_password/{username}',[AdminController::class ,'updateUserPassword'])->name('admin_user_password')->middleware(['auth', 'verified']);
Route::get('delete_user/{username}',[AdminController::class ,'deleteUser'])->name('delete_user')->middleware(['auth', 'verified']);
Route::get('admin_delete_photos/{id}',[AdminController::class ,'adminDeletePhotos'])->name('delete_photos')->middleware(['auth', 'verified']);

Route::post('photo_comment/{id}',[UserController::class ,'photoComment'])->name('photo_comment')->middleware(['auth', 'verified']);
Route::post('add_photos',[UserController::class ,'addPhotos'])->name('add_photos')->middleware(['auth', 'verified']);
Route::put('edit_photos',[UserController::class ,'editPhotos'])->name('edit_photos')->middleware(['auth', 'verified']);
Route::get('delete_photos/{id}',[UserController::class ,'deletePhotos'])->name('delete_photos')->middleware(['auth', 'verified']);
Route::get('photos/{id}',[UserController::class ,'photos'])->middleware(['auth', 'verified']);
Route::get('posts',[UserController::class ,'getPosts'])->name('posts')->middleware(['auth', 'verified']);

Route::get('/search',[UserController::class ,'search'])->middleware(['auth', 'verified']);
Route::get('/get_users', [AdminController::class, 'getUsers'])->name('users_list');





//Route group for authenticated GUEST only

Route::get('register',[RegisterController::class ,'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('register',[RegisterController::class ,'register'])->middleware('guest');

Route::get('verify', [VerificationController::class ,'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class ,'verify'])->name('verification.verify');
Route::get('resend', [VerificationController::class ,'resend'])->name('verification.resend');

Route::get('login',[LoginController::class ,'showLoginForm'])->name('login')->middleware('guest');
Route::post('login',[LoginController::class ,'login'])->middleware('guest');
Route::get('forgot_password',[ForgotPasswordController::class ,'showLinkRequestForm'])->middleware('guest')->name('password.request');
Route::post('forgot_password',[ForgotPasswordController::class ,'sendResetLinkEmail'])->middleware('guest')->name('password.email');
Route::get('reset_password',[ResetPasswordController::class ,'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('update_password',[ResetPasswordController::class ,'reset'])->middleware('guest')->name('password.update');


