<?php

namespace App\Http\Controllers\API\Hospital;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Amenity;
use App\Models\Feature;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HospitalRegisterController extends Controller
{
    public function getFeatureList()
    {
        $feature = Feature::all();
        return ok($feature);
    }

    public function getAmenityList()
    {
        $amenity = Amenity::all();
        return ok($amenity);
    }

    public function hospitalRegister(ProfileRequest $profileRequest)
    {

        $hospitalInfo=null;

        $profileRequest['profile_feature_id'] = json_encode($profileRequest->profile_feature_id,true);
        $profileRequest['profile_amenity_id'] = json_encode($profileRequest->profile_amenity_id,true);

        foreach($profileRequest->request as $key=>$info){
            $hospitalInfo[substr($key,8)]=$info;
        }
        // dd($hospitalInfo);
        $hospitalInfo['user_id']=$profileRequest->profile_user_id;
        $hospitalInfo['created_by']=$profileRequest->profile_user_id;

        $profile = $this->recordSave(Profile::class,$hospitalInfo);
        // return response()->json(['message'=>'success']);
        return created($profile,'Hospital registration success');
    }

    public function hospitalUpdate($id,ProfileRequest $profileRequest)
    {
        $hospitalInfo=null;
        $profileRequest['profile_feature_id'] = json_encode($profileRequest->profile_feature_id,true);
        $profileRequest['profile_amenity_id'] = json_encode($profileRequest->profile_amenity_id,true);

        foreach($profileRequest->request as $key=>$info){
            $hospitalInfo[substr($key,8)]=$info;
        }
        $hospitalInfo['id']=$id;

        $profile = $this->recordSave(Profile::class,$hospitalInfo);
        // return response()->json(['message'=>'success']);
        return created($profile,'Hospital Updated successfully');
    }

    public function getHospitalList()
    {
        $hospitals = Profile::where('is_active',1)->with('owner','creator')->get();
        return ok($hospitals);
    }

    public function getHospitalById($id=null)
    {
        if($id!=null){
            $hospitals = Profile::where('id',$id)->with('owner','creator')->get()->first();
            return ok($hospitals);
        }
        return bad('Invalid Id');
    }
}
