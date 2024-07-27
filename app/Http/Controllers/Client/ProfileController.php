<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends ClientController {
  //

  public function index() {
    return view('client.profiles.index');
  }
}
