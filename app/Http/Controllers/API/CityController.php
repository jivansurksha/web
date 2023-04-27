<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Speciality;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();

        return ok($cities);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city =  City::find($id);
        return ok($city);
    }

    public function showByStateId($stateId)
    {
        if($stateId!=null){
            $city = City::where('state_id',$stateId)->get();

        }else{
            $city = City::all();
        }
        return ok($city);
    }
}
