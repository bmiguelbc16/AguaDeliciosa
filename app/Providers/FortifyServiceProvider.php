<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;

class FortifyServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   */
  public function register(): void {
    if (request()->is('admin', 'admin/*')) {
      $this->adminConfig();
    } else {
      $this->patientConfig();
    }
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void {
    // Fortify::loginView(function () {
    //   return view('admin.auth.login');
    // });

    // Fortify::authenticateUsing(function (Request $request) {
    //   $user = User::where('email', $request->email)->first();
    //   if ($user && Hash::check($request->password, $user->password)) {
    //     return $user;
    //   }
    // });

    // Below is the default configuration that comes with this provider
    // If you changed it, you can keep your changes
    // Fortify::createUsersUsing(CreateNewUser::class);
    Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
    Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
    Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

    RateLimiter::for('login', function (Request $request) {
      $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

      return Limit::perMinute(5)->by($throttleKey);
    });

    RateLimiter::for('two-factor', function (Request $request) {
      return Limit::perMinute(5)->by($request->session()->get('login.id'));
    });

    // dd(request()->is('admin', 'admin/*'));
    if (request()->is('admin', 'admin/*')) {
      $this->adminFotifyConfig();
    } else {
      $this->patientFotifyConfig();
    }
  }

  // Register --------
  private function adminConfig() {
    // config(['fortify.features' => [
    //     Features::resetPasswords(),
    //     Features::updatePasswords(),
    // ]]);

    config()->set('fortify.username', 'email');
    config()->set('fortify.guard', 'admin');
    config()->set('fortify.prefix', 'admin');
    config()->set('fortify.home', '/admin/dashboard');
    config()->set('fortify.redirects.login', '/admin/dashboard');
    config()->set('fortify.redirects.logout', '/admin');
  }

  private function patientConfig() {
    // config(['fortify.features' => [
    //     Features::registration(),
    //     Features::resetPasswords(),
    //     Features::emailVerification(),
    //     Features::updatePasswords(),
    // ]]);

    config()->set('fortify.username', 'email');
    config()->set('fortify.guard', 'patient');
    config()->set('fortify.prefix', 'pacientes');
    config()->set('fortify.home', '/pacientes/dashboard');
    config()->set('fortify.redirects.login', '/pacientes/dashboard');
    config()->set('fortify.redirects.logout', '/pacientes');
  }

  // Boot --------
  private function adminFotifyConfig() {
    // Fortify::createUsersUsing(CreateNewUser::class);
    Fortify::loginView('admin.auth.login');

    Fortify::authenticateUsing(function (Request $request) {
      $user = User::where('email', $request->email)->first();
      if ($user && Hash::check($request->password, $user->password)) {
        return $user;
      }
    });
  }

  private function patientFotifyConfig() {
    // Fortify::createUsersUsing(CreateNewCustomer::class);
    Fortify::loginView('client.auth.login');
    // Fortify::registerView('client.auth.register');
    // Fortify::verifyEmailView('client.auth.verify-email');
    // Fortify::requestPasswordResetLinkView('client.auth.forgot-password');
    // Fortify::resetPasswordView('client.auth.reset-password');

    Fortify::authenticateUsing(function (Request $request) {
      $user = Patient::where('email', $request->email)->first();
      if ($user && Hash::check($request->password, $user->password)) {
        return $user;
      }
    });
  }
}
