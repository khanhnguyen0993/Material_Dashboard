@extends('layouts.app')
@section('content')
<h3>Add New Competition</h3>
<hr>
{!! Form::open(['action'=>'CompetitionsController@store', 'method'=>'POST']) !!}
<div class="form-group">
  {{ Form::label('name', 'Competition Name',['class' => 'control-label']) }}
  <span class="text-muted">*</span><span class="text-muted"> (* required fields)</span>
  {{ Form::bsText('name', old('name', ''),['required', 'placeholder'=>'Competition Name'])}}
</div>
<div class="form-group">
  {{ Form::label('station', 'Radio Station', ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  @if($userType == Translation::USER_2CA)
    {!! Form::select('station', [
    Translation::STATION_2CA=>Translation::STATION_2CA_TXT
    ], null, ['class'=>'form-control']) !!}
  @elseif($userType == Translation::USER_2CC)
    {!! Form::select('station', [
    Translation::STATION_2CC=>Translation::STATION_2CC_TXT
    ], null, ['class'=>'form-control']) !!}
  @else
    {!! Form::select('station', [
    Translation::STATION_2CA=>Translation::STATION_2CA_TXT, 
    Translation::STATION_2CC=>Translation::STATION_2CC_TXT
    ], null, ['class'=>'form-control']) !!}
  @endif
</div>
<div class="form-group">
  {{ Form::label('type', 'Type of Competition', ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {!! Form::select('type', [
  Translation::TYPE_INSTANT_WIN=>Translation::TYPE_INSTANT_WIN_TXT, 
  Translation::TYPE_LUCKY_DRAW=>Translation::TYPE_LUCKY_DRAW_TXT,
  Translation::TYPE_BIRTHDAY_WILL=>Translation::TYPE_BIRTHDAY_WILL_TXT,
  Translation::TYPE_CASH_PRIZE=>Translation::TYPE_CASH_PRIZE_TXT
  ], null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
  {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {!! Form::select('status', [
    Translation::STATUS_OPEN => Translation::STATUS_OPEN_TXT, 
    Translation::STATUS_CLOSED => Translation::STATUS_CLOSED_TXT], 
    null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
  {{ Form::label('description', 'Description', ['class' => 'control-label']) }}
  {{ Form::bsTextArea('description', old('description', ''))}}
</div>

<div class="form-row">
  <div class="col-md-4">
    {{ Form::label('startDate', 'Start Date', ['class' => 'control-label']) }} <span class="text-muted">* (dd/mm/yyyy)</span>
    <div class="input-group">
      {{ Form::bsText('startDate', old('startDate', ''),['required', 'class'=>'datepicker text-center', 'autocomplete'=>'off'])}}
      <div class="input-group-append" id="datepicker">
        <span class="input-group-text fa fa-calendar"></span>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    {{ Form::label('endDate', 'End Date', ['class' => 'control-label']) }} <span class="text-muted">* (dd/mm/yyyy)</span>
    <div class="input-group">
      {{ Form::bsText('endDate', old('endDate', ''),['required', 'class'=>'datepicker text-center', 'autocomplete'=>'off'])}}
      <div class="input-group-append" id="datepicker">
        <span class="input-group-text fa fa-calendar"></span>
      </div>
    </div>
  </div>
  <div class="col-md-4">
  </div>
</div>

<div class="form-group float-right mt-3">
  {{ Form::submit('Create', ['class' => 'btn btn-outline-primary'])}}
</div>
{!! Form::close() !!}

@endsection