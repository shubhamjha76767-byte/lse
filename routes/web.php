<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RotaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
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





Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/toggle-favourite', [HomeController::class, 'toggleFavourite']);

Route::get('/duo-gallery', [HomeController::class, 'duoProfile']);
Route::post('/toggle-duo-favourite', [HomeController::class, 'toggleDuoFavourite']);

Route::get('/favourite-gallery', [HomeController::class, 'showFavourites']);

Route::get('/location/{slug}', [HomeController::class, 'locationdtails']);
Route::get('/category/{slug}', [HomeController::class, 'categorydtails']);


// Route::view('/favourite-gallery', 'favourite-gallery');
Route::post('/clear-favourites', function () {
    Cache::forget('favourites_' . request()->ip());
    Cache::forget('favourites_duo_' . request()->ip());
    return response()->json(['success' => true]);
})->name('favourites.clear');


Route::get('/rota', [RotaController::class, 'weekrota']);

Route::get('/rota-day', [RotaController::class, 'dailyRota'])->name('daily.rota');

Route::get('profile/{slug}', [HomeController::class, 'profiledetails']);



Route::get('/news', [BlogController::class, 'index']);

Route::get('/news/{slug}', [BlogController::class, 'blogdetails']);


Route::get('/about-us', [PageController::class, 'about']);

Route::get('/terms-conditions', [PageController::class, 'term']);
Route::get('/privacy', [PageController::class, 'privecy']);

Route::get('/bookings', [PageController::class, 'booking']);
Route::get('/joinus', [PageController::class, 'csting']);

Route::post('/booking', [PageController::class, 'submit'])->name('booking.submit');

Route::post('/application/submit', [PageController::class, 'submitcasting'])->name('application.submit');

// Route::view('/about-us', 'aboutus');
//Route::view('/duo-gallery', 'duogallery');
// Route::view('/gallery', 'gallery');
// Route::view('/joinus', 'joinus');
// Route::view('/bookings', 'booking');
//Route::view('/news', 'blog');
//Route::view('/news-details', 'blogdetails');
//Route::view('/rota', 'rota');
//Route::view('/rota-day', 'rotaday');
//Route::view('/single-profile', 'profiledetails');
