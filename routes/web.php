<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DashboardHomeController;
use App\Http\Controllers\ProfileController;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/categories', [HomeController::class, 'categories']);
Route::get('/authors', [HomeController::class, 'authors']);
Route::get('/{post}', [HomeController::class, 'post']);

Route::get('/dashboard/home', [DashboardHomeController::class, 'index'])->middleware('auth');
Route::get('/dashboard/posts/checkSlug', [PostController::class, 'checkSlug'])->middleware('auth');
Route::get('/dashboard/categories/checkSlug', [CategoryController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', PostController::class)->middleware('auth');
Route::resource('/dashboard/templates', TemplateController::class)->middleware('auth');
Route::resource('/dashboard/categories', CategoryController::class)->middleware('auth')->except(['show']);
Route::resource('/dashboard/users', UserController::class)->middleware('auth')->except(['show', 'create', 'store', 'edit', 'update']);

Route::get('/dashboard/profile', [ProfileController::class, 'profile'])->middleware('auth');
Route::put('/dashboard/profile/image/{user:id}', [ProfileController::class, 'update'])->middleware('auth');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
