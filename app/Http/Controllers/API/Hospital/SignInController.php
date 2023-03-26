<?php

namespace App\Http\Controllers\API\Hospital;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function signIn(Request $request)
    {
        // $request->validate([
        //     'user_name' => 'required|string|user_name',
        //     'password' => ['required', 'string', 'min:6','max:20'],
        // ]);
        $credentials = $request->only('user_name', 'password');
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
        return ok($data,'Login Successfully');
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }


    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function getUserDetails($id)
    {
        $user = User::find($id)->with('state','city');
        return ok($user);
    }
}
