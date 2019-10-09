@extends('layouts.app')
@section('title', 'Listener Details')
@section('content')
<h3>Listener Details</h3>
<hr>
<table class="table table-borderless">
  <tbody>
    <tr>
      <th scope="row" class="text-right align-middle">First Name</th>
      <td>{{ Form::bsText('firstName', $listener->firstName, ['disabled', 'class'=>'form-control'])}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle">Last Name</th>
      <td>{{ Form::bsText('lastName', $listener->lastName, ['disabled', 'class'=>'form-control'])}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle">DOB</th>
      <td>{{ Form::bsText('DOB', $listener->getFormattedDate(), ['disabled', 'class'=>'form-control'])}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle">Email</th>
      <td>{{ Form::bsText('email', $listener->email, ['disabled', 'class'=>'form-control'])}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle">Phone Number</th>
      <td>{{ Form::bsText('phone', $listener->phone, ['disabled', 'class'=>'form-control'])}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle">Suburb</th>
      <td>{{ Form::bsText('suburb', $listener->suburb, ['disabled', 'class'=>'form-control'])}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle">Additional Information</th>
      <td>{{ Form::bsTextArea('additionalInfo', $listener->additionalInfo, ['disabled', 'class'=>'form-control'])}}</td>
    </tr>
    <tr>
      <th scope="row" class="text-right align-middle"></th>
      <td>
        <a class="btn btn-outline-primary float-right" href="{{route('listeners.edit', $listener->id)}}">Edit</a>
        <a class="btn btn-outline-primary float-right mr-3" href="{{route('listenerHistory', $listener->id)}}">View History</a>
    </td>
    </tr>
  </tbody>
</table>
@endsection