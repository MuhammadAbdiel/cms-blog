<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardHomeController;
use App\Http\Controllers\TemplateController;

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
Route::resource('/dashboard/templates', TemplateController::class)->middleware('auth');
Route::resource('/dashboard/posts', PostController::class)->middleware('auth');
Route::get('/dashboard/select', [PostController::class, 'select'])->middleware('auth');
