<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Models\User;
use App\Models\Post;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return 'Hello World';
});

Route::get('/home', function () {

    $posts = Post::all();

    $userPosts = [];

    if (auth()->check()) {
        // get the user's posts from most recent to oldest
        $userPosts = auth()->user()->userPosts()->latest()->get();
    }

    return view('home', [
        'posts' => $posts,
        'userPosts' => $userPosts
    ]);
});


// User related routes
Route::post('/register', [
    UserController::class, 'register'
]);
Route::post('/logout', [
    UserController::class, 'logout'
]);
Route::post('/login', [
    UserController::class, 'login'
]);

// Post related routes
Route::post('/create-post', [
    PostController::class, 'createPost'
]);


