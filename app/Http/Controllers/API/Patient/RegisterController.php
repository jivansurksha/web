<?php

namespace App\Http\Controllers\API\Patient;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Otp;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
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

    public function checkMobile(Request $request){
        $data = $request->all();
        $otp = new Otp();
        $number = rand(1000,9999);
        $otp->create([
            'mobile'=>$data['mobile'],
            'otp'=> $number
        ]);
        $userdata = [];
        $user = User::where(['user_name'=>$data['mobile'],'user_type'=>'app','user_type'=>'bro'])->get()->first();
        $userdata['user'] = $user;
        $userdata['otp'] = $number;

        if($user){
            return ok($userdata,'mobile found');
        }
        return ok($userdata,'mobile not found');
    }

    public function signUp(Request $userRequest)
    {
        $rules=[
            'first_name' => 'required|string:30',
            'last_name' => 'required|string:30',
            'gender' => 'required|string:30',
        ];

        $params = $this->validate($userRequest,$rules);

        $user = $userRequest->only('first_name','last_name','user_type','email','mobile','state_id','city_id','postcode','gender','password');
        $user['password']= $userRequest['password'] !=null ? Hash::make($user['password']) : null;
        $user['country_id'] = 101;
        $user['user_name']=$user['mobile'];

        $user = $this->recordSave(User::class,$user);

        return created($user);
    }

    public function userUpdate(Request $userRequest)
    {
        $rules=[
            'first_name' => 'required|string:30',
            'last_name' => 'required|string:30',
            'gender' => 'required|string:30',
        ];

        $params = $this->validate($userRequest,$rules);
        $user = $this->recordSave(User::class,$userRequest);
        return created($user,'User Updated successfully');
    }

    public function changePassword(Request $userRequest)
    {
        $user = User::find($userRequest->id);
        $user->update([
            "password"=>Hash::make($userRequest['password'])
        ]);
        return created($user,'Password Updated successfully');
    }

    public function getUserDetails($id)
    {
        $user = User::with('state','city')->find($id);
        return ok($user);
    }
}
