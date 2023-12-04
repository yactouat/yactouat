<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AllowsOnlyAdmin;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// home
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/home', [PostController::class, 'index'])->name('home');

// auth + user-related
Route::middleware('auth')->group(function() {
    Route::delete('delete-profile', [UserController::class, 'destroy']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('profile', [UserController::class, 'edit']);
    Route::post('signup-for-newsletter',[UserController::class, 'signupForNewsletter']);
    Route::patch('update-profile', [UserController::class, 'update']);
});
Route::middleware('guest')->group(function() {
    Route::get('login', [UserController::class, 'showLogin'])->middleware('guest');
    Route::post('login', [UserController::class, 'login'])->middleware('guest');
    Route::get('register', [UserController::class, 'create'])->middleware('guest');
    Route::post('register', [UserController::class, 'store'])->middleware('guest');
});
Route::get('unsubscribe-from-emails', [UserController::class, 'unsubscribeFromEmails'])
    ->name('unsubscribe-from-emails');

// messages and emails
Route::post('contact', [MessageController::class, 'store'])->middleware('auth');

// posts
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('post');
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store'])->name('post.comments')->middleware('auth');

// tests
// Route::get('test', function () {
//     $user = auth()->user();
//     return new UserRegistered($user);
// })->middleware(AllowsOnlyAdmin::class);
