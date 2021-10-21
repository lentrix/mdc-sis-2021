<div class="form-group">
    {!! Form::label("level", "Level") !!}
    {!! Form::select("level", [
        'Primary'=>'Primary',
        'Elementary' => 'Elementary',
        'High School' => 'High School',
        'College' => 'College',
        'Masters' => 'Masters',
        'Doctorate' => 'Doctorate',
    ],null ,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("degree", "Degree (if applicable)") !!}
    {!! Form::text("degree", null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("school", "School Name") !!}
    {!! Form::text("school", null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("address", "School Address") !!}
    {!! Form::text("address", null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("year", "Year") !!}
    {!! Form::text("year", null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("remarks", "Remarks") !!}
    {!! Form::text("remarks", null, ['class'=>'form-control']) !!}
</div>
