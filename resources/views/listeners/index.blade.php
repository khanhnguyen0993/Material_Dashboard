@extends('layouts.app')
@section('title', 'Listener List')
@section('content')
<h3 class="d-inline text-info mb-3">List of Listeners
  <a class="float-right btn btn-outline-primary" href="{{route('listeners.create')}}">
    <i class="fa fa-user-plus" aria-hidden="true"></i> Create New Listener
  </a>
</h3>
<div class="py-3"></div> 
<table class="table table-striped dataTable">
  <thead>
    <th scope="col">Listener Name</th>
    <th scope="col">Email</th>
    <th scope="col" class="text-center">Participations</th>
    <th scope="col">Suburb</th>
    <th scope="col" class="text-center">More Info</th>
  </thead>
  <tbody>
    @foreach ($listeners as $listener)
      <tr>
        <th>{{$listener->firstName}}</th>
        <td>{{$listener->email}}</td>
        <td class="text-center">{{$listener->participations}}</button></td>
        <td>{{$listener->suburb}}</td>
        <td class="text-center"><a href="{{route('listeners.show', $listener->id)}}"><i class="fa fa-info-circle fa-lg text-info"></i></a></td>
      </tr>
    @endforeach
  </tbody>
</table>
<div>
  <a class="btn btn-outline-primary d-block float-left" href="{{ route('export') }}"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp; Export Listeners</a>
</div>
<!-- <a class="btn btn-outline-primary float-left mr-4" href="{{ route('import') }}"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp; Import Listener</a> -->
<!-- 
{!! Form::open(['action'=>'ListenersController@import', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
  {{ Form::file('upload', ['class'=>'btn btn-primary'])}}
  {{ Form::button('<i class="fa fa-upload" aria-hidden="true">&nbsp;&nbsp; Import Listeners</i>', ['type' => 'submit', 'class' => 'btn btn-outline-primary'] )  }}
{!! Form::close() !!}
 -->

@endsection