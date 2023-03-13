<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPUnit\Framework\Constraint\Count;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['first_name', 'last_name', 'user_name','email','gender','password','is_admin', 'state_id','city_id','user_type'];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];


    //here is many to one polymorph
    public function userAccount()
    {
        return $this->morphOne(BankAccount::class, 'accountable');
    }

    //general relationship
    public function role(){
        return $this->belongsTo(Role::class,'role_id');
    }

    public function creator(){
        return $this->belongsTo(self::class,'parent_id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }

	public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

    //here is many to one polymorph
    public function userAvtar()
    {
        return $this->morphOne(AssetFile::class, 'pictureable');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

     /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

     /**
	 * The name of the "created at" column.
	 *
	 * @var string|null
	 */
	const CREATED_AT = 'created_at';

	/**
	 * The name of the "updated at" column.
	 *
	 * @var string|null
	 */
	const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';
}
