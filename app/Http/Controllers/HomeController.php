<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listener;
use App\Competition;
use App\CompetitionHistory;
use App\ListenerHistory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $totalListeners = Listener::all()->count();
      $totalCompetitions = Competition::all()->count();
      $recentActivities = CompetitionHistory::latest('updated_at')->take(3)->get();
      $listenerRecentActivities = ListenerHistory::latest('updated_at')->take(3)->get();
      return view('dashboard', compact('totalListeners', 'totalCompetitions', 'recentActivities', 'listenerRecentActivities'));
    }
}
