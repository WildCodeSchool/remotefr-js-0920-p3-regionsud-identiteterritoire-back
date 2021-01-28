<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunesController;
use App\Http\Controllers\MeteoController;
use App\Http\Controllers\MairiesController;
use App\Http\Controllers\GeoCommunesController;
use App\Http\Controllers\MairesController;
use App\Http\Controllers\TourismesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/communes', [CommunesController::class, 'index'])->name("communes.index");
Route::get('/communes/random/', [CommunesController::class, 'random']);
Route::get('/communes/autocomplete', [CommunesController::class, 'autocomplete']);
Route::get('/communes/gallery/random/', [CommunesController::class, 'gallery_random']);
Route::get('/communes/{code_insee}', [CommunesController::class, 'show'])->where('code_insee',"^[a-zA-Z0-9\-]+$");
Route::get('/communes/{code_insee}/gallery/', [CommunesController::class, 'gallery'])->where('code_insee',"^[a-zA-Z0-9\-]+$");
Route::get('/communes/{code_insee}/slider/', [CommunesController::class, 'slider'])->where('code_insee',"^[a-zA-Z0-9\-]+$");
Route::get('/communes/{code_insee}/meteo/', [MeteoController::class, 'show'])->where('code_insee',"^[a-zA-Z0-9\-]+$");
Route::get('/communes/{code_insee}/mairie/', [MairiesController::class, 'show'])->where('code_insee',"^[a-zA-Z0-9\-]+$");
Route::get('/communes/{code_insee}/maire/', [MairesController::class, 'show'])->where('code_insee',"^[a-zA-Z0-9\-]+$");
Route::get('/communes/{code_insee}/geocommunes/', [GeoCommunesController::class, 'show'])->where('code_insee',"^[a-zA-Z0-9\-]+$");
Route::get('/communes/{code_insee}/tourismes/', [TourismesController::class, 'show'])->where('code_insee',"^[a-zA-Z0-9\-]+$");
Route::get('/communes/{code_insee}/tourismes/counter/', [TourismesController::class, 'counter'])->where('code_insee',"^[a-zA-Z0-9\-]+$");



//Route::get('/wrapper/culturo/', [TourismesController::class, 'counter'])->where('code_insee',"^[a-zA-Z0-9\-]+$");