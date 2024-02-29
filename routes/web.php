<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;

//admiin controller
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;

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

Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('categorypage');
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genrepage');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('countrypage');
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('moviepage');
Route::get('/xem-phim', [IndexController::class, 'watch'])->name('watchpage');
Route::get('/tap-phim', [IndexController::class, 'episode'])->name('episodepage');
Route::get('/update-year-phim', [MovieController::class, 'update_year'])->name('updateyearphim');
Route::get('/nam/{year}', [IndexController::class, 'year']);
Route::get('/tags/{tag}', [IndexController::class, 'tags']);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//route admin
Route::resource('category', CategoryController::class);
Route::post('resorting',[ CategoryController::class,'resorting'])->name('resorting');
Route::resource('genre', GenreController::class);
Route::resource('country', CountryController::class);
Route::resource('movie', MovieController::class);
Route::resource('episode', EpisodeController::class);


