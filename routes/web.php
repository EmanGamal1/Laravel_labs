<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
// use App\Http\Controllers\CommentController;

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


Route::middleware(['auth.post'])->group(function () {
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');

Route::post('posts/{post}/comments', [PostController::class, 'addComment'])->name('comments.store');
Route::get('comments/{id}/edit', [PostController::class, 'EditComment'])->name('comments.edit');
Route::put('/comments/{id}', [PostController::class, 'updateComment'])->name('comments.update');
Route::delete('posts/{post}/comments', [PostController::class, 'DeleteComment'])->name('comments.destroy');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');