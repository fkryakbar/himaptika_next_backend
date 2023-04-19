<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/posts', [PostsController::class, 'index'])->name('posts');
    Route::get('/dashboard/posts/new', [PostsController::class, 'add_new'])->name('new_post');
    Route::post('/dashboard/posts/new', [PostsController::class, 'post_add_new']);
    Route::get('/dashboard/posts/{slug}/delete', [PostsController::class, 'delete'])->name('delete_post');
    Route::get('/dashboard/posts/{slug}/edit', [PostsController::class, 'edit'])->name('edit_post');
    Route::post('/dashboard/posts/{slug}/edit', [PostsController::class, 'post_edit']);

    Route::get('/dashboard/comments', [CommentsController::class, 'index'])->name('comments');
    Route::get('/dashboard/comments/{id}/delete', [CommentsController::class, 'delete'])->name('delete_comment');

    Route::get('/dashboard/announcements', [AnnouncementController::class, 'index'])->name('announcements');
    Route::get('/dashboard/announcements/new', [AnnouncementController::class, 'new'])->name('new_announcement');
    Route::post('/dashboard/announcements/new', [AnnouncementController::class, 'post_new']);
    Route::get('/dashboard/announcements/{id}/delete', [AnnouncementController::class, 'delete'])->name('delete_announcements');
    Route::get('/dashboard/announcements/{id}/edit', [AnnouncementController::class, 'edit'])->name('edit_announcement');
    Route::post('/dashboard/announcements/{id}/edit', [AnnouncementController::class, 'post_edit']);
});
