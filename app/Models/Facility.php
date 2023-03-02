<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type','description','created_by'];
	protected $dates = ['created_at', 'updated_at','deleted_at'];

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
}
