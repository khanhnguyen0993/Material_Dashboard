@extends('layouts.app')

@section('title', 'Listener History')

@section('content')
<h3>Listener History</h3>
<hr>
<table class="table table-striped dataTable">
  <thead>
    <th style="width: 25%;" scope="col">Date</th>
    <th style="width: 25%;" scope="col">Edit By</th>
    <th style="width: 50%;" scope="col">Update</th>
  </thead>
  <tbody>
    @foreach ($listenerHistories as $history)
      <tr>
        <td>{{$history->getFormattedDate()}}</td>
        <td>{{$history->getAdmin()}}</td>
        <td>{!!$history->getUpdate()!!}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection