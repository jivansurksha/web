<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'review','likes','created_by'];
	protected $dates = ['created_at', 'updated_at'];

    public function hospital(){
        return $this->belongsTo(Profile::class,'profile_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
}
