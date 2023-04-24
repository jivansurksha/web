<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Booking extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['patient_id', 'booking_in','status','cancel_reason','net_amount','admit_date','admit_time','discharge_date','discharge_time','discharge_summery','date','time','created_by'];
	protected $dates = ['created_at', 'updated_at'];

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function hospital(){
        return $this->belongsTo(Profile::class,'booking_in');
    }
}
