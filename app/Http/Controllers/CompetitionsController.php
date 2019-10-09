<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;
use App\CompetitionHistory;
use Illuminate\Support\Facades\Auth;
use App\Listener;
use App\Prize;
use App\Listener_Prize;
use App\Exports\WinnersExport;
use App\Constants\Translation;
use Carbon\Carbon;

use Maatwebsite\Excel\Facades\Excel;

class CompetitionsController extends Controller
{
  private $currentUser;

  public function __construct(){
    $this->middleware('auth');
    $this->middleware(function ($request, $next) {
      $this->currentUser = Auth::user();
      return $next($request);
    });
  }

  public function index(){
    $competitions = Competition::all();
    $userType = $this->currentUser->type;
    return view('competitions.index', compact('competitions', 'userType'));
  }

  public function create(){
    $userType = $this->currentUser->type;
    return view('competitions.create', compact('userType'));
  }

  public function store(){
    $competition = $this->currentUser->competitions()->create(request()->validate([
      'name'      => 'required',
      'station'   => 'required',
      'type'      => 'required',
      'status'    => 'required',
      'startDate' => 'required',
      'endDate'   => 'required',
    ]));

    $competition->competitionHistories()->create([
      'user_id' => $this->currentUser->id,
      'update' => 'Competition created',
      'date' => $competition->created_at
    ]);
    return redirect('competitions')->with('success', 'Competition Added');
  }

  public function show(Competition $competition){
    $prizeList = $competition->prizes;
    $userType = $this->currentUser->type;
    
    if ($competition->type == Translation::TYPE_LUCKY_DRAW && $competition->drawn) {
      $participants = $competition->listeners()->has('prizes')->get()->unique();
    } else {
      $participants = $competition->listeners()->get();
    }
    
    return view('competitions.show', compact('competition', 'prizeList', 'participants', 'userType'));
  }

  public function edit(Competition $competition){
    $userType = $this->currentUser->type;
    return $userType == $competition->station || $userType == Translation::USER_ADMIN ?
      view('competitions.edit', compact('competition', 'userType')):
      redirect('competitions')->with('error', 'Please contact to the admin at the right station.');
  }

  public function update(Competition $competition){
    if ($this->currentUser->type == $competition->station || $this->currentUser->type == Translation::USER_ADMIN) {
      $original = $competition->getOriginal();
      $changesArr = [];
      $competition->update(request()->validate([
        'name'      => 'required',
        'station'   => 'required',
        'type'      => 'required',
        'status'    => 'required',
        'startDate' => 'required',
        'endDate'   => 'required',
      ]));

      // Track change
      $changesArr = $competition->getChanges();
      // Remove the updated_at
      unset($changesArr['updated_at']);
      $changes = '';
      foreach ($changesArr as $key => $value) {
        switch ($key) {
          case "station":
            $value = $value == Translation::STATION_2CA ? Translation::STATION_2CA_TXT : Translation::STATION_2CC_TXT; break;
          case "status":
            $value = $value == Translation::STATUS_OPEN ? Translation::STATUS_OPEN_TXT: Translation::STATUS_CLOSED_TXT; break;
          case "type":
            switch ($value) {
              case Translation::TYPE_INSTANT_WIN:
                  $value = Translation::TYPE_INSTANT_WIN_TXT;
                break;
              case Translation::TYPE_LUCKY_DRAW:
                  $value = Translation::TYPE_LUCKY_DRAW_TXT;
                break;
              case Translation::TYPE_BIRTHDAY_WILL:
                  $value = Translation::TYPE_BIRTHDAY_WILL_TXT;
                break;
              case Translation::TYPE_CASH_PRIZE:
                  $value = Translation::TYPE_CASH_PRIZE_TXT;
                break;
              default:
                $value = Translation::TYPE_INSTANT_WIN_TXT;
                break;
            }
          default: 
          break;
        }
        $changes .= 'Updated field '.$key.' to '.$value.'. ';
      }
      
      // Convert to string to match the update field
      $history = $competition->competitionHistories()->create([
        'user_id' => $this->currentUser->id,
        'update' => $changes,
        'date' => $competition->created_at
      ]);
      return redirect('competitions/'.$competition->id)->with('success', 'Competition Updated Successfully');
    } else {
      return redirect('competitions/'.$competition->id)->with('error', 'Please contact to the admin at the right station.');
    }
  }

  public function destroy(Competition $competition){
    $competition->delete();
    return redirect('competitions')->with('success', 'Competition Deleted');
  }

