<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = ['model_id', 'model_type','type','amount','withdraw_request_id','purpose','balance_amount'];
	protected $dates = ['created_at', 'updated_at'];

    public function walletable()
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }

    public function withdrawRequest(){
        return $this->belongsTo(WithdrawRequest::class,'withdraw_request_id');
    }
}
