<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    // get allPosts
    // $posts = Post::all();

    // option 1:
    // $posts = Post::where('user_id', auth()->id())->get();

    // option 2:
    $posts = [];
    if(auth()->check()){
        $posts = auth()->user()->userPosts()->latest()->get();
    }

    return view('home', ['posts' => $posts]);

});


Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Blog Post related routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);



