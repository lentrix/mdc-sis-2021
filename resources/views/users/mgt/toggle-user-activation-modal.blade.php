<!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#toggleUserActivationModal">
    @if($user->active)
        <i class="fa fa-user-times"></i> Deactivate User
    @else
        <i class="fa fa-user-check"></i> Activate User
    @endif
</button>

  <!-- Modal -->
<div class="modal fade" id="toggleUserActivationModal" tabindex="-1" aria-labelledby="toggleUserActivationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="toggleUserActivationModalLabel">{{$user->active ? "Deactivate User" : "Activate User"}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/user-mgt/toggle-activation/' . $user->id, 'method'=>'post']) !!}
        <div class="modal-body">
            <div class="alert alert-info">
                You are about to "{{$user->active ? "DEACTIVATE" : "ACTIVATE"}}"" user {{$user->user}}.
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fa fa-times"></i> Close
          </button>
          <button type="submit" class="btn btn-primary">
              <i class="fa fa-check"></i> Confirm
          </button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
