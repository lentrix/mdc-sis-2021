<button type="button" class="btn text-info btn-sm fa fa-edit" data-toggle="modal" data-target="#editSchedModal{{$sched->id}}" title="Update schedule">
</button>

<div class="modal fade" id="editSchedModal{{$sched->id}}" tabindex="-1" aria-labelledby="editSchedModal{{$sched->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSchedModal{{$sched->id}}Label">Update Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::model($sched,['url'=>'/classes/update-sched/' . $sched->id,'method'=>'patch']) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label("start", "Time Start") !!}
                            {!! Form::time("start", $sched->start, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label("end", "Time End") !!}
                            {!! Form::time("end", $sched->end, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label("venue_id", "Venue") !!}
                            {!! Form::select("venue_id", $venues,null, ['class'=>'form-control','placeholder'=>'Select a venue']) !!}
                        </div>
                    </div>
                </div>
                <label for="">Select Days ({{$sched->day}})</label>
                <div class='day-picker'>
                    @foreach(config('custom.days') as $dayIndex=>$day)
                        <label for="{{$dayIndex}}">
                            <input type="checkbox"
                                    @if(hasDay($sched->day, $dayIndex)) checked="true" @endif
                                    id="{{$dayIndex}}"
                                    value="{{$dayIndex}}"
                                    name="days[]">
                            {{$day}}
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
