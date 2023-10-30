<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ViewerController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

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

Route::prefix('cms/')->middleware('guest:admin,author')->group(function () {
    Route::get('{guard}/login', [UserAuthController::class, 'showLogin'])->name('view.login');
    Route::post('{guard}/login', [UserAuthController::class, 'login']);
});

Route::prefix('cms/admin')->middleware('auth:admin,author')->group(function () {
    Route::get('logout', [UserAuthController::class, 'logout'])->name('view.logout');
    Route::get('change/password', [SettingController::class, 'changePassword'])->name('view.changePassword');
    Route::post('update/password', [SettingController::class, 'updatePassword'])->name('updatePassword');
});

Route::prefix('cms/admin/')->middleware('auth:admin,author')->group(function () {
    Route::view('', 'cms.home')->name('home');
    Route::resource('countries', CountryController::class);
    Route::post('countries_update/{id}', [CountryController::class, 'update'])->name('countries_update');

    Route::resource('cities', CityController::class);
    Route::post('cities_update/{id}', [CityController::class, 'update'])->name('cities_update');

    Route::resource('admins', AdminController::class);
    Route::post('admins_update/{id}', [AdminController::class, 'update'])->name('admins_update');

    Route::resource('viewers', ViewerController::class);
    Route::post('viewers_update/{id}', [ViewerController::class, 'update'])->name('viewers_update');

    Route::resource('sliders', SliderController::class);
    Route::post('sliders_update/{id}', [SliderController::class, 'update'])->name('sliders_update');

    Route::resource('contacts', ContactController::class);
    Route::resource('comments', CommentController::class);

    Route::resource('authors', AuthorController::class);
    Route::post('authors_update/{id}', [AuthorController::class, 'update'])->name('authors_update');

    Route::resource('categories', CategoryController::class);
    Route::post('categories_update/{id}', [CategoryController::class, 'update'])->name('categories_update');

    Route::resource('articles', ArticleController::class);
    Route::post('articles_update/{id}', [ArticleController::class, 'update'])->name('articles_update');

    Route::resource('articles', ArticleController::class);
    Route::post('articles_update/{id}', [ArticleController::class, 'update'])->name('articles_update');
    Route::get('/create/articles/{id}', [ArticleController::class, 'createArticle'])->name('createArticle');
    Route::get('/index/articles/{id}', [ArticleController::class, 'indexArticle'])->name('indexArticle');


    Route::resource('roles', RoleController::class);
    Route::post('roles_update/{id}', [RoleController::class, 'update'])->name('roles_update');

    Route::resource('permissions', PermissionController::class);
    Route::post('permissions_update/{id}', [PermissionController::class, 'update'])->name('permissions_update');

    Route::resource('roles.permissions', RolePermissionController::class);

    Route::get('edit/profile', [UserAuthController::class, 'editProfile'])->name('editProfile');
});


Route::prefix('news/')->group(function () {
    Route::get('home', [HomeController::class, 'home'])->name('news.home');
    Route::get('det/{id}', [HomeController::class, 'det'])->name('detailes');
    Route::get('all/{id}', [HomeController::class, 'all'])->name('allNews');
    Route::get('contact', [HomeController::class, 'showContact'])->name('contact');
    Route::post('store', [HomeController::class, 'storeContact']);
});
