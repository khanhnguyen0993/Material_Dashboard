<div class="modal fade" id="listenerModal" tabindex="1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="modal-title text-info"> New Listener</h2>
        {!! Form::open(['action'=>'ListenersController@store', 'method'=>'POST']) !!}
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td class="text-right align-middle" style="width: 22%;">First Name <span class="text-muted">*</span></td>
              <td>{{ Form::bsText('firstName', null, ['id'=>'firstName', 'class'=>'form-control', 'autofocus'=>'true', 'autocomplete'=>'off'])}}</td>
            </tr>
            <tr>
              <td class="text-right align-middle" style="width: 22%;">Last Name <span class="text-muted">*</span></td>
              <td>{{ Form::bsText('lastName', null, ['id'=>'lastName', 'class'=>'form-control', 'autocomplete'=>'off'])}}</td>
            </tr>
            <tr>
              <td class="text-right align-middle" style="width: 22%;">Phone <span class="text-muted">*</span></td>
              <td>{{ Form::bsText('phone', null, ['id'=>'phone', 'class'=>'form-control', 'autocomplete'=>'off'])}}</td>
            </tr>
            <tr>
              <td class="text-right align-middle" style="width: 22%;">Suburb <span class="text-muted">*</span></td>
              <td>{{ Form::bsText('suburb', null, ['id'=>'suburb', 'class'=>'form-control', 'autocomplete'=>'off'])}}</td>
            </tr>
            <tr>
              <td></td>
              <td class="pb-0">
                {{ Form::submit('Create', ['class' => 'btn btn-outline-primary float-right'])}}
              </td>
            </tr>
          </tbody>
        </table>
        {{ Form::hidden('quickAddListener', true)}}
        {{ Form::close()}}
      </div>
    </div>
  </div>
</div>