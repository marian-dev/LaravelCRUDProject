<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\CarsController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::resource('/cars', CarsController::class)->middleware('auth');
Route::resource('/drivers', DriversController::class)->middleware('auth');
Route::resource('/dashboard', DashboardController::class)->middleware('auth');

Route::post('/cars/{car_id}/assign/{driver_id}', [CarsController::class, 'assign'])->name('cars.assign');
Route::delete('/dashboard/{car_id}/destroy/{driver_id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');