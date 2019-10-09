@extends('layouts.app')
@section('content')
<h3>Competition: <a class="text-info" href="{{route('competitions.show', $competition->id)}}">{{$competition->name}}</a> <a class="float-right btn btn-outline-primary" href="{{route('listeners.create')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Create New Listener</a></h3>
<hr>
<h4>Add a new listener to {{$competition->name}}</h4>
@if($competition->type == Translation::TYPE_BIRTHDAY_WILL)
  <p class="text-muted">*Only those listeners who have their birthday is today will be listed in the search.</p>
@endif

<select id="searchListener" class="form-control mb-5" name="listener">
    <!-- <option value="" disabled selected>Select listener ...</option> -->
    <option></option>
    @foreach($listeners as $listener)
      <option value="{{$listener['id']}}">{{$listener['info']}}</option>
    @endforeach
</select>

<table class="table table-striped" style="table-layout: fixed">
  <thead>
    <th style="width: 30%;" scope="col">Listener Name</th>
    <th style="width: 30%;" scope="col">Phone</th>
    <th style="width: 20%;" scope="col">Suburb</th>
    <th style="width: 15%;" scope="col" class="text-center">Participant</th>
    <th style="width: 15%;" scope="col" class="text-center">MoreInfo</th>
  </thead>
  <tbody>
    <td id="name"></td>
    <td id="phone"></td>
    <td id="suburb"></td>
    <td class="text-center" id="participation"></td>
    <td class="text-center" id="moreInfo"></td>
  </tbody>
</table>
<hr>
  {!! Form::open(['action'=>['CompetitionsController@addListenersToCompetition', $competition->id], 'method'=>'POST']) !!}
  @if($competition->type == Translation::TYPE_INSTANT_WIN || $competition->type == Translation::TYPE_BIRTHDAY_WILL)
    <div class="form-row">
      <div class="col-8">
        <label for="selectedPrize">Select Prize </label>
        <select id="selectedPrize" class="form-control" name="prize_id">
          @foreach ($prizeList as $prizeItem)
            <option value="{{$prizeItem->id}}">{{$prizeItem->name}} - {{$prizeItem->getAvailablePrize()}} Left</option>
          @endforeach
        </select>
      </div>
      <div class="col-3 offset-1">
        <label for="status">Status </label>
        <select id="pickupStatus" class="form-control" name="status">
          <option value="{{Translation::HASWON_STATUS_AWAITING}}">{{Translation::HASWON_STATUS_AWAITING_TXT}}</option>
          <option value="{{Translation::HASWON_STATUS_COLLECTED}}">{{Translation::HASWON_STATUS_COLLECTED_TXT}}</option>
        </select>
      </div>
    </div>
  @elseif($competition->type == Translation::TYPE_CASH_PRIZE)
    <div class="form-row">
      <div class="col-8">
        <div class="input-group">
          <div class="input-group-prepend">
              <span class="input-group-text">$</span>
          </div>
          {{ Form::bsText('cash', old('cash', ''),['required', 'id'=>'cashPrize', 'placeholder'=>'Amount of cash', 'autocomplete'=>'off'])}}
          <div class="input-group-append">
              <span class="input-group-text">.00</span>
          </div>
          <div class="invalid-feedback">Cash must be a number</div>
        </div>
      </div>
      <div class="col-3 offset-1">
        <select class="form-control" name="status">
          <option value="{{Translation::HASWON_STATUS_AWAITING}}">{{Translation::HASWON_STATUS_AWAITING_TXT}}</option>
          <option value="{{Translation::HASWON_STATUS_COLLECTED}}">{{Translation::HASWON_STATUS_COLLECTED_TXT}}</option>
        </select>
      </div>
    </div>
  @endif
  <hr>
  {{ Form::submit('Add Listener', ['class' => 'btn btn-outline-primary btn-block btn-add mt-3', 'id'=>'addListener', 'disabled'])}}
  {{ Form::hidden('listener_id', '', ['id'=>'listener_id'])}}
  {{ Form::hidden('competition_id', $competition->id, ['id'=>'competition_id'])}}
  {!! Form::close() !!}

@include('inc.addListenerModal')

@endsection