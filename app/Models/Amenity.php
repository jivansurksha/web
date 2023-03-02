<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Amenity extends Model
{
    use Notifiable;
    use HasFactory;
    protected $fillable = ['name', 'type','description','created_by'];
	protected $dates = ['created_at', 'updated_at','deleted_at'];

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
}
