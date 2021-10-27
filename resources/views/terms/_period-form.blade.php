{!! Form::hidden("term_id", $term->id) !!}

<div class="form-group">
    {!! Form::label("name", "Name") !!}
    {!! Form::text("name", null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label("start", "Date Start") !!}
    {!! Form::date("start", null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label("end", "Date End") !!}
    {!! Form::date("end", null, ['class'=>'form-control']) !!}
</div>
