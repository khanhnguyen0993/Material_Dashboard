<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listener;
use App\ListenerHistory;
use Illuminate\Support\Facades\Auth;
use App\Exports\ListenersExport;
use App\Imports\ListenersImport;
use Maatwebsite\Excel\Facades\Excel;

class ListenersController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }

  public function index()
  {
    $listeners = Listener::all();
    return view('listeners.index', compact('listeners'));
  }

  public function create(){
    return view('listeners.create');
  }

  public function store(Request $request){
    if ($request->quickAddListener) {
      $listener = Listener::create(
        request()->validate([
          'firstName' => ['required', 'string', 'max:255'],
          'lastName' => ['required', 'string', 'max:255'],
          // 'DOB' => 'required',
          // 'email' => ['required', 'string', 'email', 'max:255'],
          'phone' => 'required',
          'suburb' => 'required',
          'additionalInfo' => []
        ])
      );
      $listener->histories()->create([
        'admin_id' => Auth::user()->id,
        'update' => 'Listener created',
        'date' => $listener->created_at
      ]);
      return back()->with('success', 'New Listener Created');
      // $listener = [
      //   'id' => $quickAddListener->id,
      //   'info' => $quickAddListener->firstName.' - '.$quickAddListener->phone
      // ];
      // return back()->with('listener', $listener);

    } else {
      $listener = Listener::create(
        request()->validate([
          'firstName' => ['required', 'string', 'max:255'],
          'lastName' => ['required', 'string', 'max:255'],
          'DOB' => 'required',
          'email' => [],
          'phone' => 'required',
          'suburb' => 'required',
          'additionalInfo' => []
        ])
      );
      $listener->histories()->create([
        'admin_id' => Auth::user()->id,
        'update' => 'Listener created',
        'date' => $listener->created_at
      ]);

    return redirect('listeners')->with('success', 'Listener Created');
    }
  }

  public function show($id){
    $listener = Listener::findOrFail($id);
    return view('listeners.show', compact('listener'));
  }

  public function edit(Listener $listener){
    return view('listeners.edit', compact('listener'));
  }

  public function update(Listener $listener){
    $original = $listener->getOriginal();
    $changesArr = [];

    $listener->update(request()->validate([
      'firstName' => ['required', 'string', 'max:255'],
      'lastName'  => ['required', 'string', 'max:255'],
      'DOB' => 'required',
      'email' => ['required', 'string', 'email', 'max:255'],
      'phone' => 'required',
      'suburb' => 'required',
      'additionalInfo' => []
    ]));

    // Track change
    $changesArr = $listener->getChanges();

    // Remove the updated_at
    unset($changesArr['updated_at']);

    // Convert to string to match the update field
    $changes = '';
    foreach ($changesArr as $key => $value) {
      $changes .= 'Updated field '.$key.' to '.$value.'. ';
    }
    $listener->histories()->create([
      'admin_id' => Auth::user()->id,
      'update' => $changes,
      'listener_id' => $listener->id,
      'date' => $listener->updated_at
    ]);

    return redirect('listeners')->with('success', 'Listener Updated');
  }

  public function destroy(Listener $listener){
    $listener->competitions()->detach();
    $listener->prizes()->detach();
    $listener->delete();
    return redirect('listeners')->with('success', 'Listener Deleted');
  }

  public function getHistory($id){
    $listenerHistories = ListenerHistory::where('listener_id', $id)->get();
    return view('listeners.history', compact('listenerHistories'));
  }

  public function export(){
    return Excel::download(new ListenersExport, 'listeners.csv');
  }

  public function import(){
    if(request()->has('upload')){
      request()->validate([
        'upload' => 'required | mimes: csv,txt'
      ]);
      Excel::import(new ListenersImport, request()->file('upload'));
      return back();  
    } else {
      return back()->with('error', 'Please choose the file');
    }
    
    
  }
}
