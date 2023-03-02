<?php

namespace App\Http\Controllers\Admin\Auth;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Traits\ThemeHelper;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Yajra\Datatables\Datatables;

use function PHPUnit\Framework\returnSelf;

class UsersController extends Controller
{
    use ThemeHelper;

    private $pageConfigs;
    private $data;

    public function __construct()
    {
        $this->pageConfigs = ['blankPage' => false];
    }

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->with('type','employee')->render('admin.auth.list',['pageConfigs' => $this->pageConfigs]);
    }

    public function edit($id =null)
    {
        $data['user']=User::where('id',$id)->with('state','city')->get()->first();
        $data['state'] = State::where('country_id',101)->get();
        $data['city'] = City::all();
        return view('admin.auth.edit',['pageConfigs' => $this->pageConfigs,'data'=>$data]);
    }

    public function register()
    {
        $data['state'] = State::where('country_id',101)->get();

        return view('admin.auth.register-user', ['pageConfigs' => $this->pageConfigs,'data'=>$data]);
    }

    public function create(Request $request)
    {
        $rules=[
            'first_name' => 'required|string:30',
            'last_name' => 'required|string:30',
            'user_name' => 'required|unique:users,user_name',
            'gender' => 'required|string:30',
            // 'user_type' => 'required|max:30',
            'password' => 'required',
        ];

        $params = $this->validate($request,$rules);

        $params['password'] = Hash::make($params['password']);
        $params['country_id'] = 101;

        if(!isset($request->all()['user_type'])){
            $params['user_type'] = 'employee';
        }

        $users = User::create($params);

        // echo Toastr::success("A new record has been updated successfully", "", ["positionClass" => "toast-top-right","progressBar"=>true,"timeOut"=>"5000"]);
        // return redirect('user/add');
        return redirect()->route('register-user')->with('message','Data added Successfully');
        // return created($users,"registration successfully!!");

    }
    public function update(Request $request)
    {

        $user = User::findOrFail($request->id);

        $rules=[
            'first_name' => 'required|string:30',
            'last_name' => 'required|string:30',
            'gender' => 'required|string:30',
        ];

        $params = $this->validate($request,$rules);
        $params['city_id'] = $request->city;
        $params['state_id'] = $request->state;
        $user->update($params);
        return redirect('admin/user');
    }



    public function show()
    {
        $users = User::all();

    }

}
