<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('admin', [PostController::class, 'admin']);
Route::get('my-video', [PostController::class, 'userPosts']);

Route::apiResource('video', PostController::class);

Route::post('video/{post}/comment', [CommentController::class, 'store']);
Route::post('video/{post}/like', [LikeController::class, 'store']);
