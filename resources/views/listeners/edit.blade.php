@extends('layouts.app')
@section('content')
<h3>Edit Listener Details</h3>
<hr>
{!! Form::open(['action'=>['ListenersController@update', $listener->id], 'method'=>'POST']) !!}
<table class="table table-borderless">
  <tbody>
    <tr>
      <th scope="row" class="text-right align-middle">First Name <span class="text-muted">*</span></th>
      <td>{{ Form::bsText('firstName', $listener->firstName)}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle">Last Name <span class="text-muted">*</span></th>
      <td>{{ Form::bsText('lastName', $listener->lastName)}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle">DOB <span class="text-muted">*</span></th>
      <td>{{ Form::bsText('DOB', $listener->getFormattedDate(), ['class'=>'form-control datepicker'])}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle">Email <span class="text-muted">*</span></th>
      <td>{{ Form::bsText('email', $listener->email)}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle">Phone Number <span class="text-muted">*</span></th>
      <td>{{ Form::bsText('phone', $listener->phone)}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle">Suburb <span class="text-muted">*</span></th>
      <td>{{ Form::bsText('suburb', $listener->suburb)}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle">Additional Information</th>
      <td>{{ Form::bsTextArea('additionalInfo', $listener->additionalInfo)}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle"><span class="text-muted">* (Required fields)</span></th>
      {{ Form::hidden('_method', 'PUT')}}
      <td>
        <div class="form-row">
          <div class="col">
            {{ Form::bsSubmit('Save',['class'=>'btn btn-outline-primary btn-block '])}}
            {!! Form::close() !!}
          </div>
          <div class="col">
            {!! Form::open(['action'=>['ListenersController@destroy', $listener->id], 'method'=>'POST', 'id'=>'listenerDeleteForm']) !!}
            <a href="#" class='btn btn-outline-danger btn-block' data-toggle="modal" data-id="listener" data-target="#deleteConfirmation">Delete</a>
            {{ Form::hidden('_method', 'DELETE')}}
            {!! Form::close() !!}
          </div>
        </div>
      </td>
    </tr>
  </tbody>
</table>

@include('inc.deleteConfirmationModal')

@endsection