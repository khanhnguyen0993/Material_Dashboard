<?php

namespace App\Exports;

use App\Listener;
use App\Listener_Prize;
use App\Competition;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WinnersExport implements FromCollection, WithHeadings
{
    protected $competition_id = null;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($competition_id){
      $this->competition_id = $competition_id;
    }
    public function collection()
    {
      // $listeners = Competition::find($this->competition_id)->listeners()->has('prizes')->get();
      //$listener_prize = Listener_Prize::where('competition_id', $this->competition_id)->select('listener_id')->get()->toArray();

      $listener_prize_list = Listener_Prize::where('competition_id', $this->competition_id)->get();
      // $winners = $listeners->filter(function($listener){
      //   return $listener->has('prizes');
      // });
      $winners = [];
      foreach ($listener_prize_list as $winner) {
        $winners[] = array(
          'First Name' => $winner->getParticipant(),
          'Phone' => $winner->getPhone(),
          'Prize' => $winner->getPrize()
        );
      }
      return collect($winners);
      // return Listener::has('prizes')->select('id', 'firstName', 'lastName', 'DOB', 'Email', 'Phone')->get();
    }

    public function headings():array{
      return [
        'First Name',
        'Phone',
        'Prize'
      ];
    }

}
