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

      if ($guard === 'admin') {
        return redirect()->route('admin.dashboard.index');
      } elseif ($guard === 'patient') {
        return redirect()->route('patient.dashboard.index');
      }
    }

    return $next($request);
  }
}
