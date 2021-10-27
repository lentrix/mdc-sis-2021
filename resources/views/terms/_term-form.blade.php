<div class="form-group">
    {!! Form::label("accronym", "Short Name") !!}
    {!! Form::text("accronym", null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("name", "Full Name") !!}
    {!! Form::text("name", null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("type", "Term Type") !!}
    {!! Form::select("type", [
        "annual"=>"Annual",
        "sem"=>'Semestral',
        'tri'=>'Trimestral'
    ],null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("start", "Term Starts") !!}
    {!! Form::date("start", isset($term)?$term->start:null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("end", "Term Ends") !!}
    {!! Form::date("end", isset($term)?$term->end:null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("enrol_start", "Start of Enrollment") !!}
    {!! Form::date("enrol_start", isset($term)?$term->enrol_start:null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("enrol_end", "End of Enrollment") !!}
    {!! Form::date("enrol_end", isset($term)?$term->enrol_end:null, ['class'=>'form-control']) !!}
</div>
