<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string|null  $guard
   * @return mixed
   */
  public function handle($request, Closure $next, $guard = null) {
    if (Auth::guard($guard)->check()) {
      \Log::info('guard: ' . $guard);

      $user = Auth::guard($guard)->user();

      if ($user->hasRole('Admin')) {
        return redirect()->route('admin.dashboard.index');
      }

      if ($user->hasRole('Cliente')) {
        return redirect()->route('client.dashboard.index');
      }

      // Redirige a una página por defecto si el rol no coincide
      return redirect('/');
    }

    return $next($request);
  }
}
