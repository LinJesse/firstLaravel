<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Users as Authenticatable;

class Users extends Authenticatable implements JWTSubject
{
    use Notifiable;
    //use HasFactory;
    public $timestamps = false;
    public $table = 'users';
       
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'user_account_id'
    ];

    public function getJWTIdentifier()
      {
          return $this->getKey();
      }

      public function getJWTCustomClaims()
      {
          return [];
      }

}