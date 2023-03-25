<?php

namespace App\Http\Controllers\API\Hospital;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function signUp(Request $userRequest)
    {
        $rules=[
            'first_name' => 'required|string:30',
            'last_name' => 'required|string:30',
            'user_name' => 'required|unique:users,user_name',
            'gender' => 'required|string:30',
            // 'user_type' => 'required|max:30',
            'password' => 'required',
        ];

        $params = $this->validate($userRequest,$rules);

        $user = $userRequest->only('first_name','last_name','user_name','mobile','state_id','city_id','postcode','gender','password');
        $user['password']= Hash::make($userRequest['password']);
        $user['user_type'] = 'vendor';
        $user['country_id'] = 101;
        $user['email']=$userRequest['user_name'];

        $user = $this->recordSave(User::class,$user);

        $credentials = $userRequest->only('user_name', 'password');
        // $token = Auth::guard('api')->attempt($credentials);
        $token = Auth::attempt($credentials);
        if (!$token) {
            return bad(null, 'Unauthorized');
        }

        $user = Auth::user();
        if($user->is_active == 0){
            return forbidden();
        }

        $data = [
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ];

        return created($data);
    }

    public function userUpdate(Request $userRequest)
    {
        $rules=[
            'first_name' => 'required|string:30',
            'last_name' => 'required|string:30',
            'gender' => 'required|string:30',
            // 'user_type' => 'required|max:30',
            'password' => 'required',
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
}
