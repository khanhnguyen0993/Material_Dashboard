@extends('layouts.app')

@section('title', 'Competition History')

@section('content')
<h3>Competition History</h3>
<hr>
<table class="table table-striped dataTable">
  <thead>
    <th style="width: 25%;" scope="col">Date</th>
    <th style="width: 25%;" scope="col">Edit By</th>
    <th style="width: 50%;" scope="col">Update</th>
  </thead>
  <tbody>
    @foreach ($competitionHistories as $competition)
      <tr>
        <td>{{$competition->getFormattedDate()}}</td>
        <td>{{$competition->getAdmin()}}</td>
        <td>{!!$competition->getUpdate()!!}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection