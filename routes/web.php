<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DashboardHomeController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/posts', [HomeController::class, 'posts']);
Route::get('/categories', [HomeController::class, 'categories']);
Route::get('/authors', [HomeController::class, 'authors']);
Route::get('/{post}', [HomeController::class, 'post']);

Route::get('/dashboard/home', [DashboardHomeController::class, 'index'])->middleware('auth');
Route::get('/dashboard/posts/checkSlug', [PostController::class, 'checkSlug'])->middleware('auth');
Route::get('/dashboard/categories/checkSlug', [CategoryController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', PostController::class)->middleware('auth');
Route::resource('/dashboard/templates', TemplateController::class)->middleware('admin');
Route::resource('/dashboard/categories', CategoryController::class)->middleware('admin')->except(['show']);
Route::resource('/dashboard/users', UserController::class)->middleware('admin')->except(['show', 'create', 'store', 'edit', 'update']);

Route::get('/dashboard/profile', [ProfileController::class, 'index'])->middleware('auth');
Route::put('/dashboard/profile/update', [ProfileController::class, 'updateProfile'])->middleware('auth');
Route::put('/dashboard/profile/image', [ProfileController::class, 'updateImage'])->middleware('auth');
Route::delete('/dashboard/profile/image/delete', [ProfileController::class, 'deleteImage'])->middleware('auth');
Route::put('/dashboard/profile/password', [ProfileController::class, 'changePassword'])->middleware('auth');

// Route::get('/dashboard/images', [ImageController::class, 'index'])->middleware('auth');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
