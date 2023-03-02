<?php

namespace App\Http\Controllers\Landing;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
      $pageConfigs = ['pageHeader' => true];

      return view('landing.index', ['pageConfigs' => $pageConfigs]);
    }

}
