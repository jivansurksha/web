<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileBranch extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id ', 'is_primary', 'contact_person', 'phone', 'address', 'state_id', 'city_id', 'postcode', 'latitude', 'longitude', 'is_active', 'asset_file_id','created_by'];
	protected $dates = ['created_at', 'updated_at','deleted_at'];

    //here is many to one polymorph
    public function profileAccount()
    {
        return $this->morphOne(BankAccount::class, 'accountable');
    }

    public function profile(){
        return $this->belongsTo(Profile::class,'profile_id');
    }

    // public function country(){
    //     return $this->belongsTo(Country::class,'country_id');
    // }

    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }

	public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    //here is many to one polymorph
    public function profileAvtar()
    {
        return $this->morphMany(AssetFile::class, 'pictureable');
    }
}
