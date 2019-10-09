<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Listener_Prize;

class Prize extends Model
{
  protected $fillable = ['name', 'amount', 'description', 'priority'];

  public function competition(){
    return $this->belongsTo('App\Competition');
  }

  public function listeners(){
    return $this->belongsToMany('App\Listener')->using('App\Listener_Prize')->withPivot('user_id', 'competition_id', 'status');
  }

  public function getAvailablePrize(){
    return $this->amount - Listener_Prize::where('prize_id', $this->id)->get()->count();
  }
}
