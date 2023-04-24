<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('posts', [ApiController::class, 'get_posts']);
    Route::get('random-posts', [ApiController::class, 'get_random_posts']);
    Route::get('read-post/{slug}', [ApiController::class, 'read_post']);
    Route::get('comments/{slug}', [ApiController::class, 'comments']);
    Route::post('comments/{slug}', [ApiController::class, 'post_comment']);
    Route::get('announcements', [ApiController::class, 'get_announcements']);
    Route::get('youtube_link', [ApiController::class, 'get_youtube_link']);
    Route::post('views/{slug}', [ApiController::class, 'views']);
});
