<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {
  /**
   * The path to the "home" route for your application.
   *
   * This is used by Laravel authentication to redirect users after login.
   *
   * @var string
   */
  public const HOME = '/admin';
  /**
   * This namespace is applied to your controller routes.
   *
   * In addition, it is set as the URL generator's root namespace.
   *
   * @var string
   */
  protected $namespace = 'App\Http\Controllers';

  /**
   * Define your route model bindings, pattern filters, etc.
   *
   * @return void
   */
  public function boot() {
    //

    parent::boot();
  }

  /**
   * Define the routes for the application.
   *
   * @return void
   */
  public function map() {
    $this->mapApiRoutes();

    $this->mapWebRoutes();

    //
  }

  /**
   * Define the "web" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapWebRoutes() {
    Route::middleware('web')
      ->namespace($this->namespace)
      ->group(base_path('routes/web.php'));

    Route::prefix('admin')
      ->middleware('web', 'auth', 'role:Admin|Gestor de pedidos|Vendedor|Almacen')
      ->namespace($this->namespace . '\Admin')
      ->name('admin.')
      ->group(base_path('routes/admin.php'));

    Route::prefix('clientes')
      ->middleware('web', 'auth', 'role:Cliente')
      ->namespace($this->namespace . '\Client')
      ->name('client.')
      ->group(base_path('routes/client.php'));
  }

  /**
   * Define the "api" routes for the application.
   *
   * These routes are typically stateless.
   *
   * @return void
   */
  protected function mapApiRoutes() {
    Route::prefix('api')
      ->middleware('api')
      ->namespace($this->namespace)
      ->group(base_path('routes/api.php'));
  }
}
