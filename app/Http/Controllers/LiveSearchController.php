<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listener;
use App\Competition;

class LiveSearchController extends Controller
{
  public function searchListener(Request $request){
    if($request->ajax()){
      return Response (Listener::findOrFail($request->get('query')));
    }
  }

  public function find(Request $request){
    $listeners = Listener::search($request->get('q'))->get();
    $competitions = Competition::search($request->get('q'))->get();
    $info = [];
    foreach ($listeners as $listener) {
      $info[] = array(
        'id' => $listener->id,
        'name' => $listener->firstName,
        'extension' => 'Listener',
        'url' => "/listeners/".strval($listener->id)
      );
    }
    foreach ($competitions as $competition) {
      $info[] = array(
        'id' => $competition->id,
        'name' => $competition->name,
        'extension' => 'Competition',
        'url' => "/competitions/".strval($competition->id)
      );
    }
    return json_encode($info);
  }
}

