<?php

namespace App\Http\Controllers\API\Hospital;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function getState()
    {
        $state = State::where('country_id',101)->get();
        return ok($state);
    }

    public function getCity($stateId=null)
    {
        if($stateId!=null){
            $city = City::where('state_id',$stateId)->get();

        }else{
            $city = City::all();
        }
        return ok($city);
    }

    public function signUp(UserRequest $userRequest)
    {
        // $rules=[
        //     'first_name' => 'required|string:30',
        //     'last_name' => 'required|string:30',
        //     'user_name' => 'required|unique:users,user_name',
        //     'gender' => 'required|string:30',
        //     // 'user_type' => 'required|max:30',
        //     'password' => 'required',
        // ];

        // $params = $this->validate($userRequest,$rules);

        $user = $userRequest->only('first_name','last_name','user_name','mobile','gender','password');
        $user['password']= Hash::make($userRequest['password']);
        $user['user_type'] = 'vendor';
        $user['email']=$userRequest['user_name'];

        $user = $this->recordSave(User::class,$user);

        return created($user);
    }
}
