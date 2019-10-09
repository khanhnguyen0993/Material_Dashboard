@extends('layouts.app')
@section('title', 'Add User')
@section('content')
<h3>Create a listener</h3>
<hr>
{!! Form::open(['action'=>'ListenersController@store', 'method'=>'POST']) !!}
<div class="form-group">
  {{ Form::label('firstName', 'First Name', ['class' => 'control-label']) }}
  <span class="text-muted">*</span> <span class="text-muted">(* required fields)</span>
  {{ Form::bsText('firstName', old('firstName', ''),['required', 'placeholder'=>'First Name', 'autocomplete'=>'off'])}}
</div>
<div class="form-group">
  {{ Form::label('lastName', 'Last Name', ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {{ Form::bsText('lastName', old('lastName', ''),['required', 'placeholder'=>'Last Name', 'autocomplete'=>'off'])}}
</div>

{{ Form::label('DOB', 'DOB', ['class' => 'control-label']) }} <span class="text-muted">* (dd/mm/yyyy)</span>
<div class="input-group">
  {{ Form::bsText('DOB', old('DOB', ''),['required', 'class'=>'datepicker text-center', 'autocomplete'=>'off'])}}
  <div class="input-group-append" id="datepicker">
    <span class="input-group-text fa fa-calendar"></span>
  </div>
</div>

<div class="form-group mt-3">
  {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
  {{ Form::bsText('email', old('email', ''),['required', 'placeholder'=>'sample@email.com', 'autocomplete'=>'off'])}}
</div>
<div class="form-group">
  {{ Form::label('phone', 'Phone', ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {{ Form::bsText('phone', old('phone', ''),['required', 'placeholder'=>'0123456789', 'autocomplete'=>'off'])}}
</div>
<div class="form-group">
  {{ Form::label('suburb', 'Suburb', ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {{ Form::bsText('suburb', old('suburb', ''),['required', 'placeholder'=>'Suburb', 'autocomplete'=>'off'])}}
</div>
<div class="form-group">
  {{ Form::label('additionalInfo', 'Additional Information', ['class' => 'control-label']) }}
  {{ Form::bsTextArea('additionalInfo', old('additionalInfo', ''))}}
</div>

<div class="form-group float-right">
  {{ Form::submit('Create', ['class' => 'btn btn-outline-primary'])}}
</div>
{!! Form::close() !!}
@endsection