  public function searchOrCreateListeners($id){
    $competition = $this->getCurrentCompetition($id);
    $prizeList = $competition->prizes;
    $listenerList = Listener::orderBy('firstName')->get();
    
    if ($competition->type == Translation::TYPE_BIRTHDAY_WILL) {
      $listenerList = $listenerList->filter(function($listener){
        return Carbon::parse($listener->DOB)->isBirthday();
      });
    }
    
    foreach($listenerList as $listener){
      $listeners[] = array(
        'id' => $listener->id,
        'info' => $listener->firstName.' - '.$listener->phone.' - '.$listener->email
      );
    }
    return view('competitions.addListeners', compact('competition', 'prizeList', 'listeners'));
  }

  public function getHistory($id){
    $competitionHistories = CompetitionHistory::where('competition_id', $id)->get();
    return view('competitions.history', compact('competitionHistories'));
  }

  public function draw($id){
    $competition = $this->getCurrentCompetition($id);
    if (!$competition->drawn) {
      $prizes = $competition->prizes()->orderBy('priority', 'DESC')->get();
      $winners = $competition->listeners()->has('prizes')->get();
      if (!$winners->isEmpty()) {
        // Remove all the relation between Listener & Prize
        foreach($prizes->pluck('id')->toArray() as $prize_id){
          $winners->each(function($participant) use($prize_id){
            $participant->prizes()->detach($prize_id);
          });
        }
      }
      // Draw the prizes
      $competition_id = $competition->id;
      $user_id = $this->currentUser->id;
      $participants = $competition->listeners;
      $shuffledParticipants = $participants->shuffle();
      $non_winners = $shuffledParticipants;
      foreach ($prizes as $prize) {
        $numOfPrizes = $prize->getAvailablePrize();
        $prize_id = $prize->id;
        $shuffledParticipants = $non_winners;
        $non_winners = $shuffledParticipants->splice($numOfPrizes);
        $winners = $shuffledParticipants;
        $winners->each(function($winner) use ($prize_id, $competition_id, $user_id){
          $winner->prizes()->attach($prize_id, ['competition_id'=>$competition_id, 'user_id'=>$user_id]);
        });
      };
      $competition->update(['drawn'=>1]);
    } 
    $winners = $competition->listeners()->has('prizes')->get()->unique();
    return view('competitions.draw', compact('winners'))->with('competition_id', $id);
  }

  public function addListenersToCompetition(Request $request){
    $competition = $this->getCurrentCompetition($request->competition_id);
    // if ($competition->listeners()->get()->contains($request->listener_id)) {
    //   return back()->with('error', 'Listener already exists');
    // } else {
      $listener = Listener::findOrFail($request->listener_id);
      $listener->update(['user_id' => $this->currentUser->id]);
      if ($competition->type == Translation::TYPE_INSTANT_WIN || $competition->type == Translation::TYPE_BIRTHDAY_WILL) {
        $listener->prizes()->attach($request->prize_id, ['status'=>$request->status, 'competition_id'=>$competition->id]);
      } elseif($competition->type == Translation::TYPE_CASH_PRIZE){
        request()->validate([
          'cash'      => ['required', 'numeric']
        ]);
        $prize = Prize::create([
          'name' => $request->cash,
          'amount' => 1,
          'description' => Translation::TYPE_CASH_PRIZE_TXT,
        ]);
        $competition->prizes()->save($prize);
        $listener->prizes()->attach($prize->id, ['status'=>$request->status, 'competition_id'=>$competition->id]);
      }
      $competition->listeners()->attach($listener);
    // }
    return redirect('competitions/'.$request->competition_id)->with('success', 'Listener has been added to the competition.');
  }

  public function editParticipant(Request $request, $competition_id, $listener_id){
    $competition = $this->getCurrentCompetition($competition_id);
    $participant = $competition->listeners()->findOrFail($listener_id);
    $prizeList = $competition->prizes;
    return view('competitions.editParticipant', compact('participant', 'competition', 'prizeList'));
  }

  public function updateParticipant(Request $request, $competition_id, $listener_id){
    $competition = $this->getCurrentCompetition($competition_id);
    $participant = $competition->listeners()->findOrFail($listener_id);
    foreach ($participant->prizes as $prize) {
      if($prize->competition_id == $competition->id){
        if($competition->type == Translation::TYPE_CASH_PRIZE){
          $prize->update(['name'=>$request->cash]);
          $prize->pivot->update(['status' => $request->status]);
        }else{
          $participant->prizes()->detach($prize->id);
          $participant->prizes()->attach($request->prize_id, ['status'=>$request->status]);
        }
      }
    }

    return redirect('competitions/'.$competition_id)->with('success', 'Listener has been updated.');
  }

  public function removeParticipant(Request $request, $competition_id, $listener_id){
    $listener = Listener::findOrFail($listener_id);
    $listener->competitions()->detach($competition_id);
    $listener->prizes()->detach($request->prize_id);
    return back();
  }

  //todo
  public function export($competition_id){
    return Excel::download(new WinnersExport($competition_id), 'winners.csv');
  }

  public function getCurrentCompetition($id){
    return Competition::findOrFail($id);
  }

}
