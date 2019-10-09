@extends('layouts.app')

@section('title', 'Competition List')

@section('content')
<h3 class="d-inline text-info mb-5">List of Competitions
  <a class="float-right btn btn-outline-primary" href="{{route('competitions.create')}}">
  Create New Competition
  </a>
</h3>
<div class="py-3"></div> 
<table class="table table-striped dataTable">
  <thead>
    <th scope="col">#</th>
    <th scope="col">Station</th>
    <th scope="col">Competition Name</th>
    <th scope="col">Status</th>
    <th scope="col">Type</th>
    <th scope="col">Start Date</th>
    <th scope="col">End Date</th>
    <th class="text-center" scope="col">View</th>
  </thead>
  <tbody>
    @foreach($competitions as $competition)
    <tr>
      <td>{{$competition->id}}</td>
      <td>{{$competition->getStation()}}</td>
      <td>{{$competition->name}}</td>
      <td>{{$competition->getStatus()}}</td>
      <td>{{$competition->getType()}}</td>
      <td>{{$competition->getFormattedStartDate()}}</td>
      <td>{{$competition->getFormattedEndDate()}}</td>
      <td class="text-center">
        <a href="{{route('competitions.show', $competition->id)}}"><i class="fa fa-eye text-info"></i></a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection