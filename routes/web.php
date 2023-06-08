<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\NewsController;

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

//   return view('Welcome');


// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.'], static function() {
    Route::get('/', [AdminIndexController::class, 'index'])
        ->name('index');
    Route::resource('/categories', AdminCategoriesController::class);
    Route::resource('/news', AdminNewsController::class);
});

// Guest's routes

Route::get('/', [
    HomeController::class, 'index'])
    ->name('index');
Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])
    ->where('id', '\d+')
    ->name('news.show');
Route::get('/categories', [
    CategoriesController::class, 'index'])
    ->name('categories.index');
Route::get('/categories/{id}', [CategoriesController::class, 'show'])
    ->where('id', '\d+')
    ->name('categories.show');
