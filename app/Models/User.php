<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    public function groups(){
        return $this->belongsToMany(Subject::class)->withPivot(['group']);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class);
    }

    public function user_bookings(){
        return $this->hasMany(UserBooking::class);
    }

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'enabled',
        'email',
        'password'
    ];

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

       //agregado
       public function getJWTIdentifier()//identificador que se almacenara en el token jwt
       {
           return $this->getKey();
       }
   
       /**
        * Return a key value array, containing any custom claims to be added to the JWT.
        *
        * @return array
        */
       public function getJWTCustomClaims()//los reclamos 
       {
           return [];
       }

}
