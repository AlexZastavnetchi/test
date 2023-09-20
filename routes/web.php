<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [ReservationController::class, 'create']);
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/models/{make}', [ReservationController::class, 'getModels']);
Route::get('/colors/{make}/{model}',[ReservationController::class, 'getColors']);



