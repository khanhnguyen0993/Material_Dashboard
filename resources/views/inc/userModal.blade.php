<div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h2 class="modal-title text-info"> Admin Details</h2>
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td class="text-right align-middle" style="width: 10%;">Admin</td>
              <td>{{ Form::bsText('name', null, ['id'=>'userName', 'class'=>'form-control'])}}</td>
            </tr>
            <tr>
              <td class="text-right align-middle" style="width: 10%;">Email</td>
              <td>{{ Form::bsText('name', null, ['id'=>'userEmail', 'class'=>'form-control'])}}</td>
            </tr>
            <!-- <tr>
              <td class="text-right align-middle">Type</td>
              <td>{!! Form::select('type',[
                Translation::USER_2CA=>Translation::USER_2CA_TXT, 
                Translation::USER_2CC=>Translation::USER_2CC_TXT, 
                Translation::USER_ADMIN=>Translation::USER_ADMIN_TXT, 
                ], null, ['id'=>'userType', 'class'=>'form-control']) !!}</td>
            </tr> -->
          </tbody>
          <tr>
            <td class="pb-0"></td>
            <td class="pb-0">
              <div id="update-delete" >
                <button type="button" class="deleteUser btn btn-outline-danger float-right ml-3" data-dismiss="modal">Delete</button>
                <button type="button" class="updateUser btn btn-outline-primary float-right" data-dismiss="modal">Update</button>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>