<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'booking_in','booking_for','status','date','time','created_by'];
	protected $dates = ['created_at', 'updated_at'];

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

}
