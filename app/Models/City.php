<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'state_id'];
	protected $dates = ['created_at', 'updated_at'];

    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
}
