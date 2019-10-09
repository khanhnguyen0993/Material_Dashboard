@extends('layouts.app')
@section('content')
<h3>Edit Prize</h3>
<hr>
{!! Form::open(['action'=>['PrizesController@update', $prize->competition->id, $prize->id], 'method'=>'POST']) !!}
<div class="form-group">
  {{ Form::label('Prize Name', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span><span class="text-muted"> ( * required fields)</span>
  {{ Form::bsText('name', old('name', $prize->name),['required', 'placeholder'=>'Prize Name'])}}
</div>
<div class="form-group">
  {{ Form::label('Amount', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {{ Form::bsText('amount', old('amount', $prize->amount),['required', 'placeholder'=>'Amount'])}}
</div>
<div class="form-group">
  {{ Form::label('Description', null, ['class' => 'control-label']) }}
  <span class="text-muted">*</span>
  {{ Form::bsTextArea('description', old('description', $prize->description), ['required'])}}
</div>

@if($prize->competition->type == Translation::TYPE_LUCKY_DRAW)
<div class="form-group">
  {{ Form::label('Drawing priority', null, ['class' => 'control-label mr-3']) }}
  {{ Form::hidden('priority', 0)}}
  {{ Form::bsCheckbox('priority', 1, $prize->priority) }}
</div>
@endif

<div class="form-group float-right">
  {{ Form::hidden('_method', 'PUT')}}
  {{ Form::submit('Update', ['class' => 'btn btn-outline-primary'])}}
</div>
{!! Form::close() !!}
@endsection