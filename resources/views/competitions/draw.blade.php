@extends('layouts.app')

@section('content')
<h4>Lucky Draw <a href="{{route('competitions.show', $competition_id)}}" class="text-info float-right"><i class="fa fa-arrow-left text-primary"></i> Go back</a></h4>
<hr>
<table class="table table-striped dataTable">
  <thead>
    <th style="width: 50%;" scope="col">Participant Name</th>
    <th style="width: 50%;" scope="col">Prize Won</th>
  </thead>
  <tbody>
    @foreach($winners as $winner)
      @foreach($winner->prizes as $prize)
        @if($prize->competition_id == $competition_id)
        <tr>
          <td><a class="text-info" href="{{route('listeners.show', $winner->id)}}">{{$winner->firstName}}</a></td>
          <td><i>{{$prize->name}}</i></td>
        </tr>
        @endif
      @endforeach
    @endforeach
  </tbody>
</table>
@endsection