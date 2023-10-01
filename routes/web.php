<?php

use App\Http\Controllers\CountryController;
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

Route::prefix('cms/admin')->group(function () {
    Route::view('/', 'cms.parent');
    Route::view('temp', 'cms.temp');
    Route::resource('countries', CountryController::class);
    Route::view('countries/index', 'cms.country.index');
});
