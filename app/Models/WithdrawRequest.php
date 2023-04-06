<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;
    protected $fillable = ['model_id', 'model_type','request_amount','status','description'];
	protected $dates = ['created_at', 'updated_at'];

    public function withdrable()
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }

}
