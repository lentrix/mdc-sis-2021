<!-- Button trigger modal -->
<button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#changePasswordModal">
    <i class="fas fa-key"></i> Change Password
</button>

  <!-- Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/user-mgt/users/' . $user->id, 'method'=>'patch']) !!}
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label("password", "New Password") !!}
                {!! Form::password("password", ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label("password_confirmation", "Confirm Password") !!}
                {!! Form::password("password_confirmation", ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fa fa-times"></i> Close
          </button>
          <button type="submit" class="btn btn-primary">
              <i class="fa fa-key"></i> Change Password
          </button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
