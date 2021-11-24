<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('startseite');
});

Route::get('/info', function () {
    return view('info');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources(['hashtag' => 'App\Http\Controllers\HashtagController']);

Route::resources(['post' => 'App\Http\Controllers\PostController']);

Route::resources(['user' => 'App\Http\Controllers\UserController']);

Route::get('/post/hashtag/{hashtag_id}', [App\Http\Controllers\HashtagPostController::class, 'getFilteredPosts'])->name('hashtag_post');

Route::get('/post/{post_id}/hashtag/{hashtag_id}/attach', [App\Http\Controllers\HashtagPostController::class, 'attachHashtag']);
Route::get('/post/{post_id}/hashtag/{hashtag_id}/detach', [App\Http\Controllers\HashtagPostController::class, 'detachHashtag']);