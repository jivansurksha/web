<?php

namespace App\Http\Controllers\API\Hospital;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Amenity;
use App\Models\Booking;
use App\Models\Feature;
use App\Models\Patient;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AppointmentController extends Controller
{
    public function bookAppointment(Request $request)
    {
        $rules=[
            'hospital_id' => 'required|integer',
            'user_id' => 'required|integer',
            'relationship' => 'required',
            'name' => 'required',
            'date' => 'required',
            'pincode'=>'required|number',
            'gender' => 'required|string:30',
        ];

        $params = $this->validate($request,$rules);

        $patientData = $request->except('hospital_id','user_id');

        $patient = new Patient();

        $patientData['created_by']=$request->user_id;
        //patient data created
        $patient = $patient->create($patientData);
        if($patient->count()>0){
            $appintmentSchedule = new Booking();
            $bookingData['patient_id'] = $patient->id;
            $bookingData['booking_in'] = $request->hospital_id;
            $bookingData['date'] = $request->date;
            $bookingData['time'] = $request->time;
            $bookingData['status']='pending';
            $bookingData['created_by']=$request->user_id;
            $appintmentSchedule->create($bookingData);

            return created($appintmentSchedule,"Appointment Successful");
        }
    }

    public function getAppointmentListByHospital($profileId)
    {
        if($profileId!=null){
            $appointments = Booking::where('booking_in',$profileId)->with('patient','creator')->get();
            return ok($appointments);
        }
        return bad('invalid Id');
    }

    public function getAppointment($id)
    {
        if($id!=null){
            $appointments = Booking::find($id)->with('patient','creator')->first();
            return ok($appointments);
        }
        return bad('invalid Id');
    }

    public function getAppointmentByUser($userId)
    {
        if($userId!=null){
            $appointments = Booking::where('created_by',$userId)->with('patient','creator')->get();
            return ok($appointments);
        }
        return bad('invalid Id');
    }

    public function acceptAppointment($id)
    {
        if($id!=null){
            $appointments = Booking::find($id)->first();
            $appointments->update([
                'status'=>'confirmed',
            ]);
            return ok($appointments);
        }
        return bad('invalid Id');
    }

    public function cancelAppointment($id)
    {
        if($id!=null){
            $appointments = Booking::find($id)->first();
            $appointments->update([
                'status'=>'cancel',
            ]);
            return ok($appointments);
        }
        return bad('invalid Id');
    }


}
