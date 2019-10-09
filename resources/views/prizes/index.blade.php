@extends('layouts.app')

@section('content')
<!-- 
<table class="table table-striped">
  <thead>
    <th style="width: 30%;" scope="col">Name</th>
    <th style="width: 10%;" scope="col">Amount</th>
    <th style="width: 40%;" scope="col">Description</th>
    <th style="width: 20%;" scope="col" class="text-center">Option</th>
  </thead>
  <tbody>
    @foreach($prizes as $prize)
    <tr>
      <td>{{$prize->name}}</td>
      <td>{{$prize->amount}}</td>
      <td>{{$prize->description}}</td>
      <td>
        <div class="form-row">
          <div class="col">
            <a class="btn btn-sm btn-outline-secondary btn-block" href="{{route('prizes.edit', ['competition_id'=>$competition_id,'id'=>$prize->id])}}">Edit</a> 
          </div>
          <div class="col">
            {!! Form::open(['action'=>['PrizesController@destroy', 'competition_id'=>$competition_id, 'id'=>$prize->id], 'method'=>'POST']) !!}
            {{ Form::bsSubmit('Delete', ['class'=>'btn btn-sm btn-outline-secondary btn-block'])}}
            {{ Form::hidden('_method', 'DELETE')}}
            {!! Form::close() !!}
          </div>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{Translation::STATION_2CA}}
<div class="float-right">
  {{$prizes->links()}}
</div> -->
@endsection