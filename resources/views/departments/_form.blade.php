<div class="form-group">
    {!! Form::label("accronym", "Accronym") !!}
    {!! Form::text("accronym", null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label("name", "Name") !!}
    {!! Form::text("name", null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label("parent_id", "Parent Department") !!}
    {!! Form::select("parent_id", $departmentList,null, ['class'=>'form-control','placeholder'=>'Select department']) !!}
</div>


