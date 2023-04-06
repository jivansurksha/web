<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientBill extends Model
{
    use HasFactory;
    protected $fillable = ['raised_by', 'raised_to','booking_id','bill_amount','raised_date','raised_time','payment_mode','transection_id','paid_amount','status','description','paid_date','paid_time','commission'];
	protected $dates = ['created_at', 'updated_at'];

    public function billBy(){
        return $this->belongsTo(Profile::class,'raised_by');
    }

    public function billTo(){
        return $this->belongsTo(User::class,'raised_to');
    }

    public function booking(){
        return $this->belongsTo(Booking::class,'booking_id');
    }


}
