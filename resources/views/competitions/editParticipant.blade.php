@extends('layouts.app')
@section('content')
<h3>Competition: <a class="text-info" href="{{route('competitions.show', $competition->id)}}">{{$competition->name}}</a></h3>
<hr>

<table class="table table-striped" style="table-layout: fixed">
  <thead>
    <th style="width: 20%;" scope="col">Listener Name</th>
    <th style="width: 25%;" scope="col">Email</th>
    <th style="width: 20%;" scope="col">Participations</th>
    <th style="width: 20%;" scope="col">Suburb</th>
    <th style="width: 15%;" scope="col" class="text-center">More Info</th>
  </thead>
  <tbody>
    <td id="name">{{$participant->firstName}}</td>
    <td id="email">{{$participant->email}}</td>
    <td id="participation">{{$participant->participations}}</td>
    <td id="suburb">{{$participant->suburb}}</td>
    <td id="moreInfo" class="text-center"><a href="{{route('listeners.show', $participant->id)}}"><i class="fa fa-info-circle fa-lg text-info"></i></a></td>
  </tbody>
</table>
<hr>

{!! Form::open(['action'=>['CompetitionsController@updateParticipant', $competition->id, $participant->id], 'method'=>'POST']) !!}

<div class="form-row">
  @foreach($participant->prizes as $prize)
    @if($prize->competition_id == $competition->id)
    <div class="col-8">
      @if($competition->type != Translation::TYPE_CASH_PRIZE)
      <label for="selectedPrize">Select Prize </label>
      <select id="selectedPrize" class="form-control" name="prize_id">
        @foreach ($prizeList as $prizeItem)
        <option value="{{$prizeItem->id}}"
          {{$prize->id == $prizeItem->id?'selected':''}}
          >{{$prizeItem->name}} {{$competition->type != Translation::TYPE_CASH_PRIZE ? 
          "- ".$prizeItem->getAvailablePrize()." Left":
        ""}}</option>
        @endforeach
      </select>
      @else
      <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">$</span>
        </div>
        {{ Form::bsText('cash', old('cash', $prize->name),['required', 'id'=>'cashPrize', 'placeholder'=>'Amount of cash', 'autocomplete'=>'off'])}}
        <div class="input-group-append">
            <span class="input-group-text">.00</span>
        </div>
        <div class="invalid-feedback">Cash must be a number</div>
      </div>
      @endif
    </div>
    <div class="col-3 offset-1">
      @if($competition->type != Translation::TYPE_CASH_PRIZE)
      <label for="status">Status </label>
      @endif
      <select id="{{$competition->type != Translation::TYPE_CASH_PRIZE?'pickupStatus':''}}" class="form-control" name="status">
        <option value="{{Translation::HASWON_STATUS_AWAITING}}"
        {{$prize->pivot->status == Translation::HASWON_STATUS_AWAITING ?'selected':''}}
        >{{Translation::HASWON_STATUS_AWAITING_TXT}}</option>
        <option value="{{Translation::HASWON_STATUS_COLLECTED}}" 
        {{$prize->pivot->status == Translation::HASWON_STATUS_COLLECTED ?'selected':''}}
        >{{Translation::HASWON_STATUS_COLLECTED_TXT}}</option>
      </select>
    </div>
    @endif
  @endforeach
</div>
<hr>
{{ Form::hidden('_method', 'PUT')}}
{{ Form::submit('Update', ['class' => 'btn btn-outline-primary btn-block'])}}
{!! Form::close() !!}

@endsection