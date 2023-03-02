<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['user_type', 'model_id','model_type','account_holder_name','account_number','bank_name','branch_name','ifsc_code','is_active','created_by'];
	protected $dates = ['created_at', 'updated_at'];

    //here is polymorph relation to profile or user
    public function accountable()
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
}
