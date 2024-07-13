<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends AdminController {
  //

  public function index() {
    \Log::info('index');

    return view('admin.dashboard');
  }
}
