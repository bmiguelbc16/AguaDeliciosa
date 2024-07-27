<?php

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

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\OrderController;
Route::get('/', function () {
  return redirect()->secure(route('client.dashboard.index'));
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

Route::prefix('registros')->group(function () {
  Route::resource('pedidos', OrderController::class)
    ->except(['show'])
    ->parameters(['pedidos' => 'order'])
    ->names('orders');
});

// 404 for undefined routes
Route::any('/{page?}', function () {
  return View::make('pages.error.404');
})->where('page', '.*');
