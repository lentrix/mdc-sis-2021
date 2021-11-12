<div class="form-group">
    {!! Form::label("name", "Name") !!}
    {!! Form::text("name", null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label("department_id", "Department") !!}
    {!! Form::select("department_id", $departmentList, isset($section)?$section->department_id:null, ['class'=>'form-control','placeholder'=>'Select a department']) !!}
</div>

<div class="form-group">
    {!! Form::label("term_id", "Term") !!}
    {!! Form::select("term_id", $termsList, isset($section)?$section->term_id:null, ['class'=>'form-control','placeholder'=>'Select a term']) !!}
</div>

<div class="form-group">
    {!! Form::label("program_id", "Program") !!}
    {!! Form::select("program_id", $programsList, isset($section)?$section->program_id:null, ['class'=>'form-control','placeholder'=>'Select a term']) !!}
</div>

<div class="form-group">
    {!! Form::label("level", "Level") !!}
    {!! Form::select("level", config('mdc.levels'), isset($section)?$section->level:null, ['class'=>'form-control','placeholder'=>'Select a level']) !!}
</div>

<div class="form-group">
    {!! Form::label("teacher_id", "Adviser") !!}
    {!! Form::select("teacher_id", $teachersList, isset($section)?$section->teacher_id:null, ['class'=>'form-control','placeholder'=>'Select a teacher']) !!}
</div>

