<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prize;
use App\Competition;

class PrizesController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  // public function index(){
    
  // }

  public function create($competition_id){
    $competition = Competition::findOrFail($competition_id);
    return view('prizes.create', compact('competition'));
  }

  public function store($competition_id, Prize $prize){
    Competition::findOrFail($competition_id)->prizes()->create(request()->validate([
      'name'        => 'required',
      'amount'      => ['required', 'numeric'],
      'description' => 'required',
      'priority'    => ''
    ]));
    return redirect('competitions/'.$competition_id)->with('success', 'Prize has been added.');
  }

  public function edit($competition_id, $prize_id){
    $prize = Prize::findOrFail($prize_id);
    return view('prizes.edit', compact('prize'));
  }

  public function update(Request $request, $competition_id, Prize $prize){
    $prize->update(request()->validate([
      'name'        => 'required',
      'amount'      => ['required', 'numeric'],
      'description' => 'required',
      'priority'    => ''
    ]));
    return redirect('competitions/'.$competition_id)->with('success', 'Prize has been updated.');
  }

  public function destroy($competition_id, $prize_id){
    $prize = Prize::findOrFail($prize_id);
    if ($prize->amount == $prize->getAvailablePrize()) {
      $prize->delete();
      return redirect('competitions/'.$competition_id)->with('success', 'Prize has been removed.');
    } else {
      return redirect('competitions/'.$competition_id)->with('error', 'Listeners are attached to this prize.');
    }
  }
}
