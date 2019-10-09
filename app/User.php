<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Constants\Translation;

class User extends Authenticatable
{
  use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name', 'email', 'password', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
      'email_verified_at' => 'datetime',
    ];

    public function getType(){
      $adminType;
      if ($this->type == Translation::USER_2CA) {
        $adminType = Translation::USER_2CA_TXT;
      } else if ($this->type == Translation::USER_2CC){
        $adminType = Translation::USER_2CC_TXT;
      } else {
        $adminType = Translation::USER_ADMIN_TXT;
      }
      return $adminType;
    }

    // Comment this line -> create user by db:seed
    public function setPasswordAttribute($value){
      $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    // convert the first character to uppercase
    public function setName($value){
      $this->attributes['name'] = ucwords($value);
    }

    public function competitions(){
      return $this->hasMany('App\Competition');
    }

    public function checkEditRight($id){
      return Auth::user()->type == Translation::USER_ADMIN || Auth::user()->id == $id;
    }

}
