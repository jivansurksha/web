<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OtpController extends Controller
{
    public function getState()
    {
        $state = State::where('country_id',101)->get();
        return ok($state);
    }

}
