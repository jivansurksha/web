<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    protected $fillable = ['profile_id', 'is_flat_rate','flat_rate','percentage','is_active','created_by'];
	protected $dates = ['created_at', 'updated_at'];

    public function hospital(){
        return $this->belongsTo(Profile::class,'profile_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
}
