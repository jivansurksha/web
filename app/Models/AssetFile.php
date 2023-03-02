<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetFile extends Model
{
    use HasFactory;
    protected $fillable = ['model_id','model_type','filename', 'filetype','filepath','width','height','size','is_active'];
	protected $dates = ['created_at', 'updated_at'];

   //here is polymorph relation to profile or user
   public function pictureable()
   {
       return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
   }
}
