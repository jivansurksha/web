<?php

namespace App\Http\Controllers\Admin\Hospital;

use App\DataTables\HospitalDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileBranchRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserRequest;
use App\Models\Amenity;
use App\Models\City;
use App\Models\Facility;
use App\Models\Feature;
use App\Models\Profile;
use App\Models\ProfileBranch;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HospitalRegisterController extends Controller
{
    private $pageConfigs;
    private $data;

    public function __construct()
    {
        $this->pageConfigs = ['blankPage' => false];
    }

    public function index(HospitalDataTable $dataTable)
    {
        return $dataTable->render('admin.hospital.list',['pageConfigs' => $this->pageConfigs]);
    }

    public function hospital()
    {
        $data['state'] = State::where('country_id',101)->get();
        $data['city'] = City::all();
        $data['feature'] = Feature::all();
        $data['amenity'] = Amenity::all();
        return view('admin.hospital.add', ['pageConfigs' => $this->pageConfigs,'data'=>$data]);
    }

    public function create(UserRequest $userRequest,ProfileRequest $profileRequest)
    {
        $userInfo = $userRequest->only('first_name','last_name','user_name','email','mobile','state_id','city_id','postcode','gender','password');
        $userInfo['password']= Hash::make($userInfo['password']);
        $user = $this->recordSave(User::class,$userInfo);
        if($user){
            $hospitalRequest  = $profileRequest->only('profile_contact_person','profile_phone','profile_email','profile_type','profile_alt_number','profile_org_name','profile_reg_number','profile_speciality','profile_amenity_id','profile_feature_id','profile_address','profile_state_id','profile_city_id','profile_postcode','profile_latitude','profile_longitude');
            $hospitalInfo=null;
            $hospitalRequest['profile_feature_id'] = json_encode($hospitalRequest['profile_feature_id'],true);
            $hospitalRequest['profile_amenity_id'] = json_encode($hospitalRequest['profile_amenity_id'],true);

            foreach($hospitalRequest as $key=>$info){
                $hospitalInfo[substr($key,8)]=$info;
            }

            $hospitalInfo['user_id']=$user->id;
            $hospitalInfo['created_by']=auth('web')->user()->id;
            $profile = $this->recordSave(Profile::class,$hospitalInfo);
        }

        return redirect()->back()->with($this->toastrMsg('created'));

    }

    public function hospitallist()
    {

    }
    public function delete($id)
    {
        if($id!=null){
            $profile = Profile::find($id);
            $profile->delete();
            return redirect()->back()->with($this->toastrMsg('Deleted'));
        }
    }

    public function deactivateHospital($id)
    {
        if($id!=null){
            $profile = Profile::find($id);
            $profile->update([
                'is_active'=>0
            ]);
            return redirect()->back()->with($this->toastrMsg('Deactivated'));
        }
    }

    public function activateHospital($id)
    {
        if($id!=null){
            $profile = Profile::find($id);
            $profile->update([
                'is_active'=>1
            ]);
            return redirect()->back()->with($this->toastrMsg('Activated'));
        }
    }
}
