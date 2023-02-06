<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Route::get('/contact-us', [ContactUsController::class, 'showForm']);
Route::post('/contact-us', [ContactUsController::class, 'sendEmailToAdmin'])->name('contactUs.sendEmail');

Route::get('search', [SearchController::class, 'showForm']);
Route::get('users', [UserController::class, 'index']);

Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');
Route::post('/post/{post}/comment', [PostController::class, 'addComment'])->name('comment.store');
