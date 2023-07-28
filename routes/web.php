<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialProvidersController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\Admin\SourcesController as AdminSourcesController;
use App\Http\Controllers\Admin\OrdersController as AdminOrdersController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'account'], static function () {
        Route::get('/', AccountController::class)
            ->name('account.account');
        Route::match(['get', 'post'],'/profile', [ProfileController::class, 'update'])
            ->name('account.profile.update');
//        Route::post('/profile/update', [ProfileController::class, 'update'])
//            ->name('account.profile.update');
    });


    // Admin
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => 'check.admin',
    ], static function () {
        Route::get('/', AdminIndexController::class)
            ->name('index');
        Route::get('/{source}/parser', ParserController::class)
            ->where('source', '\w+')
            ->name('parser');
        Route::resource('/categories', AdminCategoriesController::class);
        Route::resource('/news', AdminNewsController::class);
        Route::resource('/sources', AdminSourcesController::class);
        Route::resource('/orders', AdminOrdersController::class);
        Route::resource('/users', AdminUsersController::class);
    });
});

// Guest's routes

Route::group(['middleware' => 'guest'], function () {
    Route::get('/{driver}/redirect', [SocialProvidersController::class, 'redirect'])
        ->where('driver', '\w+')
        ->name('social-providers.redirect');
    Route::get('/{drivers}/callback', [SocialProvidersController::class, 'callback'])
        ->where('driver', '\w+')
        ->name('social-providers.callback');
});

//Route::get('/', function () {
//    return view('welcome');
//    dd(app());
//});

Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])
    ->where('news', '\d+')
    ->name('news.show');

Route::get('/categories', [
    CategoriesController::class, 'index'])
    ->name('categories.index');
Route::get('/categories/{id}', [CategoriesController::class, 'show'])
    ->where('id', '\d+')
    ->name('categories.show');

Route::get('/orders/create', [OrdersController::class, 'create'])
    ->name('orders.create');
Route::post('/orders/store', [OrdersController::class, 'store'])
    ->name('orders.store');



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

