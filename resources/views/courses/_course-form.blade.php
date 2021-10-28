<div class="mb-2">
    {!! Form::label("name", "Course Name") !!}
    {!! Form::text("name", null, ['class'=>'form-control']) !!}
</div>

<div class="mb-2">
    {!! Form::label("description", "Description") !!}
    {!! Form::text("description", null, ['class'=>'form-control']) !!}
</div>

<div class="mb-2">
    {!! Form::label("credit", "Credits") !!}
    {!! Form::number("credit", null, ['class'=>'form-control']) !!}
</div>

<div class="mb-2">
    {!! Form::label("requisite_course", "Requisite Course") !!}
    {!! Form::select("requisite_course", $coursesList, null, ['class'=>'form-control','placeholder'=>'Select one']) !!}
</div>

<div class="mb-2">
    {!! Form::label("department_id", "Department") !!}
    {!! Form::select("department_id", $departmentList, null, ['class'=>'form-control','placeholder'=>'Select one']) !!}
</div>

<div class="mb-2">
    {!! Form::label("program_id", "Program") !!}
    {!! Form::select("program_id", $programList, null, ['class'=>'form-control','placeholder'=>'Select one']) !!}
</div>

