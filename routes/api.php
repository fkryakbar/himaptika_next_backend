<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CollectionController;
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
    Route::get('posts/slug', [ApiController::class, 'get_slug']);
    Route::get('all-posts', [ApiController::class, 'all_posts']);
    Route::get('random-posts', [ApiController::class, 'get_random_posts']);
    Route::get('read-post/{slug}', [ApiController::class, 'read_post']);
    Route::get('comments/{slug}', [ApiController::class, 'comments']);
    Route::post('comments/{slug}', [ApiController::class, 'post_comment']);
    Route::get('announcements', [ApiController::class, 'get_announcements']);
    Route::get('youtube_link', [ApiController::class, 'get_youtube_link']);
    Route::post('views/{slug}', [ApiController::class, 'views']);
});

Route::middleware(['public.collection'])->prefix('v1/collection')->group(function () {
    Route::get('{collection}/slug', [CollectionController::class, 'post_slug']);
    Route::get('{collection}/read/{slug}', [CollectionController::class, 'read_post']);
    Route::post('{collection}/views/{slug}', [CollectionController::class, 'add_views']);
});
