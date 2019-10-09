@extends('layouts.app')

@section('title', 'Competition View')
@section('content')
<h3 class="d-inline">{{$competition->name}}
  @if($userType == $competition->station || $userType == Translation::USER_ADMIN)
    - <a href="{{route('competitions.edit', $competition->id)}}" class="text-info">Edit </a>
  @endif
  <a class="float-right btn btn-outline-primary" href="{{route('listeners.create')}}">
    <i class="fa fa-user-plus" aria-hidden="true"></i> Create New Listener
  </a>
</h3> 

<table class="table table-striped table-borderless mt-3">
  <thead class="thead-dark">
    <th scope="col">Title</th>
    <th scope="col">Station</th>
    <th scope="col">Type</th>
    <th scope="col">Status</th>
    <th scope="col">Description</th>
    <th scope="col">Start Date</th>
    <th scope="col">End Date</th>
    <th scope="col" class="text-center">History</th>
  </thead>
  <tbody>
    <tr>
      <th>{{$competition->name}}</th>
      <td>{{$competition->getStation()}}</td>
      <td>{{$competition->getType()}}</td>
      <td>{{$competition->getStatus()}}</td>
      <td>{{$competition->description}}</td>
      <td>{{$competition->getFormattedStartDate()}}</td>
      <td>{{$competition->getFormattedEndDate()}}</td>
      <td class="text-center"><a href="{{route('competitionHistory', $competition->id)}}" target="_blank"><i class="fa fa-history text-info" aria-hidden="true"></i></a></td>
    </tr>
  </tbody>
</table>
<hr>
 
@if($competition->type != Translation::TYPE_CASH_PRIZE)
  @include('inc.prizesInCompetition')
@endif
<hr>

@include('inc.participantsInCompetition')

@if($competition->type == Translation::TYPE_LUCKY_DRAW)
<a href="{{route('draw', $competition->id)}}" class="btn btn-outline-primary mr-3">{{$competition->drawn?"Results":"Draw"}}</a>
@endif
<a class="btn btn-outline-primary" href="{{ route('exportWinners', $competition->id) }}"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp; Export Winners</a>

@include('inc.deleteConfirmationModal')

@endsection