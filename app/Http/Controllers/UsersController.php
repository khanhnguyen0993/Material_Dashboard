<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Constants\Translation;

class UsersController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function index()
  {
    $users = User::all();
    return view('users_admins.index', compact('users'));
  }

  public function create(){
    return Auth::user()->type==Translation::USER_ADMIN ? view('users_admins.create'):redirect('users')->with('error', 'Please contact the admin to create any users');
  }

  public function store(){
    try {
      User::create(request()->validate([
        'name' => 'required|min:3|max:50',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'type' => 'required']));
    } catch (Exception $e) {
      return $e;
    }
    return redirect('users');
  }
  
  public function show(Request $request, User $user){
    if ($request->ajax()){
      if ($request->wantsJson()) {
        return response()->json([
          'name'  => $user->name,
          'email' => $user->email,
          'type'  => $user->type,
          'editRight' => $user->checkEditRight($user->id)
        ]);
      } 
    }
    return view('users.index');
  }

  public function edit(User $user){
    return Auth::user()->type==Translation::USER_ADMIN ? view('users_admins.edit', compact('user')):redirect('users')->with('error', 'Update error. Please contact the admin.');
  }

  public function update(Request $request, User $user){
    if (Auth::user()->type==Translation::USER_ADMIN) {
      if ($request->ajax()){
        $data = $request->get('data');
        $user->update((new Request([
          'name' => $data['name'],
          'email' => $data['email'],
          'type'  => $data['type']
        ]))->validate([
          'name' => 'required|min:3|max:50',
          'email' => 'required|email',
          'type' => 'required'
        ])); 
      }
      return;
    } else {
      return redirect('users')->with('error', 'Cannot update. Please contact the admin.');
    }
  }

  public function destroy(User $user){
    if (Auth::user()->type==Translation::USER_ADMIN) {
      $user->delete();
      return;
    } else {
      return redirect('users')->with('error', 'Please contact the admin to create any admin users');
    }
  }
}
