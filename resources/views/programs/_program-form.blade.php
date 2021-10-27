<div class="form-group">
    {!! Form::label("short_name", "Short Name") !!}
    {!! Form::text("short_name", null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("full_name", "Full Name") !!}
    {!! Form::text("full_name", null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("department_id", "Department") !!}
    {!! Form::select("department_id", $deptList,null, ['class'=>'form-control','placeholder'=>'Select one']) !!}
</div>
<div class="form-group">
    {!! Form::label("program_head", "Program Head") !!}
    {!! Form::text("program_head", null, ['class'=>'form-control']) !!}
</div>
