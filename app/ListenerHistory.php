<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ListenerHistory extends Model
{
  protected $fillable = ['admin_id', 'update', 'date', 'listener_id'];

  public function listener(){
    return $this->belongsTo('App\Listener');
  }

  public function getFormattedDate(){
    return date('d/m/Y', strtotime($this->date));
  }

  public function getAdmin(){
    return User::findOrFail($this->admin_id)->name;
  }


  public function getUpdate(){
    $update = $this->update;

    if ($update == 'Listener created') {
      $update = 'Listener created. <br>';
    } else {
      $update = str_replace("firstName", "<strong>First Name</strong>", $update);
      $update = str_replace("lastName", "<strong>Last Name</strong>", $update);
      $update = str_replace("DOB", "<strong>Date of Birth</strong>", $update);
      $update = str_replace("email", "<strong>Email</strong>", $update);
      $update = str_replace("phone", "<strong>Phone</strong>", $update);
      $update = str_replace("suburb", "<strong>Suburb</strong>", $update);
      $update = str_replace("participations", "<strong>Participations</strong>", $update);
      $update = str_replace("additionalInfo", "<strong>Additional Information</strong>", $update);
      $update = str_replace(".",".<br>", $update);
    }
    return $update;
  }
}
