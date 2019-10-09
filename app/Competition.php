<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Constants\Translation;
use App\CompetitionHistory;
use Nicolaslopezj\Searchable\SearchableTrait;


class Competition extends Model
{
  use SearchableTrait;

  protected $searchable = [
    'columns' => [
      'name' => 10,
    ],
  ];

  protected $fillable = ['name', 'station', 'type', 'status', 'description', 'startDate', 'endDate', 'user_id', 'listener_id', 'drawn'];

  public function user(){
    return $this->belongsTo('App\User');
  }

  public function listeners(){
    return $this->belongsToMany('App\Listener');
  }

  public function prizes(){
    return $this->hasMany('App\Prize');
  }

  public function competitionHistories(){
    return $this->hasMany('App\CompetitionHistory');
  }

  public function getFormattedStartDate(){
    return date('d/m/Y', strtotime($this->startDate));
  }

  public function getFormattedEndDate(){
    return date('d/m/Y', strtotime($this->endDate));
  }

  public function setStartDateAttribute($value){
    $showedOnPageFormat = 'd/m/Y';
    $databaseFormat = 'Y-m-d';
    $this->attributes['startDate'] = Carbon::hasFormat($value, $databaseFormat) ? $value :
    Carbon::createFromFormat($showedOnPageFormat, $value)->format($databaseFormat);
  }

  public function setEndDateAttribute($value){
    $showedOnPageFormat = 'd/m/Y';
    $databaseFormat = 'Y-m-d';
    $this->attributes['endDate'] = Carbon::hasFormat($value, $databaseFormat) ? $value :
    Carbon::createFromFormat($showedOnPageFormat, $value)->format($databaseFormat);
  }

  public function getStatus(){
    return $this->status == Translation::STATUS_CLOSED ? Translation::STATUS_CLOSED_TXT : Translation::STATUS_OPEN_TXT;
  }

  public function getStation(){
    $station = '';
    switch ($this->station) {
      case Translation::STATION_2CA:
        $station = Translation::STATION_2CA_TXT; break;
      case Translation::STATION_2CC:
        $station = Translation::STATION_2CC_TXT; break;
      default:
        # code...
      break;
    }
    return $station;
  }

  public function getType(){
    $type = '';
    switch ($this->type) {
      case Translation::TYPE_INSTANT_WIN:
        $type = Translation::TYPE_INSTANT_WIN_TXT; break;
      case Translation::TYPE_LUCKY_DRAW:
        $type = Translation::TYPE_LUCKY_DRAW_TXT; break;
      case Translation::TYPE_BIRTHDAY_WILL:
        $type = Translation::TYPE_BIRTHDAY_WILL_TXT; break;
      case Translation::TYPE_CASH_PRIZE:
        $type = Translation::TYPE_CASH_PRIZE_TXT; break;
      default:
        $type = 'Unknown';
      break;
    }
    return $type;
  }


}
