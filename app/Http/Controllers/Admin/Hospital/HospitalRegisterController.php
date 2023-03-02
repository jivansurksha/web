<?php

namespace App\Http\Controllers\Admin\Hospital;
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

class HospitalRegisterController extends Controller
{
    private $pageConfigs;
    private $data;

    public function __construct()
    {
        $this->pageConfigs = ['blankPage' => false];
    }

    // public function index(AmenityDataTable $dataTable)
    // {
    //     return $dataTable->render('admin.feature.amenity-list',['pageConfigs' => $this->pageConfigs]);
    // }

    public function hospital()
    {
        $data['state'] = State::where('country_id',101)->get();
        $data['city'] = City::all();
        $data['feature'] = Feature::all();
        $data['amenity'] = Amenity::all();
        return view('admin.hospital.add', ['pageConfigs' => $this->pageConfigs,'data'=>$data]);
    }

    public function create(UserRequest $userRequest,ProfileRequest $profileRequest,ProfileBranchRequest $profileBranchRequest)
    {
        $userInfo = $userRequest->only('first_name','last_name','user_name','email','mobile','state_id','city_id','postcode','gender','password');

        $user = $this->recordSave(User::class,$userInfo);
        if($user){
            $hospitalRequest  = $profileRequest->only('profile_contact_person','profile_phone','profile_email','profile_type','profile_alt_number','profile_org_name','profile_reg_number','profile_speciality','profile_amenity_id','profile_feature_id');
            $hospitalInfo=null;
            $hospitalRequest['profile_feature_id'] = json_encode($hospitalRequest['profile_feature_id'],true);
            $hospitalRequest['profile_amenity_id'] = json_encode($hospitalRequest['profile_amenity_id'],true);

            foreach($hospitalRequest as $key=>$info){
                $hospitalInfo[substr($key,8)]=$info;
            }

            $hospitalInfo['user_id']=$user->id;
            $hospitalInfo['created_by']=auth('web')->user()->id;
            $profile = $this->recordSave(Profile::class,$hospitalInfo);
            if($profile){
                $branchRequest  = $profileBranchRequest->only('branch_contact_person','branch_phone','branch_email','branch_address','branch_state_id','branch_city_id','branch_postcode','branch_latitude','branch_longitude');
                $branchInfo=null;
                foreach($branchRequest as $key=>$info){
                    $branchInfo[substr($key,7)]=$info;
                }
                $branchInfo['profile_id']=$profile->id;
                $branchInfo['is_primary']=1;
                $branchInfo['created_by']=auth('web')->user()->id;
                //Save Hospital Profile
                $branch = $this->recordSave(ProfileBranch::class,$branchInfo);
            }
        }

        return redirect()->back()->with($this->toastrMsg('created'));

    }
}
