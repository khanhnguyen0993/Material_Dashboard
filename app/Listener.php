<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Competition;
use App\User;


class Listener extends Model
{
  use SearchableTrait;

  protected $searchable = [
    'columns' => [
      'firstName' => 10,
      'phone' => 10
    ]
  ];

  protected $fillable = [
    'firstName', 'lastName','DOB', 'email', 'phone', 'suburb', 'additionalInfo', 'user_id'
  ];

  public function getFormattedDate(){
    return date('d/m/Y', strtotime($this->DOB));
  }

  // Comment this to run seeder
  public function setDOBAttribute($value){
    $showedOnPageFormat = 'd/m/Y';
    $databaseFormat = 'Y-m-d';
    $this->attributes['DOB'] = Carbon::hasFormat($value, $databaseFormat) ? $value :
    Carbon::createFromFormat($showedOnPageFormat, $value)->format($databaseFormat);
  }
  
  // convert the first character to uppercase
  public function setFirstNameAttribute($value){
    $this->attributes['firstName'] = ucwords($value);
  }

  public function setLastNameAttribute($value){
    $this->attributes['lastName'] = ucwords($value);
  }

  public function setSuburbAttribute($value){
    $this->attributes['suburb'] = ucwords($value);
  }
  
  // ============== RELATIONSHIPS ==============//  
  public function histories(){
    return $this->hasMany('App\ListenerHistory', 'listener_id');
  }

  public function competitions(){
    return $this->belongsToMany('App\Competition');
  }

  public function prizes(){
    return $this->belongsToMany('App\Prize')->using('App\Listener_Prize')->withPivot('user_id', 'competition_id', 'status');
  }

  public function getUsername(){
    return User::findOrFail($this->user_id)->name;
  }

}
