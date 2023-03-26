<?php

namespace App\Http\Controllers\Landing;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
      $pageConfigs = ['pageHeader' => true];

      return view('landing.about', ['pageConfigs' => $pageConfigs]);
    }

}
