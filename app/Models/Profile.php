<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Profile extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['user_id', 'contact_person', 'phone', 'email', 'alt_number', 'org_name', 'reg_number', 'website_id', 'type', 'speciality_type','speciality_id','description', 'facility_id', 'amenity_id', 'feature_id','created_by','address','state_id','city_id','postcode','latitude','longitude','is_active'];
	protected $dates = ['created_at', 'updated_at','deleted_at'];

    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }
    //here is many to one polymorph
    public function profileAvtar()
    {
        return $this->morphOne(AssetFile::class, 'pictureable','model_type', 'model_id');
    }

    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function wallet()
    {
        return $this->morphMany(Wallet::class, 'walletable','model_type', 'model_id');
    }

    public function withdrawrequest()
    {
        return $this->morphMany(WithdrawRequest::class, 'withdrable','model_type', 'model_id');
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class,'speciality_id');
    }
}
