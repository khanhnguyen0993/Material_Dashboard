<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Constants\Translation;
use App\Prize;
use App\Listener;

class Listener_Prize extends Pivot
{
  public $incrementing = true;
  public $table = "listener_prize";
  
  public function getUsername(){
    return 'App\User'::findOrFail($this->user_id)->name;
  }

  public function getStatus(){
    $status = '';
    switch ($this->status) {
      case Translation::HASWON_STATUS_AWAITING:
        $status = Translation::HASWON_STATUS_AWAITING_TXT; break;
      case Translation::HASWON_STATUS_COLLECTED:
        $status = Translation::HASWON_STATUS_COLLECTED_TXT; break;
      case Translation::HASWON_STATUS_ENROLLED:
        $status = Translation::HASWON_STATUS_ENROLLED_TXT; break;
      default:
        $status = Translation::HASWON_STATUS_NO_PRIZE_TXT; break;
    }
    return $status;
  }

  public function getPrize(){
    return is_null($this->prize_id) ? 'Lucky Draw' : Prize::findOrFail($this->prize_id)->name;
  }

  public function getPhone(){
    return Listener::findOrFail($this->listener_id)->phone;
  }

  public function getParticipant(){
    return Listener::findOrFail($this->listener_id)->firstName;
  }

}
