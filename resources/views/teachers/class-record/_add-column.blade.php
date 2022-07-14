<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addColumnModal">
    <i class="fa fa-plus"></i> Add Column
</button>

<!-- Modal -->
<div class="modal fade" id="addColumnModal" tabindex="-1" aria-labelledby="addColumnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addColumnModalLabel">Add Column</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url'=>'/teacher-classes/' . $subjectClass->id . '/class-record/add-column', 'method'=>'post']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label("period_id", "Grading Period") !!}
                    {!! Form::select("period_id", $gradingPeriods, null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("name", "Column Name") !!}
                    {!! Form::text("name", null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("weight", "Weight") !!}
                    {!! Form::number("weight", null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("total", "Total Score") !!}
                    {!! Form::number("total", null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("remarks", "Remarks") !!}
                    {!! Form::text("remarks", null, ['class'=>'form-control']) !!}
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
