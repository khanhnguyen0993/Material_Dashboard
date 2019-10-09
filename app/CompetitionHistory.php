<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Competition;

class CompetitionHistory extends Model
{
  protected $fillable = ['competition_id', 'update', 'date', 'user_id'];

  public function listener(){
    return $this->belongsTo('App\Competition');
  }

  public function getFormattedDate(){
    return date('d/m/Y', strtotime($this->date));
  }

  public function getAdmin(){
    return User::findOrFail($this->user_id)->name;
  }


  public function getUpdate(){
    $update = $this->update;
    if ($update == 'Competition created') {
      $update = 'Competition created. <br>';
    } else {
      $update = $this->update;
      $update = str_replace("name", "<strong>Title</strong>", $update);
      $update = str_replace("station", "<strong>Station</strong>", $update);
      $update = str_replace("type", "<strong>Type</strong>", $update);
      $update = str_replace("status", "<strong>Status</strong>", $update);
      $update = str_replace("startDate", "<strong>Start Date</strong>", $update);
      $update = str_replace("endDate", "<strong>End Date</strong>", $update);
      $update = str_replace(".",".<br>", $update);
    }
    return $update;
  }
}
