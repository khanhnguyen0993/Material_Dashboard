@extends('layouts.app')
@section('content')
<h4>Add New Prizes <a href="{{route('competitions.show', $competition->id)}}" class="float-right"><i class="fa fa-arrow-left text-info"> Go back</i></a></h4>
<hr>
{!! Form::open(['action'=>['PrizesController@store', $competition->id], 'method'=>'POST']) !!}
<div class="form-group">
  {{ Form::label('Prize Name', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span><span class="text-muted"> ( * required fields)</span>
  {{ Form::bsText('name', old('name', ''),['required', 'placeholder'=>'Prize Name', 'autocomplete'=>'off'])}}
</div>
<div class="form-group">
  {{ Form::label('Quantity', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {{ Form::bsNumber('amount', old('amount', ''),['required', 'placeholder'=>'For example 10, 50 ,100', 'autocomplete'=>'off', 'id'=>'prizeAmount'])}}
  <div class="invalid-feedback">Amount must be a number</div>
</div>
<div class="form-group">
  {{ Form::label('Description', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {{ Form::bsTextArea('description', old('description', ''), ['required'])}}
</div>
@if($competition->type == Translation::TYPE_LUCKY_DRAW)
<div class="form-group">
  {{ Form::label('Drawing priority', null, ['class' => 'control-label mr-3']) }}
  {{ Form::bsCheckbox('priority', true, false, ['id'=>'priority']) }}
</div>
@endif
<div class="form-group float-right">
  {{ Form::submit('Create', ['class' => 'btn btn-outline-primary'])}}
</div>
{!! Form::close() !!}

@endsection