<!-- Button trigger modal -->
<button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" data-target="#editUserModal">
    <i class="fas fa-user-edit"></i> Edit User
</button>

  <!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::model($user, ['url'=>'/user-mgt/users/' . $user->id, 'method'=>'put']) !!}
        <div class="modal-body">
            @include('users.mgt._user-form')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fa fa-times"></i> Close
          </button>
          <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> Save Changes
          </button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
