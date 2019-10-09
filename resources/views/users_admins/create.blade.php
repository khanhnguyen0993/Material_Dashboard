@extends('layouts.app')
@section('content')
<h3>Admin Details</h3>
<hr>
{!! Form::open(['action'=>'UsersController@store', 'method'=>'POST']) !!}
<div class="form-group">
  {{ Form::label('name', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {{ Form::bsText('name', old('name', ''),['required', 'placeholder'=>'name'])}}
</div>
<div class="form-group">
  {{ Form::label('email', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {{ Form::bsText('email', old('email', ''),['required', 'placeholder'=>'sample@email.com'])}}
</div>
<div class="form-group">
  {{ Form::label('password', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {{ Form::password('password', ['class'=>'form-control'])}}
</div>
<div class="form-group">
  {{ Form::label('password_confirmation', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {{ Form::password('password_confirmation', ['class'=>'form-control'])}}
</div>
<div class="form-group">
  {{ Form::label('type', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {!! Form::select('type',[
  Translation::USER_2CA=>Translation::USER_2CA_TXT, 
  Translation::USER_2CC=>Translation::USER_2CC_TXT, 
  Translation::USER_ADMIN=>Translation::USER_ADMIN_TXT, 
  ], null, ['class'=>'form-control']) !!}
</div>
<span class="text-muted">* (Required fields)</span>
<div class="form-group float-right">
  {{ Form::submit('Create', ['class' => 'btn btn-outline-primary'])}}
</div>
{!! Form::close() !!}
@endsection