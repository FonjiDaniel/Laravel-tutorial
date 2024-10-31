<?php

use App\Models\Post;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {

    // Check if the user is authenticated
        $posts = Post::where('user_id', auth()->id())->get();
        return view('home', ['posts' => $posts]);
});


Route::post('/register', [UserController::class,  'register']
);
Route::post('/logout', [UserController::class, 'logout']);

Route::post('/login', [UserController::class, 'login']);

Route::post('/create-post', [PostController::class, 'createPost']);

Route::get('/edit-post/{post}' , [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class , 'editPost']);
Route::post('/delete-post{post}', [PostController::class, 'deletePost']);
Route::get('/counter', Counter::class);