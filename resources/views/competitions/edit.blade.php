@extends('layouts.app')
@section('content')
<h3>Edit Competition</h3>
<hr>
<h5 class="mb-3">Please update the desired information below and make sure to click 'Update' before you leave.</h5>
<h4> Competition Details</h4>
{!! Form::open(['action'=>['CompetitionsController@update', $competition->id], 'method'=>'POST']) !!}
<div class="form-group">
  {{ Form::label('Competition Name', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span><span class="text-muted"> (* required fields)</span>
  {{ Form::bsText('name', old('name', $competition->name),['required', 'placeholder'=>'Competition Name'])}}
</div>
<div class="form-group">
  {{ Form::label('Radio Station', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  @if($userType == Translation::USER_2CA)
    {!! Form::select('station', [
    Translation::STATION_2CA=>Translation::STATION_2CA_TXT
    ], $competition->station, ['class'=>'form-control']) !!}
  @elseif($userType == Translation::USER_2CC)
    {!! Form::select('station', [
    Translation::STATION_2CC=>Translation::STATION_2CC_TXT
    ], $competition->station, ['class'=>'form-control']) !!}
  @else
    {!! Form::select('station', [
    Translation::STATION_2CA=>Translation::STATION_2CA_TXT, 
    Translation::STATION_2CC=>Translation::STATION_2CC_TXT
    ], $competition->station, ['class'=>'form-control']) !!}
  @endif
</div>
<div class="form-group">
  {{ Form::label('Type of Competition', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {!! Form::select('type', [
    Translation::TYPE_INSTANT_WIN=>Translation::TYPE_INSTANT_WIN_TXT, 
    Translation::TYPE_LUCKY_DRAW=>Translation::TYPE_LUCKY_DRAW_TXT,
    Translation::TYPE_BIRTHDAY_WILL=>Translation::TYPE_BIRTHDAY_WILL_TXT,
    Translation::TYPE_CASH_PRIZE=>Translation::TYPE_CASH_PRIZE_TXT
  ], $competition->type, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
  {{ Form::label('Status', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {!! Form::select('status', [
    Translation::STATUS_CLOSED=>Translation::STATUS_CLOSED_TXT, 
    Translation::STATUS_OPEN=>Translation::STATUS_OPEN_TXT
  ], $competition->status, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
  {{ Form::label('Description', null, ['class' => 'control-label']) }}
  {{ Form::bsTextArea('description', old('description', $competition->description))}}
</div>

<div class="form-row">
  <div class="col">
    {{ Form::label('Start Date', null, ['class' => 'control-label']) }} <span class="text-muted">* (dd/mm/yyyy)</span>
    <div class="input-group">
      {{ Form::bsText('startDate', old('startDate', $competition->getFormattedStartDate()),['required', 'class'=>'datepicker text-center'])}}
      <div class="input-group-append" id="datepicker">
        <span class="input-group-text fa fa-calendar"></span>
      </div>
    </div>
  </div>
  <div class="col">
    {{ Form::label('End Date', null, ['class' => 'control-label']) }} <span class="text-muted">* (dd/mm/yyyy)</span>
    <div class="input-group">
      {{ Form::bsText('endDate', old('endDate', $competition->getFormattedEndDate()),['required', 'class'=>'datepicker text-center'])}}
      <div class="input-group-append" id="datepicker">
        <span class="input-group-text fa fa-calendar"></span>
      </div>
    </div>
  </div>
</div>


<div class="form-row mt-3">
  <div class="col">
    {{ Form::hidden('_method', 'PUT')}}
    {{ Form::submit('Save', ['class' => 'btn btn-outline-primary btn-block'])}}
    {!! Form::close() !!}
  </div>
  <div class="col">
    {!! Form::open(['action'=>['CompetitionsController@destroy', $competition->id], 'method'=>'POST', 'id'=>'competitionDeleteForm']) !!}
    <a href="#" class='btn btn-outline-danger btn-block' data-toggle="modal" data-id="competition" data-target="#deleteConfirmation">Delete</a>
    {{ Form::hidden('_method', 'DELETE')}}
    {!! Form::close() !!}
  </div>
</div>


@include('inc.deleteConfirmationModal')

@endsection