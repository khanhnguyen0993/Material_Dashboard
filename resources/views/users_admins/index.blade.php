@extends('layouts.app')
@section('content')
<table id="userTable" class="table table-striped dataTable" style="table-layout: fixed;">
  <thead>
    <th style="width: 30%;" scope="col">Admin Name</th>
    <th style="width: 30%;" scope="col">Email</th>
    <th style="width: 20%;" scope="col">Type</th>
    <th style="width: 20%;" scope="col" class="text-center">More Info</th>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->getType()}}</td>
      <td class="text-center"><a href="#" data-id="{{$user->id}}" data-toggle="modal" data-target="#userModal" class="adminInfo ml-3 text-info"><i class="fa fa-info-circle fa-lg"></i></a></td>
    </tr>
    @endforeach
  </tbody>
</table>

<!-- Modal -->
@include('inc.userModal')

@endsection