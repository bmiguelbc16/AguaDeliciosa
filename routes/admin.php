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
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ClientController;

Route::get('/', function () {
  return redirect()->secure(route('admin.dashboard.index'));
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::prefix('seguridad')->group(function () {
  Route::resource('trabajadores', EmployeeController::class)
    ->except(['show'])
    ->parameters(['trabajadores' => 'employee'])
    ->names('employees');
});

Route::prefix('registros')->group(function () {
  Route::resource('clientes', ClientController::class)
    ->except(['show'])
    ->parameters(['clientes' => 'client'])
    ->names('clients');
});

// 404 for undefined routes
Route::any('/{page?}', function () {
  return View::make('pages.error.404');
})->where('page', '.*');
