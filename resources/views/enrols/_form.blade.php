<div class="form-group">
    {!! Form::label("program_id", "Program") !!}
    {!! Form::select("program_id", $programs, isset($enrol)?$enrol->program_id:null, ['class'=>'form-control','placeholder'=>'Select a program']) !!}
</div>

<div class="form-group">
    {!! Form::label("level", "Level") !!}
    {!! Form::select("level", config('mdc.levels'), isset($enrol)?$enrol->level:null, ['class'=>'form-control','placeholder'=>'Select a level']) !!}
</div>

<div class="form-group">
    {!! Form::label("term_id", "Term") !!}
    {!! Form::select("term_id", $terms, isset($enrol)?$enrol->term_id:null, ['class'=>'form-control','placeholder'=>'Select a program']) !!}
</div>
